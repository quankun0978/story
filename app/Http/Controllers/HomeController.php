<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function changePassword()
    {
        return view('admin.user.changePassword');
    }
    public function logout()
    {
        Cookie::queue(Cookie::forget('laravel_session'));           
        return redirect()->route('admin');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([

            'password_old' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Vui lòng không bỏ trống mật khẩu mới',
            'password_old.required' => 'Vui lòng không bỏ trống mật khẩu ',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 kí tự.',
            'password.confirmed' => 'Mật khẩu mới nhập lại không chính xác.',
            'password.string' => 'Mật khẩu mới phải là 1 chuỗi.',
        ]);
        $data=$request->all();
        $user = User::findOrFail($data['id']);

        
        if(!Hash::check($data['password_old'],$user->password)){
        return redirect()->route('doi-mat-khau')->with('error', 'Mật khẩu cũ không chính xác');

       }
       $user->password=Hash::make($data['password']);
       $user->save();
    
        return redirect()->route('doi-mat-khau')->with('success', 'Đổi mật khẩu thành công');
    }
}
