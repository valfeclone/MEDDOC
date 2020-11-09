<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_view ()
    {
        return view('pages2.admin.admin-data', [
            'admin' => Admin::class
        ]);
    }
    public function handleLogin (Request $req)
    {
        $credentials = $req->only('email', 'password');
        
        if (Auth::guard('admins')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        } 
        else{
            return back()->withErrors(['field_name' => ['Login Gagal']]);
        }
    }
}
