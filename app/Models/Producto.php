<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $imagen
 * @property $nombre
 * @property $precio
 * @property $descripcion
 * @property $categorias_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Categorium $categorium
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

  static $rules = [
    'imagen' => 'required|image|mimes:jpg,png|max:2048',
    'nombre' => 'required',
    'precio' => 'required',
    'descripcion' => 'required',
    'activo' => 'required',
    'categorias_id' => 'required'
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['imagen', 'nombre', 'precio', 'descripcion', 'activo', 'categorias_id'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function categorium()
  {
    return $this->hasOne('App\Models\Categorium', 'id', 'categorias_id');
  }
}
