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

class NoAprobados extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Negocio>
     */
    public static $model = \App\Models\Negocio::class;

    public static function label()
    {
        return 'No Aprobados';
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
                ->latitude(25.7721667)
                ->longitude(-100.4284185)
                ->zoom(16),
        ];
    }

    protected function galeriaFields()
    {
        return [

            Image::make('Fotografía 1', 'foto1')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return sha1($request->foto1->getClientOriginalName()).'.'.$request->foto1->getClientOriginalExtension();
                })
                ->hideFromIndex()
                ->deletable(true)
                ->prunable(),

                Image::make('Fotografía 2', 'foto2')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return sha1($request->foto2->getClientOriginalName()).'.'.$request->foto2->getClientOriginalExtension();
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 3', 'foto3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return sha1($request->foto3->getClientOriginalName()).'.'.$request->foto3->getClientOriginalExtension();
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 4', 'foto4')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return sha1($request->foto4->getClientOriginalName()).'.'.$request->foto4->getClientOriginalExtension();
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
            Image::make('Fotografía 5', 'foto5')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png')
                ->storeAs(function (Request $request) {
                    return sha1($request->foto5->getClientOriginalName()).'.'.$request->foto5->getClientOriginalExtension();
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),
        ];
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
        $query->where('aprobado', 0);
    }
}