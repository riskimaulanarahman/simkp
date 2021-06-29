<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenerateMailController;

use App\Model\Berkas;
use App\Model\Jadwal;
use App\Model\Prodi;
use App\Model\Ruang;
use App\Model\Nilai;
use App\Model\Judul;
use App\Model\Formkp;
use App\Model\SA_Dosen;
use App\Model\SA_Mahasiswa;
use App\Model\SA_Koordinator;
use Auth;
use Illuminate\Support\Carbon;

class KoordinatorController extends Controller
{
    public function index() {
        return view('pages/koordinator/home_koordinator');
    }
    public function cekjadwalseminar(Request $request) {
        $prodi = $request->prodi;
        // join('tbl_mahasiswa','tbl_mahasiswa.id_mhs','tbl_jadwal.id_mhs')
        $jadwal = Jadwal::with(['mahasiswa','ruang'])
        ->whereHas('mahasiswa', function($q) use($prodi) {
            // Query the name field in status table
            $q->where('id_prodi', '=', $prodi); // '=' is optional
        })
        ->where('isStatus',1)
        ->where('isSidang',0)
        ->get();

        $prodi = Prodi::all()->pluck('nama_prodi','id_prodi');

        // return $jadwal;

        return view('cekjadwal',[
            'jadwal' => $jadwal,
            'prodi' => $prodi
        ]);

    }

    public function datamhs(Request $request) {
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
            $koordinator = SA_Koordinator::where('id_users',$user->id_users)->first();

            $formkp = Formkp::select('*')
            ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_formkp.id_formkp')
            ->leftJoin('tbl_mahasiswa','tbl_mahasiswa.id_mhs','tbl_formkp.id_mhs')
            ->leftJoin('tbl_koordinator','tbl_koordinator.id_prodi','tbl_mahasiswa.id_prodi')
            ->where('tbl_koordinator.id_prodi', $koordinator->id_prodi)
            ->whereNotIn('tbl_formkp.isStatus',[0,1,99])
            ->whereYear('tbl_formkp.created_at', '=', $year)
            ->whereMonth('tbl_formkp.created_at', '=', $month)
            ->with(['mahasiswa','dosens'])
            ->get();

            $ruang = Ruang::pluck('nama_ruang','id_ruang');

            return view('pages/koordinator/data-mahasiswa',[
                'formkp' => $formkp,
                'ruang' => $ruang
            ]);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('koor.datamhskoor')->with('status', $e->getMessage());

            
        }
    }

    public function dosenbase($id) {
        $getjadwal = Formkp::findorFail($id);

        $getmhs = SA_Mahasiswa::findorFail($getjadwal->id_mhs);

        $dosen = SA_Dosen::select('*')
        ->where('id_jurusan',$getmhs->id_jurusan)
        ->pluck('nama','id_dosen');

        return $dosen;
    }

    public function updpembimbing(Request $request) {

        $users = Auth::user();
        $id_users = $users->id_users;

        try {
        
            $formkp = Formkp::findOrFail($request->id_formkp);

            if($formkp->dosen_pembimbing == null) {

                $formkp->update([
                    'dosen_pembimbing' => $request->dosen_pembimbing,
                    'isStatus' => 3
                    ]);
            } else {
                $formkp->update([
                    'dosen_pembimbing' => $request->dosen_pembimbing,
                ]);
            }
            //send mail
            $toMahasiswa = SA_Mahasiswa::where('id_mhs',$formkp->id_mhs)->with('users')->first();
            $toDosenwali = SA_Dosen::where('id_dosen',$request->dosen_pembimbing)->with('users')->first();


            $module = 'Update Pembimbing';
            $email = $toMahasiswa->users->email;
            $nama = $toMahasiswa->nama;
            $text = $toMahasiswa->nama.'('.$toMahasiswa->nim.') anda sudah mempunyai dosen pembimbing, silahkan cek aplikasi SIMKP';

            $module1 = 'Dosen Pembimbing';
            $email1 = $toDosenwali->users->email;
            $nama1 = $toDosenwali->nama;
            $text1 = 'anda menjadi pembimbing mahasiswa atas nama '.$toMahasiswa->nama.'('.$toMahasiswa->nim.') , silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);
            $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);

            return redirect()->route('koor.datamhskoor')->with('status', 'update berhasil');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('koor.datamhskoor')->with('status', $e->getMessage());

            
        }

        
    }

    public function cekjadwal(Request $request,$id) {
        
        $jadwal = Jadwal::where('id_formkp',$id)->with('mahasiswa')->first();


        return json_encode($jadwal);

    }

    public function storejadwal(Request $request)
    {        
        $user = Auth::user();
        $id_users = $user->id_users;

        $jadwal = Jadwal::where('id_formkp',$request->sid_formkp)->firstOrFail();
        $formkp = Formkp::where('id_formkp',$request->sid_formkp)->first();

        if($jadwal->isStatus == 0) {
            $nilai = Nilai::create([
                'id_formkp' => $jadwal->id_formkp,
                'id_mhs' => $jadwal->id_mhs
            ]);
        }

        $jadwal->update([
            'id_ruang' => $request->ruang,
            'tanggal_sidang' => $request->tanggal_sidang,
            'isStatus' => 1,
            'isSidang' => $request->isSidang
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$jadwal->id_mhs)->with('users')->first();
        $getdosen = SA_Dosen::where('id_dosen',$formkp->dosen_pembimbing)->with('users')->first();
        $mail = new GenerateMailController;



        $module = 'Jadwal Seminar';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Jadwal Seminar anda telah di Update , silahkan cek aplikasi SIMKP';
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        if($request->isSidang == 0) {
            $module1 = 'Pengumuman Jadwal Seminar Hasil';
            $email1 = $getdosen->users->email;
            $nama1 = $getdosen->nama;
            $text1 = 'Jadwal seminar mahasiswa atas nama '.$nama.'('.$toMahasiswa->nim.') telah di update. tgl : '.$jadwal->tanggal_sidang.', jangan lupa untuk input nilai seminar , silahkan cek aplikasi SIMKP';
            
            $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);
        }

        return redirect()->route('koor.datamhskoor')->with('status', 'update berhasil');
    }


}
