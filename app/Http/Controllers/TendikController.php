<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenerateMailController;

use App\Model\Berkas;
use App\Model\Jadwal;
use App\Model\Ruang;
use App\Model\Nilai;
use App\Model\Formkp;
use App\Model\SA_Tendik;
use App\Model\SA_Dosen;
use App\Model\SA_Mahasiswa;
use App\Model\SA_Koordinator;
use App\Model\Mitrakp;
use Auth;
use Session;
use URL;
use Illuminate\Support\Carbon;

class TendikController extends Controller
{
    public function index() {
        return view('pages/tendik/home_tendik');
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

            $tendik = SA_Tendik::where('id_users',$user->id_users)->first();

            $formkp = Formkp::select('*')
            ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_formkp.id_formkp')
            ->leftJoin('tbl_mahasiswa','tbl_mahasiswa.id_mhs','tbl_formkp.id_mhs')
            ->leftJoin('tbl_tendik','tbl_tendik.id_jurusan','tbl_mahasiswa.id_jurusan')
            ->where('tbl_tendik.id_jurusan', $tendik->id_jurusan)
            ->whereNotIn('tbl_formkp.isStatus',[0,1,99])
            ->whereYear('tbl_formkp.created_at', '=', $year)
            ->whereMonth('tbl_formkp.created_at', '=', $month)
            ->with(['mahasiswa','dosens'])
            ->get();

            $dosen = SA_Dosen::select('*')->pluck('nama','id_dosen');

            return view('pages/tendik/data-mahasiswa',[
                'formkp' => $formkp,
                'dosen' => $dosen
            ]);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('tendik.datamhs')->with('status', $e->getMessage());

        }
    }

    public function editmitra($id)
    {
        $mitrakp = Mitrakp::findOrFail($id);
        Session::put('requestReferrer', URL::previous());
        return view('pages/tendik/edit_mitrakp',['mitrakp' => $mitrakp]);
    }

    public function updatemitra(Request $request,$id)
    {
        // $request->validate([
        //     'nama_jurusan' => 'required',
        // ]);

        $mitrakp = Mitrakp::findOrFail($id);
        $mitrakp->update($request->all());

        return redirect(Session::get('requestReferrer'));
    }

    public function seminar(Request $request,$id)
    {
        $user = Auth::user();
        $id_users = $user->id_users;

        $kp = Formkp::findOrFail($id);
        $kp->update([
            'isStatus' => 8
        ]);

        $jadwal = Jadwal::create([
            'id_formkp' => $kp->id_formkp,
            'id_mhs' => $kp->id_mhs,
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$kp->id_mhs)->with('users')->first();
        $getkoor = SA_Koordinator::where('id_prodi',$toMahasiswa->id_prodi)->with('users')->first();


        $module = 'Update Seminar';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Berkas anda telah disetujui untuk lanjut ke tahap Seminar, silahkan cek aplikasi SIMKP';

        $module1 = 'Penentuan Jadwal';
        $email1 = $getkoor->users->email;
        $nama1 = $getkoor->nama;
        $text1 = 'Set jadwal seminar mahasiswa atas nama '.$nama.'('.$toMahasiswa->nim.') , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);
        $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);
    }

    public function finish(Request $request,$id)
    {
        $user = Auth::user();
        $id_users = $user->id_users;

        $kp = Formkp::findOrFail($id);
        $kp->update([
            'isStatus' => 9
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$kp->id_mhs)->with('users')->first();

        $module = 'Finish KP';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Selamat KP anda telah selesai, silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

    }

    public function updpembimbing(Request $request) {

        try {
        
            $formkp = Formkp::findOrFail($request->id_formkp);

            $formkp->update([
                'dosen_pembimbing' => $request->dosen_pembimbing,
            ]);

            return redirect()->route('tendik.datamhs')->with('status', 'update berhasil');

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return redirect()->route('tendik.datamhs')->with('status', $e->getMessage());
        }
    }

    public function editnilaimahasiswa($id) {

        $nilai = Nilai::findOrFail($id);

        return view('pages/tendik/edit_lapangan_nilai',[
            'nilai' => $nilai,
        ]);
    }

    public function updatenilaimahasiswa(Request $request,$id) {
        $user = Auth::user();
        $id_users = $user->id_users;

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'lap_laporan' => $request->lap_laporan,
            'lap_kinerja' => $request->lap_kinerja,
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$nilai->id_mhs)->with('users')->first();

        $module = 'Update Nilai Lapangan';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Nilai pembimbing lapangan anda telah di input, silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('tendik.datamhs')->with('status','berhasil update data');
    }

    public function accberkas(Request $request,$id,$status) {

        $users = Auth::user();
        $id_users = $users->id_users;

        $berkas = Berkas::findOrFail($id);

        if($status == 'acc') {
            $berkas->update([
                'isStatus' => 1
            ]);
            $statusacc = 'Di Terima';
        }else if($status == 'reject') {
            $berkas->update([
                'isStatus' => 2
            ]);
            $statusacc = 'Di Tolak';
        } else {
            $berkas->update([
                'isStatus' => 0
            ]);
        }

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$berkas->id_mhs)->with('users')->first();

        $module = 'Approval Berkas Mahasiswa';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Pengajuan berkas anda '.$statusacc.' , silahkan cek aplikasi SIMKP';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return json_encode($berkas);
    }

}
