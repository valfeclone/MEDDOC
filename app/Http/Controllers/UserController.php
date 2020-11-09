<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function register()
    {
        $this->validate(request(), [
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_alamat' => 'required',
            'user_email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::create(request(['user_name', 'user_phone', 'user_email', 'password']));
        
        auth()->login($user);
        
        return redirect()->to('/dashboard');
    }

    public function login (Request $req)
    {
        $credentials = $req->only('user_email', 'password');
        
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        } 
        else{
            return back()->withErrors(['field_name' => ['Login Gagal']]);
        }
    }

    public function viewUserDetail(){
        $user = auth()->user();
        return view('akun', [
            'user' => $user
        ]);
    }

    public function updateUserDetail(Request $request){
        $user = auth()->user();
        if($user) {
			$user->user_name = $request->user_name;
            $user->user_phone = $request->user_phone;
            $user->user_alamat = $request->user_alamat;
			$user->user_email = $request->user_email;
			$user->save();
		}  
    }

    public function viewInvoice($id){
        $user = auth()->user();
        if($user) {
            $intended = Invoice::find($id);
            echo $intended;
		}  
    }
}
