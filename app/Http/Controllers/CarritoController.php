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
        $carrito = session('carrito.productos', []);
        return view('cliente.carrito', compact('carrito'));
    }

    public function agregarCarrito($productoId, $cantidad)
    {
        $producto = Producto::find($productoId);

        if ($producto) {
            $subtotal = $producto->precio * $cantidad;

            // Agregar los datos del producto al carrito de compras
            session()->push('carrito.productos', [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ]);

            // Redirigir al usuario al carrito de compras
            // return redirect()->route('carrito')->with('success', 'Producto agregado al carrito correctamente.');

        }

        // Redirigir al usuario en caso de no encontrar el producto
        return redirect()->back()->with('error', 'No se encontró el producto.');
    }
    public function eliminarProductoCarrito($indice)
    {
        $carrito = session('carrito.productos', []);

        if (isset($carrito[$indice])) {
            unset($carrito[$indice]);
            session(['carrito.productos' => $carrito]);
            return redirect()->route('carrito')->with('success', 'Producto eliminado del carrito correctamente.');
        }

        return redirect()->back()->with('error', 'No se encontró el producto en el carrito.');
    }
    public function actualizarCantidadCarrito(Request $request, $indice)
    {
        $carrito = session('carrito.productos', []);

        if (isset($carrito[$indice])) {
            $cantidad = $request->input('cantidad');
            $subtotal = $carrito[$indice]['precio'] * $cantidad;

            $carrito[$indice]['cantidad'] = $cantidad;
            $carrito[$indice]['subtotal'] = $subtotal;

            session(['carrito.productos' => $carrito]);
            return redirect()->route('carrito')->with('success', 'Cantidad del producto actualizada correctamente.');
        }

        return redirect()->back()->with('error', 'No se encontró el producto en el carrito.');
    }
    public function store(){
        // Obtener el usuario autenticado
    }
    
}
