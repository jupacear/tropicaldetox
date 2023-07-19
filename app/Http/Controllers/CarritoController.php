<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\detalle_pedidos;
use App\Models\pedido;
use App\Models\producPerz;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
 
    public function carrito()
    {
        
        return view('cliente.carrito');
    }

    public function store(){
        // Obtener el usuario autenticado
    }
    
}
