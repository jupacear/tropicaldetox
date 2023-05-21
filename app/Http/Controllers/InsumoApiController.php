<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InsumoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumos = Insumo::all();

        return response()->json($insumos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Insumo::$rules);

        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);
        }

        // Crea una instancia del modelo Insumo con los demás datos del formulario
        $insumo = new Insumo([
            'nombre' => $request->input('nombre'),
            'cantidad_disponible' => $request->input('cantidad_disponible'),
            'unidad_medida' => $request->input('unidad_medida'),
            'precio_unitario' => $request->input('precio_unitario'),
            'activo' => $request->input('activo',)
        ]);

        // Guardar la ruta de la imagen en la base de datos si se ha cargado
        if (isset($imageName)) {
            $insumo->imagen = 'img/InsumoIMG/' . $imageName;
        }

        // Guarda el nuevo insumo en la base de datos
        $insumo->save();

        // Devolver un mensaje de éxito personalizado
        $message = 'Insumo creado exitosamente: ' . $insumo->toJson();
        return response()->json(['message' => $message], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $insumo = Insumo::findOrFail($id);

        return response()->json($insumo);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);

        $request->validate(Insumo::$rulesUpdate);

        // Verificar si se ha cargado una nueva imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($insumo->imagen) {
                Storage::delete($insumo->imagen);
            }

            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);

            // Actualizar la propiedad "imagen" del modelo Insumo
            $insumo->imagen = 'img/InsumoIMG/' . $imageName;
        } else {
            // Actualizar los demás campos del modelo con los datos del formulario
            $insumo->nombre = $request->input('nombre');
            $insumo->cantidad_disponible = $request->input('cantidad_disponible');
            $insumo->unidad_medida = $request->input('unidad_medida');
            $insumo->precio_unitario = $request->input('precio_unitario');
            $insumo->activo = $request->input('activo');
        }

        // Guardar los cambios en la base de datos
        $insumo->save();

        // Devolver un mensaje de éxito personalizado
        $message = 'Insumo actualizado exitosamente: ' . $insumo->toJson();
        return response()->json(['message' => $message], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insumo = Insumo::findOrFail($id);


        // Verificar si se encontró el insumo
        if (!$insumo) {
            return redirect()->back()->with('error', 'El insumo no existe');
        }

        // Verificar el estado actual del insumo
        if ($insumo->activo) {
            // Si está activo, desactivarlo
            $insumo->activo = false;
            $message = 'Insumo desactivado exitosamente: ' . $insumo->toJson();
        } else {
            // Si está inactivo, activarlo
            $insumo->activo = true;
            $message = 'Insumo activado exitosamente: ' . $insumo->toJson();
        }

        // Guardar los cambios en la base de datos
        $insumo->save();

        return response()->json(['message' => 'Insumo actualizado exitosamente'], 204);
    }
}
