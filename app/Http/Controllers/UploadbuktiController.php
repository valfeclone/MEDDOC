<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class UploadbuktiController extends Controller
{
	public function upload(){
		return view('upload_bukti');
	}
 
	public function proses_upload(Request $request){
		$this->validate($request, [
			'file_bukti_pembayaran' => 'required',
		]);

	    // menyimpan data file yang diupload ke variabel $file
	    $file = $request->file('file_bukti_pembayaran');

		// menyimpan data file yang diupload ke variabel $file
        $tujuan_upload = storage_path('app/bukti_pembayaran');
        $file->move($tujuan_upload,$file->getClientOriginalName());

		$user = auth()->user();
		if($user) {
			$user->path_bukti_bayar = $file->getClientOriginalName();
			$user->save();
		}

        echo "upload bukti sukses";
	}
}