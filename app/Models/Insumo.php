<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 *
 * @property $id
 * @property $nombre
 * @property $cantidad_disponible
 * @property $unidad_medida
 * @property $precio_unitario
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Insumo extends Model
{

  static $rules = [
    'imagen' => 'required|image|mimes:jpg,png|max:2048',
    'nombre' => 'required',
    'activo' => '',
    'cantidad_disponible' => 'required',
    'unidad_medida' => 'required',
    'precio_unitario' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['imagen', 'nombre', 'cantidad_disponible', 'unidad_medida', 'precio_unitario', 'activo'];
}
