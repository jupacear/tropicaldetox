<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Necesario
use Illuminate\Support\Facades\DB; // Necesario

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

        return redirect()->back()->with('success', 'Los datos del perfil se han actualizado correctamente.');
    }
}
