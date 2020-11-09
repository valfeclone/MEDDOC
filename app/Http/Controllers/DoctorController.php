<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function register()
    {
        $this->validate(request(), [
            'dokter_name' => 'required',
            'dokter_phone' => 'required',
            'dokter_email' => 'required|email',
            'password' => 'required'
        ]);
        
        $dokter = Doctor::create(request(['dokter_name', 'dokter_email', 'password']));
        
        auth()->login($dokter);
        
        return redirect()->to('/dashboard');
    }

    public function login (Request $req)
    {
        $credentials = $req->only('dokter_email', 'password');
        
        if (Auth::guard('dokter')->attempt($credentials)) {
            return redirect()->intended('dashboard');
        } 
        else{
            return back()->withErrors(['field_name' => ['Login Gagal']]);
        }
    }

    public function viewDocDetail(){
        $dokter = auth()->dokter();
        return view('akun', [
            'dokter' => $dokter
        ]);
    }

    public function updateDocDetail(Request $request){
        $dokter = auth()->dokter();
        if($dokter) {
			$dokter->dokter_name = $request->dokter_name;
			$dokter->dokter_phone = $request->dokter_phone;
			$dokter->dokter_email = $request->dokter_email;
			$dokter->save();
		}  
    }

    public function uploadIzinPraktik(Request $request){
		$this->validate($request, [
			'file_izin_praktik' => 'required',
		]);

	    // menyimpan data file yang diupload ke variabel $file
	    $file = $request->file('file_izin_praktik');

		// menyimpan data file yang diupload ke variabel $file
        $tujuan_upload = storage_path('app/izin_praktik');
        $file->move($tujuan_upload,$file->getClientOriginalName());

		$dokter = auth()->dokter();
		if($dokter) {
			$dokter->path_izin_praktik = $file->getClientOriginalName();
			$dokter->save();
		}

        echo "upload bukti sukses";
    }
    
    public function viewAllInvoice(){
        $dokter = auth()->dokter();
        if($dokter) {
            return view('invoices');
		}  
    }
}