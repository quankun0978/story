<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/login';

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
        ], [
            'email.required' => 'Vui lòng không bỏ trống email.',
            'email.string' => 'Email phải là 1 chuỗi.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'email.max' => 'Email chỉ có tối đa 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.string' => 'Tên phải là 1 chuỗi.',
            'password.required' => 'Vui lòng không bỏ trống mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không chính xác.',
            'password.string' => 'Mật khẩu phải là 1 chuỗi.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request )
    { 
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required' => 'Vui lòng không bỏ trống email.',
            'email.string' => 'Email phải là 1 chuỗi.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'email.max' => 'Email chỉ có tối đa 255 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.string' => 'Tên phải là 1 chuỗi.',
            'password.required' => 'Vui lòng không bỏ trống mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không chính xác.',
            'password.string' => 'Mật khẩu phải là 1 chuỗi.',
        ]);
        $data=$request->all();
     User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    
        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }
}
