<?php

namespace App\Http\Controllers;

use App\Models\Categorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoriumController
 * @package App\Http\Controllers
 */
class CategoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categorium::paginate();

        return view('categorium.index', compact('categoria'))
            ->with('i', (request()->input('page', 1) - 1) * $categoria->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorium = new Categorium();
        return view('categorium.create', compact('categorium'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los campos según las reglas definidas en el modelo Categorium
        $request->validate(Categorium::$rules);

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img'), $imageName);

            // Crear el nuevo registro en la base de datos con la ruta de la imagen
            Categorium::create([
                'imagen' => 'img/' . $imageName,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'activo' => $request->has('activo') ? true : false,
            ]);
        } else {
            // Si no se ha enviado una imagen, crear el registro sin el campo de imagen
            Categorium::create($request->all());
        }

        return redirect()->route('categoria.index')
            ->with('success', 'Categoria creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorium = Categorium::find($id);

        return view('categorium.show', compact('categorium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorium = Categorium::find($id);

        return view('categorium.edit', compact('categorium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categorium $categorium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscar la categoría por ID
        $categoria = Categorium::find($id);

        // Verificar si se encontró la categoría
        if (!$categoria) {
            return redirect()->back()->with('error', 'La categoría no existe');
        }

        // Validar los datos del formulario 
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,png|max:2048',
            'nombre' => 'required',
            'descripcion' => 'required',
            'activo' => 'required',
        ]);

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la nueva imagen a la carpeta "img" dentro del directorio público
            $image->move(public_path('img'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($categoria->imagen) {
                $oldImagePath = public_path('img') . '/' . $categoria->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar la ruta de la imagen en el modelo
            $categoria->imagen = 'img/' . $imageName;
        }

        // Actualizar los atributos de la categoría
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        $categoria->activo = $request->input('activo');

        // Guardar los cambios en la base de datos
        $categoria->save();

        // Mostrar mensaje de éxito al redireccionar
        return redirect()->route('categoria.index')->with('success', 'Categoría actualizada exitosamente');
    }



    /**
     * Elimina una categoría.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // Buscar la categoría por ID
        $categoria = Categorium::find($id);

        // Verificar si se encontró la categoría
        if (!$categoria) {
            return redirect()->back()->with('error', 'La categoría no existe');
        }

        // Desactivar la categoría
        $categoria->activo = false;
        $categoria->save();

        // Desactivar los productos relacionados
        $categoria->productos()->update(['activo' => false]);

        // Redireccionar a la lista de categorías con mensaje de éxito
        return redirect()->route('categoria.index')
            ->with('success', 'Categoria desactivada exitosamente');
    }
}
