<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;

class InsumoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $insumos = Insumo::all();

            return response()->json($insumos);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
            'imagen' => 'required|image|mimes:jpg,png|max:2048',
            'nombre' => 'required',
            'cantidad_disponible' => 'required|numeric',
            'unidad_medida' => 'required',
            'precio_unitario' => 'required|numeric',
            'activo' => 'boolean',
        ]);

        // Obtener la imagen del cuerpo de la solicitud
        $image = $request->file('imagen');

        // Verificar si se proporcionó una imagen
        if (!$image) {
            return response()->json(['error' => 'Debe proporcionar una imagen'], 400);
        }

        // Generar un nombre único para la imagen usando la marca de tiempo actual
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
        $image->move(public_path('img/InsumoIMG'), $imageName);

        // Crear una instancia del modelo Insumo con los demás datos del formulario
        $insumo = new Insumo([
            'nombre' => $request->input('nombre'),
            'cantidad_disponible' => $request->input('cantidad_disponible'),
            'unidad_medida' => $request->input('unidad_medida'),
            'precio_unitario' => $request->input('precio_unitario'),
            'activo' => $request->input('activo'),
            'imagen' => 'img/InsumoIMG/' . $imageName,
        ]);

        // Guardar el nuevo insumo en la base de datos
        $insumo->save();

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Insumo creado exitosamente'], 201);
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
            $insumo->imagen = 'img/InsumoIMG' . $imageName;
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
        $url = 'http://127.0.0.1:8000/api/insumos/' . $id; // URL de la API

        $response = Http::tiemeout(60)->delete($url); // Realizar la solicitud DELETE a la API

        if ($response->successful()) {
            $responseData = $response->json(); // Obtener los datos JSON de la respuesta

            // Verificar si la clave 'activo' existe en la respuesta
            if (isset($responseData['activo'])) {
                // Obtener el estado actual del insumo en la respuesta
                $isActive = $responseData['activo'];

                if ($isActive) {
                    $message = 'Insumo desactivado exitosamente';
                } else {
                    $message = 'Insumo activado exitosamente';
                }

                // Redireccionar a la lista de insumos con mensaje de éxito
                return redirect()->route('insumo.index')->with('success', $message);
            } else {
                // Manejar el caso en que la clave 'activo' no exista en la respuesta
                $errorMessage = 'La respuesta de la API no contiene la clave "activo"';

                // Redireccionar con mensaje de error
                return redirect()->back()->withError($errorMessage);
            }
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            // Redireccionar con mensaje de error
            return redirect()->back()->withError($errorMessage);
        }
    }
}
