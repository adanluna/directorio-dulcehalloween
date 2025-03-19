<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Negocio;
use App\Models\Subcategoria;
use App\Observers\CategoriaObserver;
use App\Observers\NegocioObserver;
use App\Observers\SubcategoriaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Negocio::observe(NegocioObserver::class);
        Categoria::observe(CategoriaObserver::class);
        Subcategoria::observe(SubcategoriaObserver::class);
    }
}
