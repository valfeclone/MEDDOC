<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class UploadFileLombaController extends Controller
{
	public function upload(){
		$user = auth()->user();
		$lomba = $user->lomba;
		return view('upload_file')->with('lomba', $lomba);
	}
 
	public function proses_upload(Request $request){
		$this->validate($request, [
			'file_lomba' => 'required',
		]);

	    // menyimpan data file yang diupload ke variabel $file
	    $file = $request->file('file_lomba');

		// menyimpan data file yang diupload ke variabel $file
        $tujuan_upload = storage_path('app/file_lomba');
        $file->move($tujuan_upload,$file->getClientOriginalName());
		
		$user = auth()->user();
		if($user) {
			$user->path_file_lomba = $file->getClientOriginalName();
			$user->save();
		}

        echo "upload file sukses";
	}

	public function proses_upload_link(Request $request){
		$this->validate($request, [
			'link_file_lomba' => 'required',
		]);

		$user = auth()->user();
		if($user) {
			$user->path_file_lomba = $request->link_file_lomba;
			$user->save();
		}

        echo "upload link sukses";
	}
}