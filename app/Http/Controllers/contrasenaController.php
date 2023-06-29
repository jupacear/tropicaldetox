<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //Necesario
use Illuminate\Support\Facades\Hash; //Necesario
use Illuminate\Support\Facades\DB; //Necesario

class contrasenaController extends Controller
{
    public function NewPassword2()
    {
        return view('profile.cambiarc');
    }

    public function changePassword2(Request $request)
{
    $request->validate([
        'password_actual' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
    ]);

    $user = Auth::user();
    $userPassword = $user->password;

    if (Hash::check($request->password_actual, $userPassword)) {
        $NuewPass = $request->password;
        $confirPass = $request->confirm_password;

        if ($NuewPass == $confirPass) {
            if (strlen($NuewPass) >= 6) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('updateClave', 'La clave fue cambiada correctamente.');
            } else {
                return redirect()->back()->with('clavemenor', 'Recuerde que la clave debe tener al menos 6 caracteres.');
            }
        } else {
            return redirect()->back()->with('claveIncorrecta', 'Por favor, verifique que las claves coincidan.');
        }
    } else {
        return back()->withErrors(['password_actual' => 'La clave actual no coincide.']);
    }
}

public function newcontrasena()
    {
        return view('cliente.cambiar');
    }

    public function changecontrasena(Request $request)
{
    $request->validate([
        'password_actual' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',
    ]);

    $user = Auth::user();
    $userPassword = $user->password;

    if (Hash::check($request->password_actual, $userPassword)) {
        $NuewPass = $request->password;
        $confirPass = $request->confirm_password;

        if ($NuewPass == $confirPass) {
            if (strlen($NuewPass) >= 6) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('updateClave', 'La clave fue cambiada correctamente.');
            } else {
                return redirect()->back()->with('clavemenor', 'Recuerde que la clave debe tener al menos 6 caracteres.');
            }
        } else {
            return redirect()->back()->with('claveIncorrecta', 'Por favor, verifique que las claves coincidan.');
        }
    } else {
        return back()->withErrors(['password_actual' => 'La clave actual no coincide.']);
    }
}

}


