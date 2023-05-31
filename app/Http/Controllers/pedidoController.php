<?php

namespace App\Http\Controllers;

use App\Models\detalle_pedido;
use App\Models\detalle_pedidos;
use Illuminate\Support\Facades\DB;
use App\Models\pedido;
use App\Models\Producto;

use App\Models\User;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cargamos todos los pedidos y sus respectivos usuarios utilizando la función "with()"
        $pedidos = Pedido::with('users')->get();

        // Retornamos la vista "index" y le pasamos la variable "pedidos"
        $producto = Producto::all();


        // return view('pedidos.index', ["pedidos"=>$pedidos,"producto"=>$producto]);

        return view('pedidos.index', compact('pedidos'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornamos la vista "create" y le pasamos las variables "productos" y "users"

        return view('pedidos.create', ['productos' => Producto::all(), 'users' => User::all()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */









    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'Nombre' => 'nullable|max:200',
    //         'Telefono' => 'nullable|max:200',
    //         'Estado' => 'required|max:200',
    //         'Fecha' => 'required|date',
    //         'Usuario' => 'required',
    //         'ProductoID' => 'required|array',
    //         'ProductoID.*' => 'integer',
    //     ]);
    //     // return response()->json($request);



    //     $pedido = new Pedido();

    //     $pedido->Nombre = $request->input('Nombre');
    //     $pedido->Telefono = $request->input('Telefono');
    //     $pedido->Estado = $request->input('Estado');
    //     $pedido->Fecha = $request->input('Fecha');
    //     $pedido->id_users = $request->input('Usuario');
    //     $pedido->Total = 0;
    //     $pedido->save();

    //     $productos = $request->input('Productos');
    //     $cantidades = $request->input('Cantidad');
        

    //     $total = 0;


    //     foreach ($productos as $index => $producto_id) {
    //         $producto = Producto::find($producto_id);
    //         $detalles_pedidos = new detalle_pedidos();
    //         $detalles_pedidos->id_pedidos = $pedido->id;
    //         $detalles_pedidos->cantidad = $cantidades[$index];
    //         $detalles_pedidos->precio_unitario = $producto->precio;
    //         // $detalles_pedidos->precio_unitario =34;
    //         $detalles_pedidos->id_productos = $producto_id;
    //         $detalles_pedidos->Nombre = $producto->nombre;

    //         $subtotal = $detalles_pedidos->cantidad * $detalles_pedidos->precio_unitario;
    //         $total += $subtotal;

    //         $detalles_pedidos->save();
    //     }
     
        
    //     $pedido->Total = $total;
    //     $pedido->save();

    //     $pedidos = Pedido::all();

    //     return view('pedidos.index', compact('pedidos'));
    // }


    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'nullable|max:200',
            'Telefono' => 'nullable|max:200',
            'Estado' => 'required|max:200',
            'Fecha' => 'required|date',
            'Usuario' => 'required',
            'ProductoID' => 'required|array',
            'ProductoID.*' => 'integer',
            'Total' => 'required|numeric', // Agrega la validación para el campo "Total"
        ]);
    
        $pedido = new Pedido();
    
        $pedido->Nombre = $request->input('Nombre');
        $pedido->Telefono = $request->input('Telefono');
        $pedido->Estado = $request->input('Estado');
        $pedido->Fecha = $request->input('Fecha');
        $pedido->id_users = $request->input('Usuario');
        $pedido->Total = $request->input('Total'); // Guarda el valor del campo "Total" ingresado por el usuario
        $pedido->save();
    
        $productos = $request->input('ProductoID');
        $cantidades = $request->input('Cantidad');
        $total = 0;
    
        foreach ($productos as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            $detalles_pedidos = new detalle_pedidos();
            $detalles_pedidos->id_pedidos = $pedido->id;
            $detalles_pedidos->cantidad = $cantidades[$index];
            $detalles_pedidos->precio_unitario = $producto->precio;
            $detalles_pedidos->id_productos = $producto_id;
            $detalles_pedidos->Nombre = $producto->nombre;
    
            $subtotal = $detalles_pedidos->cantidad * $detalles_pedidos->precio_unitario;
            $total += $subtotal;
    
            $detalles_pedidos->save();
        }
    
        $pedido->Total = $total;
        $pedido->save();
    
        $pedidos = Pedido::all();
    
        return view('pedidos.index', compact('pedidos'));
    }
    




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Recuperar el pedido y sus detalles de la base de datos
        $pedido = Pedido::with('users')->find($id);

        $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();

        // Pasar el pedido y sus detalles a la vista
        return view('pedidos.show', ['pedido' => $pedido, 'detalles_pedidos' => $detalles_pedidos]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::with('users')->find($id);
        $users = User::all(); // define la variable $users con todos los usuarios
        $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();
        return view('pedidos.edit', ['pedido' => $pedido, 'detalles_pedidos' => $detalles_pedidos, 'productos' => Producto::all(), 'users' => $users]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'nullable|max:200',
            'Telefono' => 'nullable|max:200',
            'Estado' => 'required|max:200',
            'Fecha' => 'required|date',
            'Usuario' => 'required',
            'ProductoID' => 'required|array',
            'ProductoID.*' => 'integer',
            'Total' => 'required|numeric', // Agrega la validación para el campo "Total"
        ]);

        $pedido = Pedido::find($id);
       $pedido->Nombre = $request->input('Nombre');
        $pedido->Telefono = $request->input('Telefono');
        $pedido->Estado = $request->input('Estado');
        $pedido->Fecha = $request->input('Fecha');
        $pedido->id_users = $request->input('Usuario');
        $pedido->Total = $request->input('Total'); // Guarda el valor del campo "Total" ingresado por el usuario
        $pedido->save();
    
        $productos = $request->input('ProductoID');
        $cantidades = $request->input('Cantidad');
        $total = 0;
    
        foreach ($productos as $index => $producto_id) {
            $producto = Producto::find($producto_id);
            $detalles_pedidos = new detalle_pedidos();
            $detalles_pedidos->id_pedidos = $pedido->id;
            $detalles_pedidos->cantidad = $cantidades[$index];
            $detalles_pedidos->precio_unitario = $producto->precio;
            $detalles_pedidos->id_productos = $producto_id;
            $detalles_pedidos->Nombre = $producto->nombre;
    
            $subtotal = $detalles_pedidos->cantidad * $detalles_pedidos->precio_unitario;
            $total += $subtotal;
    
            $detalles_pedidos->save();
        }

        $pedido->Total = $total;
        $pedido->save();
    
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));

    }














    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        // Eliminar los detalles del pedido
        detalle_pedidos::where('id_pedidos', $pedido->id)->delete();

        // Eliminar el pedido
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente');
    }







}