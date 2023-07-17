<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert; // Importa la clase Alert
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;



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
                    
                    Session::flash('sweet-alert', [
                        'type' => 'success',
                        'title' => 'Clave cambiada',
                        'text' => 'La clave fue cambiada correctamente.'
                    ]);

                    return redirect()->back();
                } else {
                    dd('clave incorrecta papa pero 2');
                    Alert::error('Clave incorrecta', 'Recuerde que la clave debe tener al menos 6 caracteres .');
                    return redirect()->back();
                }
            } else {
                
                Alert::error('Clave incorrecta', 'Por favor, verifique que las claves coincidan.');
                return redirect()->back();
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

                    Session::flash('sweet-alert', [
                        'type' => 'success',
                        'title' => 'Clave cambiada',
                        'text' => 'La clave fue cambiada correctamente.'
                    ]);

                    
                    return redirect()->back()->with('success', 'La clave fue cambiada correctamente.');
                } else {
                    Alert::error('Clave incorrecta', 'Recuerde que la clave debe tener al menos 6 caracteres.');
                    return redirect()->back();
                }
            } else {
                
                Alert::error('Clave incorrecta', 'Por favor, verifique que las claves coincidan.');
                return redirect()->back();
            }
        } else {
            return back()->withErrors(['password_actual' => 'La clave actual no coincide.']);
            
        }
    }
}
