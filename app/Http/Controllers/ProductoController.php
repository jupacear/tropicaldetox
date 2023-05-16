<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = new Producto();

        // Obtén las categorías disponibles (nombre y ID) desde el modelo de Categoría
        $categorias = Categorium::pluck('nombre', 'id');

        return view('producto.create', compact('producto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Producto::$rules);

        $producto = new Producto();

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categorias_id = $request->input('categorias_id');
        $producto->descripcion = $request->input('descripcion');
        $producto->activo = $request->input('activo');

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img'), $imageName);

            // Asignar la ruta de la imagen al modelo
            $producto->imagen = 'img/' . $imageName;
        }

        // Guardar el registro en la base de datos
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categorium::pluck('nombre', 'id');

        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate(Producto::$rules);
        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la nueva imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                $oldImagePath = public_path('img') . '/' . $producto->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar la ruta de la imagen en el modelo
            $producto->imagen = 'img/' . $imageName;
        }

        // Actualizar los atributos del producto
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->activo = $request->input('activo');
        $producto->categorias_id = $request->input('categorias_id');

        // Guardar los cambios en la base de datos
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto Eliminado correctamente');
    }
}
