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
            'ime.required'=>'Име је обавезно за унос.',
            'ime.min'=>'Минимална дужина имена је :min.',
            'ime.max'=>'Максимална дужина имена је :max.',
            //username
            'username.required'=>'Корисничко име је обавезно за унос.',
            'username.min'=>'Минимална дужина корисничког имена је :min.',
            'username.max'=>'Максимална дужина корисничког имена је :max.',
            'username.unique'=>'Наведено корисничко име је у употреби.',
            //password
            'password.required'=>'Корисничка шифра је обавезна за унос.',
            'password.min'=>'Минимална дужина корисничке шифре је :min.',
            'password.max'=>'Максимална дужина корисничке шифре је :max.',
            'password.confirmed'=>'Унесене шифре се не поклапају.',
            //pass_conf
            'password_confirmation.required'=>'Корисничка шифра је обавезна за унос.',
            'password_confirmation.min'=>'Минимална дужина корисничке шифре је :min.',
            //email
            'email.required'=>'Мејл је обавезан за унос.',
            'email.email'=>'Погрешно унесен мејл.',
            'email.unique'=>'Наведени мејл је у употреби.',
            'email.max'=>'Максимална дужина мејла је :max.',
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
