<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;


class UsuarioController extends Controller
{
    function __construct()
    {
         
         $this->middleware('permission:usuarios', ['only' => ['create','store' , 'destroy' , 'edit','update' , 'index' ]]);
         $this->middleware('permission:clientes', ['only' => ['createc','storec' , 'destroyc' , 'editc','updatec' , 'indexc' ]]);
    }


    public function adminDashboard()
    {
        // Lógica y datos necesarios para el dashboard del administrador

        return view('admin.dashboard');
    }

    public function admingrafica()
    {
        // Lógica y datos necesarios para el dashboard del administrador

        return view('admin.grafica');
    }

    public function clienteDashboard()
    {
        // Lógica y datos necesarios para el dashboard del cliente

        return view('cliente.dashboard');
    }

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        
         $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); 

        
        

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    //Clientes

    public function indexc(Request $request)
    {      
        
         $usuarios = User::all();
        return view('A_clientes.index',compact('usuarios')); 

        //Con paginación
        // $usuarios = User::paginate(10);
        // return view('A_clientes.index',compact('usuarios'));

        

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }





    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    //clientes

    public function createc()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('A_clientes.crear',compact('roles'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'apellidos' => 'required|max:50',
            'estado' => 'boolean',
            'documento' => 'nullable|string||max:10|unique:users,documento',
            'telefono' => 'nullable|max:10',
            'direccion' => 'nullable',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
            
        ]);

       
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        // Asegurarse de que el campo 'estado' esté presente en la solicitud y tener un valor booleano
        $input['estado'] = $request->has('estado');
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        $userEstado = $user->estado;
        return redirect()->route('usuarios.index')->with('userEstado', $userEstado);
       
        
    }

    //clientes

    public function storec(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'apellidos' => 'required|max:30',
            'estado' => 'boolean',
            'documento' => 'required|string|max:255|unique:users,documento',
            'telefono' => 'required|max:10',
            'direccion'=> 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
            
        ]);

       
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        // Asegurarse de que el campo 'estado' esté presente en la solicitud y tener un valor booleano
        $input['estado'] = $request->has('estado');
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        $userEstado = $user->estado;
        return redirect()->route('A_clientes.index')->with('userEstado', $userEstado);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('usuarios.show', compact('user'));

}

public function showc($id)
{
    $user = User::findOrFail($id);
    return view('A_clientes.show', compact('user'));

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('usuarios.editar',compact('user','roles','userRole'));
    }
    
    //clientes

    public function editc($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('A_clientes.editar',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'apellidos' => 'required',
            'estado' => 'boolean',
            'documento' => 'nullable',
            'telefono' => 'nullable',
            'direccion' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('usuarios.index');


        
    }

    //clientes

    public function updatec(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'apellidos' => 'required',
            'estado' => 'boolean',
            'documento' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('A_clientes.index');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }

    //clientes

    public function destroyc($id)
    {
        User::find($id)->delete();
        return redirect()->route('A_clientes.index');
    }

    public function updatePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Verificar si la contraseña actual ingresada coincide con la contraseña actual del usuario
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'La contraseña actual no es válida.']);
    }

    // Actualizar la contraseña
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->back()->with('success', 'La contraseña se ha actualizado correctamente.');
}

}