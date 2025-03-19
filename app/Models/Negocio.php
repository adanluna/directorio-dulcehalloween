<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relations
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id', 'id');
    }

    // Scope
    public function scopeActivo($query)
    {
        return $query->where('activo', 1);
    }
    public function scopeAprobado($query)
    {
        return $query->where('aprobado', 1);
    }
    public function scopeBuscar($query, $value)
    {
        if ($value != '') {
            return $query->where('nombre', 'like', "%{$value}%")->orWhere('descripcion', 'like', "%{$value}%");
        }
    }
    public function scopeNombreScope($query, $value)
    {
        if ($value != '') {
            return $query->where('nombre', 'like', "%{$value}%");
        }
    }
    public function scopeDescripcionScope($query, $value)
    {
        if ($value != '') {
            return $query->where('descripcion', 'like', "%{$value}%");
        }
    }
    public function scopeCategoriaScope($query, $value)
    {
        if ($value != '') {
            return $query->where('categoria_id', $value);
        }
    }
    public function scopeSubcategoriaScope($query, $value)
    {
        if ($value != '') {
            return $query->where('subcategoria_id', $value);
        }
    }

}
