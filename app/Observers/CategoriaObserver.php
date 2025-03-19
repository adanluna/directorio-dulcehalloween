<?php

namespace App\Observers;

use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaObserver
{
    /**
     * Handle the Categoria "created" event.
     */
    public function created(Categoria $categoria): void
    {
        $categoria->slug = Str::slug($categoria->nombre);
        $categoria->saveQuietly();
    }

    /**
     * Handle the Categoria "updated" event.
     */
    public function updated(Categoria $categoria): void
    {
        $categoria->slug = Str::slug($categoria->nombre);
        $categoria->saveQuietly();
    }

    /**
     * Handle the Categoria "deleted" event.
     */
    public function deleted(Categoria $categoria): void
    {
        //
    }

    /**
     * Handle the Categoria "restored" event.
     */
    public function restored(Categoria $categoria): void
    {
        //
    }

    /**
     * Handle the Categoria "force deleted" event.
     */
    public function forceDeleted(Categoria $categoria): void
    {
        //
    }
}
