<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\RoleUser;
use App\Persona;
use App\Profesor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }
   

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rol' => ['required'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:15', 'confirmed'],
            'apellido_paterno' => ['required', 'string', 'min:3','max:100'],
            'apellido_materno' => [ 'string', 'min:3','max:100'],
            'direccion' => [ 'string', 'min:3','max:255'],
            'telefono_contacto_1' => ['required', 'string', 'min:8','max:20'],
            'telefono_contacto_1' => ['required', 'string', 'min:8','max:20'],
            'fecha_nac' => ['required', 'string', 'min:8'],
            'genero' => ['required', 'string'],
        ]);
    }

    protected function store(Request $request)
    {
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);       
        $user->roles()->attach(Role::where('name', 'user')->first());       
        $this->create_role_user($user->id,$request->rol);
        $this->create_persona($user->id,$request);
       

        return redirect('admin/usuarios')->with('success', 'Se creo el usuario correctamente...!');
    }
    public function create_role_user($id_u,$id_r){
        $rol_user = RoleUser::create([
            'role_id' => $id_r,
            'user_id' => $id_u,
        ]);
    }
    //Se crea la persona a partir del usuario
    public function create_persona($id_u, $data){
        $persona = Persona::create([
            'nombres' => $data['name'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'direccion' => $data['direccion'],
            'email' => $data['email'],
            'telefono_contacto_1' => $data['telefono_contacto_1'],
            'telefono_contacto_2' => $data['telefono_contacto_2'],
            'fecha_nac' => $data['fecha_nac'],
            'genero' => $data['genero'],
            'user_id' => $id_u,
        ]);
        //Se crea el profesor a partir de la persona
        if ($data['rol']==3) {
            $this->create_profesor($persona->id);
        }
    }
    //Se crea el profesor a partir de la persona
    public function create_profesor($id){
        $profesor = Profesor::create([
                'persona_id'=>$id
        ]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::find($id);
        if ($user) {
            $roleUser = RoleUser::where('user_id',$user->id)->first();
            $persona = Persona::where('user_id',$user->id)->first();
            if ($persona) {
                $profesor = Profesor::where('persona_id',$persona->id)->first();
                if ($profesor) {
                    $profesor->delete();
                }
                $persona->delete();
            }
                $roleUser->delete();    
                $user->delete();
        }
        return redirect('admin/usuarios')->with('success', 'Usuario eliminado...!');
    }
}
