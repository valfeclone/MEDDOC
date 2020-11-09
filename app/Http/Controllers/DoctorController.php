<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index_view ()
    {
        return view('pages2.doctor.doctor-data', [
            'doctor' => Doctor::class
        ]);
    }
    public function handleLogin (Request $req)
    {
        $credentials = $req->only('email', 'password');
        
        if (Auth::guard('doctors')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        } 
        else{
            return back()->withErrors(['field_name' => ['Login Gagal']]);
        }
    }
}