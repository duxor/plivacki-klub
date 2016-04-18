<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $username = 'username';
    protected $redirectAfterLogout = '/' ;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'ime' => 'required|min:3|max:255',
            'username' => 'required|min:4|max:255|unique:korisnici',
            'password' => 'required|confirmed|min:6|max:255',
            'email' => 'required|email|max:255|unique:korisnici',
        ], [
            //ime
            'ime.required'=>'Ime je obavezno za unos.',
            'ime.min'=>'Minimalna dužina je :min.',
            'ime.max'=>'Maksimalna dužina je :max.',
            //username
            'username.required'=>'Korisničko ime je obavezno za unos.',
            'username.min'=>'Minimalna dužina korisničkog imena je :min.',
            'username.max'=>'МMaksimalna dužina korisničkog imena je :max.',
            'username.unique'=>'Navedeno korisničko ime je u upotrebi.',
            //password
            'password.required'=>'Korisnička šifra je obavezna za unos.',
            'password.min'=>'Minimalna dužina korisničke šifre je :min.',
            'password.max'=>'Maksimalna dužina korisničke šifre je :max.',
            'password.confirmed'=>'Unesene šifre se ne poklapaju.',
            //pass_conf
            'password_confirmation.required'=>'Korisnička šifra je obavezna za unos.',
            'password_confirmation.min'=>'Minimalna dužina korisničke šifre je :min.',
            //email
            'email.required'=>'E-mail je obavezan za unos.',
            'email.email'=>'Pogrešno unesen e-mail.',
            'email.unique'=>'Navedeni e-mail je u upotrebui.',
            'email.max'=>'Maksimalna dužina e-mail-a je :max.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'ime' => $data['ime'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
