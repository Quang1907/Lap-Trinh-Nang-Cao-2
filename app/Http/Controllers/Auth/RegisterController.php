<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'string', 'max:11'],
            'birthday' => ['required', 'string'],
            'address' => ['required', 'max:255'],
        ], [
            'name.required' => 'Vui long nhap ten nguoi dung',
            'name.string' => 'Ten nguoi dung phai la ky tu',
            'name.max' => 'Ten nguoi dung khong qua 255 ky tu',
            'email.required' => 'Vui long nhap email cua ban',
            'email.email' => 'Vui long nhap email cua ban',
            'email.unique' => 'Email cua ban da ton tai',
            'password.required' => 'Mat khau khong duoc de trong',
            'password.confirmed' => 'Ban chua nhap lai mat khau',
            'password.string' => 'Ban chua nhap lai mat khau',
            'phonenumber.required' => 'Ban chua nhap so dien thoai',
            'phonenumber.max' => 'SDT khong qua 11 so',
            'birthday.required' => 'Ngay sinh nhat cua ban la gi?',
            'address.required' => 'Dia chi khong duoc de trong',
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
        return User::create([
            'name' => $data['name'],
            'phonenumber' => $data['phonenumber'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'google_id' => null,
            'admin' => 0,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
