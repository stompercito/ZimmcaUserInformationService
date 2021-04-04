<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'codigo' => ['required'],
            'apellido_paterno' => ['required', 'string'],
            'apellido_materno' => ['required', 'string'],
            'direccion' => ['required', 'string'],
            'cp' => ['required', 'string'],
            'pais' => ['required', 'string'],
            'tel' => ['required'],
            'fecha' => ['required'],
            'ciudad' => ['required'],
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
        // $vendor = DB::table('vendors')
        //             ->where('id', $data['codigo'])
        //             ->first();

        // if($vendor != null){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data['apellido_materno'],
                'id_vendedor' => 0,
                'fecha_nacimiento' => $data['fecha'],
                'direccion' => $data['direccion'],
                'telefono' => $data['tel'],
                'cp' => $data['cp'],
                'pais' => $data['pais'],
                'estado' => 0,
                'ciudad' => $data['ciudad'],

            ]);

            //return $user;

            //return redirect('/partner/dashboard');
        
    }
}
