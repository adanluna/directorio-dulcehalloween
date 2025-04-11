<?php

namespace App\Http\Controllers;

use App\Mail\AdminNewNegocio;
use App\Models\Categoria;
use App\Models\Negocio;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class WebController extends Controller
{
    private $paginate = 25;
    private $image_size = [400, 300];
    private $folder = 'negocios';

    public function index(Request $request)
    {
        $categorias = Categoria::all();

        $recientes = Negocio::with('categoria')->with('subcategoria')->Activo()
            ->Aprobado()->orderBy('created_at', 'desc')->limit(6)->get();

        return Inertia::render('Home', [
            'categorias' => $categorias,
            'recientes' => $recientes,
        ]);
    }

    public function buscar(Request $request)
    {
        $categorias = Categoria::all();

        $negocios = Negocio::with('categoria')->with('subcategoria')
            ->Activo()
            ->Aprobado()
            ->Buscar($request->get('q'))
            ->orderBy('created_at', 'desc')->paginate($this->paginate)->withQueryString();

        return Inertia::render('Buscador', [
            'q' => $request->get('q'),
            'categorias' => $categorias,
            'negocios' => $negocios,
        ]);
    }

    public function categoria(Request $request, $categoria_slug, $subcategoria_slug = '')
    {
        $categoria = Categoria::where('slug', $categoria_slug)->first();
        if ($categoria == null) {
            abort(404);
        }
        if ($subcategoria_slug != null) {
            $subcategoria = Subcategoria::where('slug', $subcategoria_slug)->first();
            if ($subcategoria == null) {
                abort(404);
            }
        }
        $negocios = Negocio::with('categoria')->with('subcategoria')
            ->Activo()
            ->Aprobado()
            ->CategoriaScope($categoria->id)
            ->SubcategoriaScope(($subcategoria_slug != '') ? $subcategoria->id : null)
            ->orderBy('created_at', 'desc')->paginate($this->paginate)->withQueryString();

        $subcategorias = Subcategoria::where('categoria_id', $categoria->id)->get();

        return Inertia::render('Categorias', [
            'subcategorias' => $subcategorias,
            'subcategoria' => ($subcategoria_slug != '') ? $subcategoria : null,
            'categoria' => $categoria,
            'negocios' => $negocios,
        ]);
    }

    public function negocio(Request $request, $negocio_slug)
    {

        $negocio = Negocio::where('slug', $negocio_slug)->Activo()
            ->Aprobado()->with('categoria')->with('subcategoria')->first();

        if ($negocio == null) {
            abort(404);
        }

        $negocio->visitas = $negocio->visitas + 1;
        $negocio->save();

        $negocios = Negocio::with('categoria')->with('subcategoria')
            ->where('id', '<>', $negocio->id)
            ->Activo()
            ->Aprobado()
            ->CategoriaScope($negocio->categoria_id)
            ->orderBy(DB::raw('RAND()'))->limit(3)->get();

        return Inertia::render('Negocio', [
            'negocio' => $negocio,
            'negocios' => $negocios,
        ]);
    }

    public function inscripcion()
    {
        $categorias = Categoria::selectRaw('id AS value, nombre AS label')->orderBy('nombre', 'ASC')->get()->toArray();

        return Inertia::render('Inscripcion', [
            'categorias' => $categorias,
        ]);
    }

    public function inscripcionCreate(Request $request)
    {
        $maxfile = 1024 * 2;
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'categoria' => 'required',
            'subcategoria' => 'required',
            'direccion' => 'required',
            'horario' => 'required',
            'horario_fin' => 'required',
            'descripcion' => 'required',
            'contacto_nombre' => 'required',
            'contacto_telefono' => 'required',
            'contacto_email' => 'required|email',
            'direccion_en_mapa' => 'required',
            'foto1' => "required|max:$maxfile",
            'foto2' => "max:$maxfile",
            'foto3' => "max:$maxfile",
            'foto4' => "max:$maxfile",
            'foto5' => "max:$maxfile",
        ]);

        $data = request()->except(['direccion_en_mapa', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5']);
        $data['categoria_id'] = $data['categoria'];
        $data['subcategoria_id'] = $data['subcategoria'];
        unset($data["categoria"]);
        unset($data["subcategoria"]);

        $negocio = Negocio::create($data);

        if ($request->hasFile('foto1')) {
            $foto_path = $this->image('foto1');
            $negocio->foto1 = $foto_path;
        }
        if ($request->hasFile('foto2')) {
            $foto_path = $this->image('foto2');
            $negocio->foto2 = $foto_path;
        }
        if ($request->hasFile('foto3')) {
            $foto_path = $this->image('foto3');
            $negocio->foto3 = $foto_path;
        }
        if ($request->hasFile('foto4')) {
            $foto_path = $this->image('foto4');
            $negocio->foto4 = $foto_path;
        }
        if ($request->hasFile('foto5')) {
            $foto_path = $this->image('foto5');
            $negocio->foto5 = $foto_path;
        }

        $negocio->save();
        $admins = User::all();
        foreach ($admins as $user) {
            Mail::to($user->email)->send(new AdminNewNegocio($negocio));
        }

        return to_route('inscripcion.gracias');
    }

    private function image($name)
    {
        if (!$image = request()->file($name)) {
            return '';
        }
        $paths = $this->folder . '/' . str_replace('-', '', Str::uuid()) . '.webp';
        $store = new ImageManager(Driver::class);
        $store = $store->read($image->getPathName());

        if ($this->image_size) {
            $store->scaleDown($this->image_size[0], $this->image_size[1]);
        }
        $store = $store->toWebp(90);
        (Storage::put($paths, (string)$store->toString()));
        Storage::setVisibility($paths, 'public');

        return $paths;
    }

    public function inscripcionGracias()
    {
        return Inertia::render('Gracias');
    }

    public function getCategorias()
    {
        $categorias = Categoria::get();
        return response()->json($categorias);
    }

    public function getSubcategorias($categoria)
    {
        $subcategorias = Subcategoria::selectRaw('id AS value, nombre AS label')->where('categoria_id', $categoria)->orderBy('nombre', 'ASC')->get()->toArray();
        return response()->json($subcategorias);
    }
}
