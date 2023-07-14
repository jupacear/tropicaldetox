<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Necesario
use Illuminate\Support\Facades\DB; // Necesario
use RealRashid\SweetAlert\Facades\Alert;// Importa la clase Alert
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

class UserSettingsController extends Controller
{
    public function NewPassword()
    {
        return view('profile.configure_user_profile');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $request->validate([
            'name' => 'required|max:50',
            'apellidos' => 'nullable|max:50',
            'documento' => 'nullable|string|max:10|unique:users,documento,' . $userId,
            'telefono' => 'nullable|max:10',
            'direccion' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $userId,
        ]);

        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->documento = $request->documento;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->email = $request->email;

        $user->save();

        Session::flash('sweet-alert', [
            'type' => 'success',
            'title' => 'Datos actualizados',
            'text' => 'Los datos de tu perfil fueron actualizados correctamente.'
        ]);

        return redirect()->back()->with('success', 'Los datos del perfil se han actualizado correctamente.');
    }

    public function newperfil()
    {
        return view('cliente.perfil');
    }

    public function changeperfil(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
    
        $request->validate([
            'name' => 'required|max:20',
            'apellidos' => 'required|max:30',
            'documento' => 'nullable|string|max:10|unique:users,documento,' . $userId,
            'telefono' => 'required|max:10',
            'direccion' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede exceder los 20 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max' => 'Los apellidos no pueden exceder los 30 caracteres.',
            'documento.required' => 'El documento es obligatorio.',
            'documento.max' => 'El documento no puede exceder los 10 caracteres.',
            'documento.unique' => 'El documento ya está en uso.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede exceder los 10 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
        ]);
    
        $user->name = $request->name;
        $user->apellidos = $request->apellidos;
        $user->documento = $request->documento;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->email = $request->email;
    
        $user->save();

        Session::flash('sweet-alert', [
            'type' => 'success',
            'title' => 'Datos actualizados',
            'text' => 'Los datos de tu perfil fueron actualizados correctamente.'
        ]);
    
        return redirect()->back()->with('success', 'Los datos del perfil se han actualizado correctamente.');
    }
}


