<?php

namespace App\Observers;

use App\Mail\NegocioAprobado;
use App\Models\Negocio;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NegocioObserver
{
    /**
     * Handle the Negocio "created" event.
     */
    public function created(Negocio $negocio): void
    {
        $negocio->slug = Str::slug($negocio->nombre);
        $negocio->saveQuietly();
    }

    /**
     * Handle the Negocio "updated" event.
     */
    public function updated(Negocio $negocio): void
    {
        if ($negocio->isDirty('aprobado')) {
            if ($negocio->aprobado == true) {
                Mail::to($negocio->contacto_email)->send(new NegocioAprobado($negocio));
            }
        }
        $negocio->slug = Str::slug($negocio->nombre);
        $negocio->saveQuietly();
    }

    /**
     * Handle the Negocio "deleted" event.
     */
    public function deleted(Negocio $negocio): void
    {
        //
    }

    /**
     * Handle the Negocio "restored" event.
     */
    public function restored(Negocio $negocio): void
    {
        //
    }

    /**
     * Handle the Negocio "force deleted" event.
     */
    public function forceDeleted(Negocio $negocio): void
    {
        //
    }
}
