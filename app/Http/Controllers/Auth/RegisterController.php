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

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rol' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'apellido_paterno' => ['required', 'string', 'min:3'],
            'apellido_materno' => ['required', 'string', 'min:3'],
            'telefono_contacto_1' => ['required', 'string', 'min:8'],
            'fecha_nac' => ['required', 'string', 'min:8'],
            'genero' => ['required', 'string', 'min:1', 'max:1'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);       
        $user->roles()->attach(Role::where('name', 'user')->first());       
        $this->create_role_user($user->id,$data['rol']);
        $this->create_persona($user->id,$data);
        return $user;
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
            'email' => $data['email'],
            'telefono_contacto_1' => $data['telefono_contacto_1'],
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
}
