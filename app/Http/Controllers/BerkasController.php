<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SA_MasterUser;
use App\Model\SA_Dosen;
use App\Model\SA_Tendik;
use App\Model\SA_Mahasiswa;
use App\Model\Formkp;
use App\Model\Berkas;
use App\Model\Nilai;
use App\Model\Mitrakp;
use App\Model\Approval;
use Auth;
use DB;
use Exception;
use Session;
use URL;

class BerkasController extends Controller
{
    public function berkasmhs()
    {
        try {
            $users = Auth::user();
            $id_users = $users->id_users;
            $id_mhs = SA_Mahasiswa::where('id_users',$id_users)->first();

            $data = Berkas::select('*')
            ->where('id_mhs',$id_mhs->id_mhs)
            ->get();

            return view('pages/mahasiswa/my_berkas',[
                'berkas' => $data,
            ]);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return $data;
            
        }
    }

    public function detailberkas(Request $request,$id,$idkp)
    {

        try {

            $berkas['data'] = Berkas::where('id_mhs',$id)->where('id_formkp',$idkp)->get();

            return json_encode($berkas);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return $data;
            
        }

    }

    public function detailnilai(Request $request,$id)
    {

        try {

            $berkas['data'] = Nilai::where('id_mhs',$id)->get();

            return json_encode($berkas);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return $data;
            
        }

    }

    public function sendberkastendik(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required',
        ]);
        try {
            $users = Auth::user();
            $id_users = $users->id_users;
        
            $id_mhs = $request->bid_mhs;
            $id_formkp = $request->bid_formkp;
            $module = $request->title;

            $file = $request->file('file');

            $nama_file = $module."_".time()."_".$file->getClientOriginalName();

            $berkas = Berkas::create([
                'id_formkp' => $id_formkp,
                'id_users' => $id_users,
                'id_mhs' => $id_mhs,
                'module' => $module,
                'nama_file' => $nama_file,
                'isStatus' => 5,
            ]);

            $tujuan_upload = 'data_berkas';
            $file->move($tujuan_upload,$nama_file);

            //send mail
            $toMahasiswa = SA_Mahasiswa::where('id_mhs',$id_mhs)->with('users')->first();

            $module = 'Pengiriman Berkas Tendik';
            $email = $toMahasiswa->users->email;
            $nama = $toMahasiswa->nama;
            $text = 'Tendik mengirimkan berkas kepada anda , silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return redirect()->route('tendik.datamhs')->with('status', 'berkas berhasil dikirim');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('tendik.datamhs')->with('status', $e->getMessage());

            
        }
    }

    public function sendberkasdosen(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required',
        ]);
        try {
            $users = Auth::user();
            $id_users = $users->id_users;
        
            $id_mhs = $request->bid_mhs;
            $id_formkp = $request->bid_formkp;
            $module = $request->title;

            $file = $request->file('file');

            $nama_file = $module."_".time()."_".$file->getClientOriginalName();

            $berkas = Berkas::create([
                'id_formkp' => $id_formkp,
                'id_users' => $id_users,
                'id_mhs' => $id_mhs,
                'module' => $module,
                'nama_file' => $nama_file,
                'isStatus' => 6,
            ]);

            $tujuan_upload = 'data_berkas';
            $file->move($tujuan_upload,$nama_file);

            //send mail
            $toMahasiswa = SA_Mahasiswa::where('id_mhs',$id_mhs)->with('users')->first();

            $module = 'Pengiriman Berkas Dosen';
            $email = $toMahasiswa->users->email;
            $nama = $toMahasiswa->nama;
            $text = 'Dosen mengirimkan berkas kepada anda , silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return redirect()->back()->with('status', 'berkas berhasil dikirim');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->back()->with('status', $e->getMessage());

            
        }
    }

    public function uploadberkasmhs(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required',
        ]);
        try {
            $users = Auth::user();
            $id_users = $users->id_users;

            $mhs = SA_Mahasiswa::where('id_users',$id_users)->first();

            $getformkp = Formkp::where('id_mhs',$mhs->id_mhs)->where('isStatus','!=',99)->first();
        
            $id_mhs = $mhs->id_mhs;
            $id_formkp = $getformkp->id_formkp;
            $module = $request->title;

            $file = $request->file('file');

            $nama_file = $module."_".time()."_".$file->getClientOriginalName();

            $berkas = Berkas::create([
                'id_formkp' => $id_formkp,
                'id_users' => $id_users,
                'id_mhs' => $id_mhs,
                'module' => $module,
                'nama_file' => $nama_file
            ]);

            $tujuan_upload = 'data_berkas';
            $file->move($tujuan_upload,$nama_file);

            //send mail
            $toTendik = SA_Tendik::where('id_jurusan',$mhs->id_jurusan)->with('users')->first();

            $module = 'Pengiriman Berkas Mahasiswa';
            $email = $toTendik->users->email;
            $nama = $toTendik->nama;
            $text = 'Mahasiswa atas nama '.$mhs->nama.'('.$mhs->nim.') mengirimkan berkas yang membutuhkan persetujuan anda , silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);


            return redirect()->route('myberkas')->with('status', 'berkas berhasil dikirim');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('myberkas')->with('status', $e->getMessage());

            
        }
    }

}
