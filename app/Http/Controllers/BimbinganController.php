<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GenerateMailController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SA_MasterUser;
use App\Model\SA_Dosen;
use App\Model\SA_Mahasiswa;
use App\Model\SA_Koordinator;
use App\Model\SA_Tendik;
use App\Model\Formkp;
use App\Model\Berkas;
use App\Model\Mitrakp;
use App\Model\Approval;
use App\Model\BimbinganDosen;
use Auth;
use DB;
use Exception;
use Session;
use Illuminate\Support\Carbon;
use URL;

class BimbinganController extends Controller
{
    
    ////////////////////////////// DOSEN PEMBIMBING //////////////////////////////////

    public function mhsdosenindex()
    {
        $user = Auth::User();
        $mhs = SA_Mahasiswa::where('id_users',$user->id_users)->first();

        $formkp = Formkp::where('id_mhs',$mhs->id_mhs)
        ->where('isStatus','!=',99)
        ->first();

        $mydata = DB::table('tbl_bimbingan_dosen')
        ->where('id_mhs',$mhs->id_mhs)
        ->get();

        $datapembimbing = BimbinganDosen::where('id_mhs',$mhs->id_mhs)
        ->where('isReply',1)
        ->get();

        return view('pages/mahasiswa/bimbingan-dosen',[
            'formkp' => $formkp,
            'datamhs' => $mydata,
            'bimbingan' => $datapembimbing,
        ]);
    }

    public function dosenstore(Request $request)
    {
        $users = Auth::user();
        $id_users = $users->id_users;
        $request->validate([
            'tahapan' => 'required',
            'keterangan' => 'required',
            'file' => 'required',
        ]);
        try {

            $file = $request->file('file');


            if(isset($file)) {

                $nama_file = $request->tahapan."_".time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'data_file';
                $file->move($tujuan_upload,$nama_file);
            } else {
                $nama_file = '';
            }

            $user = Auth::User();
            $mhs = SA_Mahasiswa::where('id_users',$user->id_users)->first();
            $getpembimbing = Formkp::where('id_mhs',$mhs->id_mhs)->where('isStatus','!=',99)->first();

            $bimb = DB::table('tbl_bimbingan_dosen');
            $bimb->insert([
                'id_formkp' => $getpembimbing->id_formkp,
                'id_mhs' => $mhs->id_mhs,
                'id_dosen' => $getpembimbing->dosen_pembimbing,
                'id_tahapan' => $request->tahapan,
                'lampiran' => $nama_file,
                'keterangan' => $request->keterangan
            ]);

           //send mail
            $toDosen = SA_Dosen::where('id_dosen',$getpembimbing->dosen_pembimbing)->with('users')->first();

            $module = 'Bimbingan Mahasiswa';
            $email = $toDosen->users->email;
            $nama = $toDosen->nama;
            $text = 'Mahasiswa atas nama '.$mhs->nama.'('.$mhs->nim.') melakukan bimbingan , silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return redirect()->route('mahasiswa.bimbingan.dosen')->with('status', 'berkas berhasil dikirim');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('mahasiswa.bimbingan.dosen')->with('status', $e->getMessage());

            
        }
    }

    public function dosenindex(Request $request)
    {
        if(!$request->year) {
            $year = Carbon::now()->format('Y');
        } else {
            $year = $request->year;
        }

        if(!$request->month) {
            $month = Carbon::now()->format('m');

        } else {
            
            $month = $request->month;
        }

        $user = Auth::user();

        $getdsn = SA_Dosen::where('id_users',$user->id_users)->first();

        $mybimbingan = BimbinganDosen::selectRaw('tbl_bimbingan_dosen.*,SUM(case when tbl_bimbingan_dosen.isReply = 0 then 1 else 0 end) as status_progress')
        ->where('id_dosen',$getdsn->id_dosen)
        ->whereYear('tbl_bimbingan_dosen.created_at', '=', $year)
        ->whereMonth('tbl_bimbingan_dosen.created_at', '=', $month)
        ->groupBy('id_mhs')
        ->with(['mahasiswa','dosen'])->get();

        // $tahapan = Formkp::where('id_formkp',$mybimbingan->id_formkp)->first();

        return view('pages/dosen/data-mahasiswa',[
            'mybimbingan' => $mybimbingan,
            // 'tahapan' => $tahapan->isStatus
        ]);
    }

    public function koorindex(Request $request)
    {
        if(!$request->year) {
            $year = Carbon::now()->format('Y');
        } else {
            $year = $request->year;
        }

        if(!$request->month) {
            $month = Carbon::now()->format('m');

        } else {
            
            $month = $request->month;
        }

        $user = Auth::user();

        $getdsn = SA_Dosen::where('id_users',$user->id_users)->first();
        
        $mybimbingan = BimbinganDosen::selectRaw('tbl_bimbingan_dosen.*,SUM(case when tbl_bimbingan_dosen.isReply = 0 then 1 else 0 end) as status_progress')
        ->where('id_dosen',$getdsn->id_dosen)
        ->whereYear('tbl_bimbingan_dosen.created_at', '=', $year)
        ->whereMonth('tbl_bimbingan_dosen.created_at', '=', $month)
        ->groupBy('id_mhs')
        ->with(['mahasiswa','dosen'])->get();

        // return $mybimbingan;


        // $tahapan = Formkp::where('id_formkp',$mybimbingan->id_formkp)->first();

        return view('pages/koordinator/bimbingan-mahasiswa',[
            'mybimbingan' => $mybimbingan,
            // 'tahapan' => $tahapan->isStatus
        ]);
    }

    public function detailbimbinganmhs($id_mhs,$id_dosen) {
            $getbimbingan = BimbinganDosen::select('tbl_bimbingan_dosen.*','t.nama_tahapan')
            ->leftJoin('tbl_tahapan as t','t.id_tahapan','tbl_bimbingan_dosen.id_tahapan')
            ->where('id_mhs',$id_mhs)
            ->where('id_dosen',$id_dosen)->get();

        return $getbimbingan;
    }

    public function tahapanaccmhs($idformkp) {
        $tap = Formkp::leftJoin('tbl_bimbingan_dosen','tbl_bimbingan_dosen.id_formkp','tbl_formkp.id_formkp')
        ->where('tbl_bimbingan_dosen.id_formkp',$idformkp)->orderBy('tbl_bimbingan_dosen.id_tahapan','desc')->first();
        return $tap->id_tahapan;
    }

    //lanjut kerjakan edit bimbingan untuk koor

    public function dosenreply($id) {
        $user = Auth::user();
        $id_users = $user->id_users;

        $getdsn = SA_Dosen::where('id_users',$user->id_users)->first();

        $mybimbingan = BimbinganDosen::findOrFail($id);

        $getbimbingan = BimbinganDosen::where('id_mhs',$mybimbingan->id_mhs)
        ->where('id_dosen',$mybimbingan->id_dosen)
        ->where('isReply',1)
        ->with(['mahasiswa','dosen'])->get();

        $raw = Formkp::where('id_mhs',$mybimbingan->id_mhs)->first();

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$mybimbingan->id_mhs)->with('users')->first();

        $module = 'Reply Bimbingan Mahasiswa';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Bimbingan anda sudah di periksa , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return view('pages/dosen/mybimbingan-reply',[
            'mybimbingan' => $mybimbingan,
            'getbimbingan' => $getbimbingan,
            'raw' => $raw,
        ]);
    }

    public function koorreply($id) {
        $user = Auth::user();
        $id_users = $user->id_users;

        $getdsn = SA_Dosen::where('id_users',$user->id_users)->first();

        $mybimbingan = BimbinganDosen::findOrFail($id);

        $getbimbingan = BimbinganDosen::where('id_mhs',$mybimbingan->id_mhs)
        ->where('id_dosen',$mybimbingan->id_dosen)
        ->where('isReply',1)
        ->with(['mahasiswa','dosen'])->get();

        $raw = Formkp::where('id_mhs',$mybimbingan->id_mhs)->first();

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$mybimbingan->id_mhs)->with('users')->first();

        $module = 'Reply Bimbingan Mahasiswa';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Bimbingan anda sudah di periksa , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return view('pages/koordinator/mybimbingan-reply',[
            'mybimbingan' => $mybimbingan,
            'getbimbingan' => $getbimbingan,
            'raw' => $raw,
        ]);
    }

    public function dosenreplyupdateacc(Request $request)
    {
        $request->validate([
            'aksi' => 'required',
        ]);
        $user = Auth::user();
        $id_users = $user->id_users;

        $mybimbingan = BimbinganDosen::findOrFail($request->id_bimbingan_dosen);
        $mhskp = Formkp::findOrFail($mybimbingan->id_formkp);
        $aksi = $request->aksi;
        //send mail
        $mail = new GenerateMailController;
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$mhskp->id_mhs)->with('users')->first();
        $getkoor = SA_Koordinator::where('id_prodi',$toMahasiswa->id_prodi)->with('users')->first();


        $module = 'Approval Bimbingan';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;

            if($aksi == 2) {
                $status = 4;
                if($mhskp->isStatus < 4) {
                    $mhskp->update([
                        'isStatus' => $status
                    ]);
                }

                $getbimbingan = BimbinganDosen::where('id_formkp',$mybimbingan->id_formkp)
                ->where('id_mhs',$mybimbingan->id_mhs)
                ->where('id_tahapan','!=',3)
                ->update(['isAcc' => 1]);

                $tahap = 'Proposal';

                $module1 = 'Klik Progres KP';
                $email1 = $getkoor->users->email;


                $nama1 = $getkoor->nama;
                $text1 = 'Klik Update Progress KP atas nama '.$nama.'('.$toMahasiswa->nim.') , silahkan cek aplikasi SIMKP';
                $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);

            }elseif($aksi == 4) {
                $status = 7;
                if($mhskp->isStatus > 4) {
                    $mhskp->update([
                        'isStatus' => $status
                    ]);
                }

                $getbimbingan = BimbinganDosen::where('id_formkp',$mybimbingan->id_formkp)
                ->where('id_mhs',$mybimbingan->id_mhs)
                ->where('id_tahapan','=',3)
                ->update(['isAcc' => 2]);

                $tahap = 'Seminar';

            }

            

            $text = $tahap.' anda telah di terima , silahkan cek aplikasi SIMKP';
            $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('dosen.bimbingan')->with('status','Data Berhasil Di Update!');

    }

    public function koorreplyupdateacc(Request $request)
    {
        
        $user = Auth::user();
        $id_users = $user->id_users;

        $request->validate([
            'aksi' => 'required',
        ]);

        $mybimbingan = BimbinganDosen::findOrFail($request->id_bimbingan_dosen);
        $mhskp = Formkp::findOrFail($mybimbingan->id_formkp);
        $aksi = $request->aksi;

        //send mail
        $mail = new GenerateMailController;
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$mhskp->id_mhs)->with('users')->first();
        $getkoor = SA_Koordinator::where('id_prodi',$toMahasiswa->id_prodi)->with('users')->first();

        $module = 'Approval Bimbingan';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        

            if($aksi == 2) {
                $status = 4;
                if($mhskp->isStatus < 4) {
                    $mhskp->update([
                        'isStatus' => $status
                    ]);
                }

                $getbimbingan = BimbinganDosen::where('id_formkp',$mybimbingan->id_formkp)
                ->where('id_mhs',$mybimbingan->id_mhs)
                ->where('id_tahapan','!=',3)
                ->update(['isAcc' => 1]);

                $tahap = 'Proposal';

                $module1 = 'Klik Progres KP';
                $email1 = $getkoor->users->email;


                $nama1 = $getkoor->nama;
                $text1 = 'Klik Update Progress KP atas nama '.$nama.'('.$toMahasiswa->nim.') , silahkan cek aplikasi SIMKP';
                $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);

            }elseif($aksi == 4) {
                $status = 7;
                if($mhskp->isStatus > 4) {
                    $mhskp->update([
                        'isStatus' => $status
                    ]);
                }

                $getbimbingan = BimbinganDosen::where('id_formkp',$mybimbingan->id_formkp)
                ->where('id_mhs',$mybimbingan->id_mhs)
                ->where('id_tahapan','=',3)
                ->update(['isAcc' => 2]);

                $tahap = 'Seminar';

            }

            
            $text = $tahap.' anda telah di terima , silahkan cek aplikasi SIMKP';
            $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('koor.bimbingan')->with('status','Data Berhasil Di Update!');

    }

    public function dosenreplyupdate(Request $request,$id)
    {
        $request->validate([
            'keterangan_dosen' => 'required',
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
    
            $nama_file = time()."_".$file->getClientOriginalName();

            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nama_file);
        } else {
            $nama_file = '';
        }


        $mybimbingan = BimbinganDosen::findOrFail($id);
        $mhskp = Formkp::findOrFail($mybimbingan->id_formkp);

        $mybimbingan->update([
            'keterangan_dosen' => $request->keterangan_dosen,
            'lampiran_dosen' => $nama_file,
            'isReply' => 1,
        ]);

        return redirect()->route('dosen.bimbingan')->with('status','Data Berhasil Di Update!');
    }

    public function koorreplyupdate(Request $request,$id)
    {
        $request->validate([
            'keterangan_dosen' => 'required',
        ]);
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
    
            $nama_file = time()."_".$file->getClientOriginalName();

            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nama_file);
        } else {
            $nama_file = '';
        }


        $mybimbingan = BimbinganDosen::findOrFail($id);
        $mhskp = Formkp::findOrFail($mybimbingan->id_formkp);

        $mybimbingan->update([
            'keterangan_dosen' => $request->keterangan_dosen,
            'lampiran_dosen' => $nama_file,
            'isReply' => 1,
        ]);

        return redirect()->route('koor.bimbingan')->with('status','Data Berhasil Di Update!');
    }

    public function aksibimbingan(Request $request) {
        $id = $request->id;
        $bimbingan = BimbinganDosen::findOrFail($id);
        $bimbingan->delete();

        return redirect()->back();
    }

    ////////////////////////////// END DOSEN PEMBIMBING //////////////////////////////////

    
}
