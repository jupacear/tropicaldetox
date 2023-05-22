<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

/**
 * Class InsumoController
 * @package App\Http\Controllers
 */
class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $insumos = Insumo::paginate();

    //     return view('insumo.index', compact('insumos'))
    //         ->with('i', (request()->input('page', 1) - 1) * $insumos->perPage());
    // }
    public function index()
    {
        $url = 'http://127.0.0.1:8000/api/insumos'; // URL de la API
        $response = Http::get($url); // Realizar la solicitud GET a la API

        if ($response->successful()) {
            $insumos = $response->json(); // Obtener los datos JSON de la respuesta

            // Pasar los datos a la vista
            return view('insumo.index', compact('insumos'));
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();
            return back()->withError($errorMessage);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $url = 'http://127.0.0.1:8000/api/insumos'; // URL de la API

        $response = Http::get($url); // Realizar la solicitud GET a la API
        if ($response->successful()) {
            $insumos = $response->json(); // Obtener los datos JSON de la API

            return view('insumo.create', compact('insumos'));
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            // Redireccionar con mensaje de error
            return redirect()->back()->withError($errorMessage);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = 'http://127.0.0.1:8000/api/insumos'; // URL de la API

        // Obtener los datos del formulario de creación del insumo
        $data = $request->except('imagen');
        $data['activo'] = $request->has('activo'); // Convertir el valor del checkbox a booleano

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nuevo nombre para el archivo
            $newName = time() . '_' . $image->getClientOriginalName();

            // Agregar el nombre del archivo al arreglo de datos
            $data['imagen'] = $newName;

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $newName);
        }

        // Convertir los datos a JSON
        $jsonData = json_encode($data);
        dd($data);
        // Realizar la solicitud POST a la API para crear el insumo
        $response = Http::post($url, [], ['body' => $jsonData, 'headers' => ['Content-Type' => 'application/json']]);

        if ($response->successful()) {
            return redirect()->route('insumo.index')->with('success', 'Insumo creado correctamente');
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            return redirect()->back()->withError($errorMessage);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = 'http://127.0.0.1:8000/api/insumos/' . $id; // URL de la API

        $response = Http::get($url); // Realizar la solicitud GET a la API

        if ($response->successful()) {
            $insumo = $response->json(); // Obtener los datos JSON del insumo

            return view('insumo.show', compact('insumo'));
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            // Redireccionar con mensaje de error
            return redirect()->back()->withError($errorMessage);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscar el insumo por su ID
        $insumo = Insumo::find($id);

        return view('insumo.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate(Insumo::$rulesUpdate);

        // Obtener el insumo por su ID
        $insumo = Insumo::find($id);

        // Verificar si se encontró el insumo
        if (!$insumo) {
            return redirect()->back()->with('error', 'El insumo no existe');
        }

        // Obtener el valor del checkbox de estado "activo"
        $activo = $request->has('activo') ? true : false;

        // Verificar si se ha enviado un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtener el archivo de imagen
            $image = $request->file('imagen');

            // Generar un nombre único para la imagen usando la marca de tiempo actual
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen a la carpeta "public/img/InsumoIMG" dentro del directorio público
            $image->move(public_path('img/InsumoIMG'), $imageName);

            // Eliminar la imagen anterior si existe
            if ($insumo->imagen) {
                $oldImagePath = public_path('img/InsumoIMG') . '/' . $insumo->imagen;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Actualizar el campo 'imagen' del modelo con la nueva ruta de la imagen
            $insumo->imagen = 'img/InsumoIMG/' . $imageName;
        }

        // Actualizar los demás campos del insumo
        $insumo->nombre = $request->input('nombre');
        $insumo->activo = $activo;
        $insumo->cantidad_disponible = $request->input('cantidad_disponible');
        $insumo->unidad_medida = $request->input('unidad_medida');
        $insumo->precio_unitario = $request->input('precio_unitario');

        // Guardar los cambios en la base de datos
        $insumo->save();

        return redirect()->route('insumo.index')
            ->with('success', 'Insumo actualizado correctamente');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $url = 'http://127.0.0.1:8000/api/insumos/' . $id; // URL de la API

        $response = Http::delete($url); // Realizar la solicitud DELETE a la API

        if ($response->successful()) {
            $responseData = $response->json(); // Obtener los datos JSON de la respuesta

            // Verificar el estado actual del insumo en la respuesta
            $isActive = $responseData['activo'];

            if ($isActive) {
                $message = 'Insumo desactivado exitosamente';
            } else {
                $message = 'Insumo activado exitosamente';
            }

            // Redireccionar a la lista de insumos con mensaje de éxito
            return redirect()->route('insumo.index')->with('success', $message);
        } else {
            // Manejar el caso en que la solicitud no sea exitosa
            $errorMessage = $response->body();

            // Redireccionar con mensaje de error
            return redirect()->back()->withError($errorMessage);
        }
    }
}
