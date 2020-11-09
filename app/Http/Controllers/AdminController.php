<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login (Request $req)
    {
        $credentials = $req->only('admin_email', 'password');
        
        if (Auth::guard('admins')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        } 
        else{
            return back()->withErrors(['field_name' => ['Login Gagal']]);
        }
    }
    
    #ban doctor
    public function banDoc($id){
        $admin = auth()->admin();
        if($admin) {
            $dokter = Doctor::find($id);
            $dokter->status_izin_praktik = false;
		} 
    }

    public function debanDoc($id){
        $admin = auth()->admin();
        if($admin) {
            $dokter = Doctor::find($id);
            $dokter->status_izin_praktik = true;
		} 
    }
    #delete functions
    public function deleteDoc($id){
        $admin = auth()->admin();
        if($admin) {
            $dokter = Doctor::find($id);
            $dokter->delete();
		} 
    }

    public function deleteUser($id){
        $admin = auth()->admin();
        if($admin) {
            $user = User::find($id);
            $user->delete();
		} 
    }

    #invoice
    public function updateInvoice ($id, Request $request){
        $admin = auth()->admin();
        if($admin) {
            $invoice = Invoice::find($id);
            $invoice->date_invoice = $request->date_invoice;
            $invoice->invoice_status = $request->invoice_status;
		}  
    }

    public function deleteInvoice($id){
        $admin = auth()->admin();
        if($admin) {
            $invoice = Invoice::find($id);
            $invoice->delete();
		}  
    }
}
