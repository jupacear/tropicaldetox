<?php

namespace App\Http\Controllers;

use App\Models\Insumo;

use App\Models\detalle_pedidos;
use App\Models\pedido_personalizado;
use App\Models\Personalizado;
use App\Models\producPerz;
use Illuminate\Support\Facades\DB;
use App\Models\pedido;
use App\Models\Producto;

use App\Models\User;
use Illuminate\Http\Request;

class pedidoController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:pedidos', ['only' => ['create', 'store', 'destroy', 'edit', 'update', 'index']]);
    }
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

        return view('pedidos.create', ['productos' => Producto::all(), 'users' => User::all(), 'Insumo' => Insumo::all()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */







    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'nullable|max:500',
            'Usuario' => 'required',
            'ProductoID' => 'required|array',
            'ProductoID.*' => 'integer',
            'Total' => 'required|numeric', // Agrega la validación para el campo "Total"
        ]);

        $pedido = new Pedido();

        $pedido->Nombre = $request->input('Nombre');
        $pedido->Estado = "En_proceso";
        $pedido->Fecha = now();
        $pedido->id_users = $request->input('Usuario');
        $pedido->Total = $request->input('Total'); // Guarda el valor del campo "Total" ingresado por el usuario
        $pedido->save();

        $productos = $request->input('ProductoID');
        $cantidades = $request->input('Cantidad');
        // $personalizadosArray = $request->input('personalizadosArray');
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




   


        $personalizadosArray = json_decode($request->input('personalizadosArray'), true);
        foreach ($personalizadosArray as $personalizado) {
            // Guardar los datos del personalizado en la base de datos
            $insumos = $personalizado['insumos'];
            $id = '';

            foreach ($insumos as $insumo) {
                $insumoData = explode(':', $insumo);
                $id = trim($insumoData[0]);
                
                            $personalizadoModel = new producPerz();
                            $personalizadoModel->cantidad = 1;
                            $personalizadoModel->id_pedidos = $pedido->id;
                            $personalizadoModel->insumos = $id;
                            // ...
                            $personalizadoModel->save();
            }
        }

        $pedido->Total = $total;
        $pedido->save();

        $pedidos = Pedido::all();
        // return response()->json( $personalizadosArray);
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
        return view('pedidos.show', ['pedido' => $pedido, 'detalles_pedidos' => $detalles_pedidos,]);

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
        $pedidos = Pedido::find($id);
        $users = User::all(); // define la variable $users con todos los usuarios
        $detalles_pedidos = detalle_pedidos::where('id_pedidos', $id)->get();
        return view('pedidos.edit', ['pedidos' => $pedidos, 'pedido' => $pedido, 'detalles_pedidos' => $detalles_pedidos, 'productos' => Producto::all(), 'users' => $users, 'Insumo' => Insumo::all()]);
    }






    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */


    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'Estado' => 'required|max:200',
        ]);

        $pedido = Pedido::find($id);
        $pedido->Estado = $request->input('Estado');
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Estado actualizado correctamente');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'nullable|max:500',
            'Estado' => 'required|max:200',
            'Usuario' => 'required',
            'ProductoID' => 'required|array',
            'ProductoID.*' => 'integer',
            'Total' => 'required|numeric', // Agrega la validación para el campo "Total"
        ]);

        $pedido = Pedido::find($id);
        $pedido->Nombre = $request->input('Nombre');
        $pedido->Estado = $request->input('Estado');
        $pedido->id_users = $request->input('Usuario');
        $pedido->Total = $request->input('Total'); // Guarda el valor del campo "Total" ingresado por el usuario
        $pedido->save();

        // Eliminar los detalles de pedido existentes asociados con el pedido



        $productos = $request->input('ProductoID');
        $cantidades = $request->input('Cantidad');
        $total = 0;
        $pedido->detalle_pedidos()->delete();

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

        
   

   


        $personalizadosArray = json_decode($request->input('personalizadosArray'), true);

        if (!empty($personalizadosArray)) {
            foreach ($personalizadosArray as $personalizado) {
                $insumos = $personalizado['insumos'];
        
                foreach ($insumos as $insumo) {
                    $insumoData = explode(':', $insumo);
                    $id = trim($insumoData[0]);
                    
                    $personalizadoModel = new producPerz();
                    $personalizadoModel->cantidad = 1;
                    $personalizadoModel->id_pedidos = $pedido->id;
                    $personalizadoModel->insumos = $id;
                    // ...
                    $personalizadoModel->save();
                }
            }
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