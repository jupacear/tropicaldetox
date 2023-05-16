<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use App\Models\productos;
use App\Models\User;
use Illuminate\Http\Request;

class ventasController extends Controller
{
    public function index()
    {
        $ventas = Pedido::with('users')->get();
        return view('ventas.index', compact('ventas'));

    }
}
