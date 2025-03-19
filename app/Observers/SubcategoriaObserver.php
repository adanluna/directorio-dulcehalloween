<?php

namespace App\Observers;

use App\Models\Subcategoria;
use Illuminate\Support\Str;

class SubcategoriaObserver
{
    /**
     * Handle the Subcategoria "created" event.
     */
    public function created(Subcategoria $subcategoria): void
    {
        $subcategoria->slug = Str::slug($subcategoria->nombre);
        $subcategoria->saveQuietly();
    }

    /**
     * Handle the Subcategoria "updated" event.
     */
    public function updated(Subcategoria $subcategoria): void
    {
        $subcategoria->slug = Str::slug($subcategoria->nombre);
        $subcategoria->saveQuietly();
    }

    /**
     * Handle the Subcategoria "deleted" event.
     */
    public function deleted(Subcategoria $subcategoria): void
    {
        //
    }

    /**
     * Handle the Subcategoria "restored" event.
     */
    public function restored(Subcategoria $subcategoria): void
    {
        //
    }

    /**
     * Handle the Subcategoria "force deleted" event.
     */
    public function forceDeleted(Subcategoria $subcategoria): void
    {
        //
    }
}
