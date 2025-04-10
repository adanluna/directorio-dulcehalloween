<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Image;
use Timothyasp\Color\Color;

class Categoria extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Categoria>
     */
    public static $model = \App\Models\Categoria::class;

    public static function label()
    {
        return 'Categorías';
    }

    public static function singularLabel()
    {
        return 'Categoría';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nombre';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'nombre'
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

            Text::make('Nombre', 'nombre')
                ->sortable()
                ->rules('required', 'max:255'),
            Color::make('Color de fondo', 'bgcolor')->chrome(),
            Color::make('Color de texto', 'color')->compact(),
            Image::make('Fotografía', 'fotografia')
                ->disk('s3')
                ->path('negocios')
                ->indexWidth(90)
                ->detailWidth(300)
                ->creationRules('file', 'max:3000')
                ->updateRules('file', 'max:3000')
                ->acceptedTypes('.jpeg,.jpg,.png,.webp')
                ->storeAs(function (Request $request) {
                    return sha1($request->fotografia->getClientOriginalName()) . '.' . $request->fotografia->getClientOriginalExtension();
                })
                ->deletable(true)
                ->hideFromIndex()
                ->prunable(),

            Boolean::make('Activo', 'activo')
                ->sortable()
                ->default(true)
                ->rules('required'),
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
}
