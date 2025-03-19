<?php

namespace App\Providers;

use App\Nova\Categoria;
use App\Nova\User;
use App\Nova\Dashboards\Main;
use App\Nova\Negocio;
use App\Nova\NoAprobados;
use App\Nova\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::footer(function ($request) {
            return Blade::render('
                @env(\'prod\')
                    Gobierno de Santiago Nuevo Leon
                @endenv
            ');
        });

        Nova::serving(function () {
            App::setLocale('es');
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),

                MenuSection::make('Negocios', [
                    MenuItem::resource(Negocio::class),
                    MenuItem::resource(NoAprobados::class),
                ])->icon('briefcase')->collapsable(),

                MenuSection::make('Catálogos', [
                    MenuItem::resource(Categoria::class),
                    MenuItem::resource(Subcategoria::class),
                ])->icon('newspaper')->collapsable(),

                MenuSection::make('Sistema', [
                    MenuItem::resource(User::class),
                    /*MenuItem::resource(Admin::class)->canSee(function ($request) {
                        return $request->user()->isSuperAdmin();
                    }),*/
                ])->collapsable()->icon('adjustments'),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
            //return in_array($user->email, [
                //
            //]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
