<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenerateMailController;


use App\Model\Approval;
use App\Model\SA_Dosen;
use App\Model\SA_Koordinator;
use App\Model\SA_Tendik;
use App\Model\SA_Mahasiswa;
use App\Model\Formkp;
use App\Model\Berkas;
use Auth;
use DB;
use Exception;
use Session;
use URL;
use Illuminate\Support\Carbon;

class ApprovalController extends Controller
{
    public function reqdosenwali(Request $request)
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

        $dosen = SA_Dosen::where('id_users',$user->id_users)->first();

        $reqs = Approval::select('tbl_approval.*','tbl_mitrakp.*','users.name as rejectuser')
        ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_approval.id_formkp')
        ->leftJoin('tbl_formkp','tbl_formkp.id_formkp','tbl_approval.id_formkp')
        ->leftJoin('users','users.id_users','tbl_formkp.rejectedby')
        ->where('id_dosen', $dosen->id_dosen)
        ->whereYear('tbl_approval.created_at', '=', $year)
        ->whereMonth('tbl_approval.created_at', '=', $month)
        ->with(['mahasiswa'])
        ->get();

        return view('pages/dosen/pengajuan_req',[
            'reqs' => $reqs,
            ]);
    }

    public function accdosenwali(Request $request) 
    {
        try {

            $id = $request->id;
            $status = $request->status;
            $user = Auth::user();
            $id_users = $user->id_users;

            $reqs = Approval::findOrFail($id);
            $getmhs = SA_Mahasiswa::findOrFail($reqs->id_mhs);
            $gettendik = SA_Tendik::where('id_jurusan',$getmhs->id_jurusan)->with('users')->first();
            $getkoor = SA_Koordinator::where('id_prodi',$getmhs->id_prodi)->first();

            //send mail
            $toMahasiswa = SA_Mahasiswa::where('id_mhs',$reqs->id_mhs)->with('users')->first();

            $mail = new GenerateMailController;


            if($status == 'approved') {
                
                $module = 'pengajuanKP';

                $reqs->update([
                    'request_status' => 1
                ]);

                $kp = Formkp::findOrFail($reqs->id_formkp);
                $kp->update([
                    'isStatus' => 1
                ]);

                // =============================================================
                // forward to tendik

                

                $fwdtendik = Approval::create([
                    'id_users' => $reqs->id_users,
                    'id_mhs' => $reqs->id_mhs,
                    'id_formkp' => $reqs->id_formkp,
                    'id_tendik' => $gettendik->id_tendik,
                    'id_koor' => $getkoor->id_prodi,
                    'module' => $module,
                ]);

                $message = 'Approved Berhasil!';
                $statusacc = 'Di Terima';

                $module1 = 'Pendaftaran KP';
                $email1 = $gettendik->users->email;
                $nama1 = $gettendik->nama;
                $text1 = $getmhs->nama.'('.$getmhs->nim.') menunggu persetujuan anda, silahkan cek aplikasi SIMKP';

                $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);

            } else {
                $reqs->update([
                    'request_status' => 2
                ]);

                $kp = Formkp::findOrFail($reqs->id_formkp);
                $kp->update([
                    'isStatus' => 99,
                    'rejectedby' => $user->id_users
                ]);

                $berkas = Berkas::where('id_formkp',$reqs->id_formkp)->first();
                $berkas->update([
                    'isStatus' => 2
                ]);

                $message = 'Rejected Berhasil!';
                $statusacc = 'Di Tolak';
            }

            

            $module = 'Approval Dosen Wali';
            $email = $toMahasiswa->users->email;
            $nama = $toMahasiswa->nama;
            $text = $getmhs->nama.'('.$getmhs->nim.') pendaftaran KP anda '.$statusacc.', silahkan cek aplikasi SIMKP';
            
            


            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return redirect()->route('dosen.request.index')->with('status', $message);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('dosen.request.index')->with('status', $e->getMessage());

            
        }
    }

    public function reqtendik(Request $request)
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
        

        try {

            $user = Auth::user();

            $tendik = SA_Tendik::where('id_users',$user->id_users)->first();

            $reqs = Approval::select('tbl_approval.*','tbl_mitrakp.*','tbl_berkas.*','users.name as rejectuser')
            ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_approval.id_formkp')
            ->leftJoin('tbl_berkas','tbl_berkas.id_formkp','tbl_approval.id_formkp')
            ->leftJoin('tbl_formkp','tbl_formkp.id_formkp','tbl_approval.id_formkp')
            ->leftJoin('users','users.id_users','tbl_formkp.rejectedby')
            ->where('id_tendik', $tendik->id_tendik)
            ->where('tbl_berkas.module','pengajuanKP')
            ->whereYear('tbl_approval.created_at', '=', $year)
            ->whereMonth('tbl_approval.created_at', '=', $month)
            ->with(['mahasiswa'])
            ->get();

            return view('pages/tendik/pengajuan_req',[
                'reqs' => $reqs,
            ]);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('tendik.request.index')->with('status', $e->getMessage());

            
        }
    }

    public function acctendik(Request $request) 
    {
        try {
            $user = Auth::user();
            $id_users = $user->id_users;

            $id = $request->id;
            $status = $request->status;

            $reqs = Approval::findOrFail($id);

            //send mail
            $toMahasiswa = SA_Mahasiswa::where('id_mhs',$reqs->id_mhs)->with('users')->first();
            $getkoor = SA_Koordinator::where('id_prodi',$toMahasiswa->id_prodi)->with('users')->first();

            $mail = new GenerateMailController;


            if($status == 'approved') {
                
                $module = 'pengajuanKP';


                $reqs->update([
                    'request_status' => 1
                ]);

                $kp = Formkp::findOrFail($reqs->id_formkp);
                $kp->update([
                    'isStatus' => 2
                ]);

                $berkas = Berkas::where('id_formkp',$reqs->id_formkp)->first();
                $berkas->update([
                    'isStatus' => 1
                ]);

                $message = 'Approved Berhasil!';
                $statusacc = 'Di Terima';

                $module1 = 'Penentuan Dosen Pembimbing';
                $email1 = $getkoor->users->email;
                $nama1 = $getkoor->nama;
                $text1 = 'Pendaftaran KP '.$toMahasiswa->nama.'('.$toMahasiswa->nim.') Di Terima, silahkan cek aplikasi SIMKP untuk set dosen pembimbing';

                $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);


            } else {
                // $reqs1 = Approval::findOrFail($id);
                $reqs1 = Approval::where('id_users',$reqs->id_users)->get();
                foreach ($reqs1 as $key) {
                    $key->update([
                        'request_status' => 2
                    ]);
                }
                
                
                $kp = Formkp::findOrFail($reqs->id_formkp);
                $kp->update([
                    'isStatus' => 99,
                    'rejectedby' => $user->id_users
                ]);

                $berkas = Berkas::where('id_formkp',$reqs->id_formkp)->first();
                // return $berkas;

                $berkas->update([
                    'isStatus' => 2
                ]);

                $message = 'Rejected Berhasil!';
                $statusacc = 'Di Tolak';

            }

            

            $module = 'Approval Tendik';
            $email = $toMahasiswa->users->email;
            $nama = $toMahasiswa->nama;
            $text = $toMahasiswa->nama.'('.$toMahasiswa->nim.') pendaftaran KP anda '.$statusacc.', silahkan cek aplikasi SIMKP';

            

            $mail->generateMail($module,$id_users,$email,$nama,$text);

            return redirect()->route('tendik.request.index')->with('status', $message);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('tendik.request.index')->with('status', $e->getMessage());

            
        }
    }

    public function progresskp(Request $request,$id)
    {
        $user = Auth::user();
        $id_users = $user->id_users;

        $kp = Formkp::findOrFail($id);
        $kp->update([
            'isStatus' => 5
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$kp->id_mhs)->with('users')->first();

        $module = 'Update Progress KP';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Status progress anda telah di Update , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('koor.datamhskoor')->with('status', 'update berhasil');
    }

    public function rollbackkp(Request $request,$status,$id)
    {
        $user = Auth::user();
        $id_users = $user->id_users;

        $kp = Formkp::findOrFail($id);

        if($status == 'progresskp') {
            $kp->update([
                'isStatus' => 4
            ]);
        } else if($status == 'finish') {
            $kp->update([
                'isStatus' => 8
            ]);
        }

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$kp->id_mhs)->with('users')->first();

        $module = 'Update Progress KP';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Status progress KP anda telah di Update , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->back()->with('status', 'rollback berhasil');
    }

    public function donekp(Request $request,$id)
    {
        $user = Auth::user();
        $id_users = $user->id_users;
        
        $kp = Formkp::findOrFail($id);
        $kp->update([
            'isStatus' => 6
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$kp->id_mhs)->with('users')->first();

        $module = 'Update Progress KP';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Status progress anda telah di Update , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('koor.datamhskoor')->with('status', 'update berhasil');

    }

}
