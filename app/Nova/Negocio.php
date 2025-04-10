<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Trinityrank\GoogleMapWithAutocomplete\TRMap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class Negocio extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Negocio>
     */
    public static $model = \App\Models\Negocio::class;

    public static function label()
    {
        return 'Aprobados';
    }

    public static function singularLabel()
    {
        return 'Negocio';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Date::make('Fecha', 'created_at')
                ->filterable()
                ->sortable()
                ->readonly(),

            Number::make('Visitas', 'visitas')
                ->hideFromIndex()
                ->readonly(),

            new Panel('Datos del Contacto', $this->contactoFields()),
            new Panel('Datos del Negocio', $this->negocioFields()),
            new Panel('Galería de Fotos', $this->galeriaFields()),
            new Panel('Estatus', $this->estatusFields()),
        ];
    }

    protected function contactoFields()
    {
        return [
            Text::make('Nombre', 'contacto_nombre')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Teléfono', 'contacto_telefono')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Email::make('Correo Electrónico', 'contacto_email')
                ->hideFromIndex()
                ->rules('required', 'max:255'),
        ];
    }

    protected function negocioFields()
    {
        return [

            Text::make('Nombre', 'nombre')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Categoría', 'categoria', 'App\Nova\Categoria')
                ->filterable()
                ->sortable()
                ->rules('required'),

            BelongsTo::make('SubCategoría', 'subcategoria', 'App\Nova\Subcategoria')
                ->filterable()
                ->sortable(),

            Text::make('Dirección', 'direccion')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Teléfono', 'telefono')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Email::make('Correo Electrónico', 'email')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Horario entre semana', 'horario')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Horario fin semana', 'horario_fin')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Website', 'website')
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Whatsapp', 'whatsapp')
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Facebook', 'facebook')
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Twitter', 'twitter')
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Instagram', 'instagram')
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Tiktok', 'tiktok')
                ->hideFromIndex()
                ->rules('max:255'),

            Textarea::make('Descripcion', 'descripcion')
                ->rules(['required'])
                ->hideFromIndex()
                ->fullWidth(),

            TRMap::make('Map')
                ->hideFromIndex()
                ->latitude(25.413559)
                ->longitude(-100.151906)
                ->zoom(13),
        ];
    }

    protected function galeriaFields()
    {
        return [

            Image::make('Fotografía 13', 'foto1')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->store(function (Request $request) {
                    return ['foto1' => $this->s3Image($request, 'foto1')];
                })
                ->hideFromIndex()
                ->deletable(true)
                ->prunable(),

            Image::make('Fotografía 2', 'foto2')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return ['foto2' => $this->s3Image($request, 'foto2')];
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 3', 'foto3')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return ['foto3' => $this->s3Image($request, 'foto3')];
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 4', 'foto4')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return ['foto4' => $this->s3Image($request, 'foto4')];
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 5', 'foto5')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return ['foto5' => $this->s3Image($request, 'foto5')];
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
        ];
    }

    private function s3Image(Request $request, $image)
    {
        $image_size = [400, 300];
        $image = $request->file($image);

        $path = 'negocios/' . str_replace('-', '', Str::uuid()) . '.webp';
        $store = new ImageManager(Driver::class);
        $store = $store->read($image->getPathName());
        $store->scaleDown($image_size[0], $image_size[1]);
        $store = $store->toWebp(90);
        (Storage::put($path, (string)$store->toString()));
        Storage::setVisibility($path, 'public');

        return $path;
    }


    protected function estatusFields()
    {
        return [
            Boolean::make('Aprobado')->trueValue(1)->falseValue(0)->filterable(),
            Boolean::make('Activo')->trueValue(1)->falseValue(0)->filterable()->default(true),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->where('aprobado', 1);
    }
}