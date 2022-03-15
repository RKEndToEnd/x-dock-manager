<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Depot;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'depot_id' => 'required|exists:App\Models\Depot,id',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'name.required' => 'Wpisz imię.',
            'name.max' => 'Imię nie może być dłuższe niż 255 znaków.',
            'surname.required' => 'Wpisz nazwisko',
            'surname.max' => 'Nazwisko nie może być dłuższe niż 255 znaków.',
            'email.required' => 'Wpisz adres email.',
            'email.email' => 'Niewłaściwy format adresu email.',
            'email.max' => 'Adres email nie może być dłuiższy niż 255 znaków.',
            'email.unique' => 'Adres email istnieje w systemie. Skorzystaj z innego adresu email',
            'depot_id.required' => 'Wybierz depot z listy',
            'depot_id.exists' => 'Depot nie istnieje.',
            'password.required' => 'Wpisz hasło. Hasło musi zawierać min. 8 znaków.',
            'password.min' => 'Hasło musi zawierać min. 8 znaków.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'depot_id'=> $data['depot_id'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('observer');
        return $user;
    }
    public function showRegistrationForm()
    {
        $depots = Depot::all();
        return view('auth.register',compact('depots'));
    }
}
