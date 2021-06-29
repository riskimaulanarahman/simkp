<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenerateMailController;

use App\Model\Berkas;
use App\Model\Jadwal;
use App\Model\Ruang;
use App\Model\Nilai;
use App\Model\Judul;
use App\Model\Formkp;
use App\Model\SA_Dosen;
use App\Model\SA_Tendik;
use App\Model\SA_Koordinator;
use App\Model\SA_Mahasiswa;
use Auth;
use Session;
use URL;
use Illuminate\Support\Carbon;


class DosenController extends Controller
{
    public function nilaiseminar(Request $request) {
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

        $nilai = Nilai::select('tbl_nilai.*','tbl_formkp.dosen_pembimbing')
        ->join('tbl_formkp','tbl_formkp.id_formkp','tbl_nilai.id_formkp')
        ->where('tbl_formkp.dosen_pembimbing',$dosen->id_dosen)
        ->whereYear('tbl_nilai.created_at', '=', $year)
        ->whereMonth('tbl_nilai.created_at', '=', $month)
        ->with('mahasiswa')
        ->get();

        $data = [
            'nilai' => $nilai,
            
        ];

        return view('pages/dosen/berkas_seminar_nilai',$data);
    }

    public function nilaiseminar2(Request $request) {
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

        $nilai = Nilai::select('tbl_nilai.*','tbl_formkp.dosen_pembimbing')
        ->join('tbl_formkp','tbl_formkp.id_formkp','tbl_nilai.id_formkp')
        ->where('tbl_formkp.dosen_pembimbing',$dosen->id_dosen)
        ->whereYear('tbl_nilai.created_at', '=', $year)
        ->whereMonth('tbl_nilai.created_at', '=', $month)
        ->with('mahasiswa')
        ->get();

        // return $nilai;

        $data = [
            'nilai' => $nilai,
            
        ];

        return view('pages/koordinator/berkas_seminar_nilai',$data);
    }

    public function editnilaiseminar($id) {

        $nilai = Nilai::findOrFail($id);

        return view('pages/dosen/edit_seminar_nilai',[
            'nilai' => $nilai,
        ]);
    }

    public function editnilaiseminar2($id) {

        $nilai = Nilai::findOrFail($id);

        return view('pages/koordinator/edit_seminar_nilai',[
            'nilai' => $nilai,
        ]);
    }

    public function updatenilaiseminar(Request $request,$id) {
        $user = Auth::user();
        $id_users = $user->id_users;

        $nilai = Nilai::findOrFail($id);
        // $formkp = Formkp::where('id_formkp',$nilai->id_formkp)->first();

        $nilai->update([
            'dosen_laporan' => $request->dosen_laporan,
            'dosen_poster' => $request->dosen_poster,
            'dosen_presentasi' => $request->dosen_presentasi,
            'revisi_komentar' => $request->revisi_komentar,
            'isStatus' => 1,
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$nilai->id_mhs)->with('users')->first();
        $gettendik = SA_Tendik::where('id_jurusan',$toMahasiswa->id_jurusan)->with('users')->first();


        $module = 'Update Nilai Seminar';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Nilai Seminar anda telah di input, silahkan cek aplikasi SIMKP';

        $module1 = 'Tendik input nilai pembimbing lapangan';
        $email1 = $gettendik->users->email;
        $nama1 = $gettendik->nama;
        $text1 = 'Nilai Seminar KP mahasiswa atas nama '.$toMahasiswa->nama.'('.$toMahasiswa->nim.') telah di update, silahkan cek aplikasi SIMKP untuk menginputkan nilai dari pembimbing lapangan';

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);
        $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);

        return redirect()->route('dosen.nilaiseminar')->with('status','berhasil update data');
    }

    public function updatenilaiseminar2(Request $request,$id) {
        $user = Auth::user();
        $id_users = $user->id_users;

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'dosen_laporan' => $request->dosen_laporan,
            'dosen_poster' => $request->dosen_poster,
            'dosen_presentasi' => $request->dosen_presentasi,
            'revisi_komentar' => $request->revisi_komentar,
            'isStatus' => 1,
        ]);

        //send mail
        $toMahasiswa = SA_Mahasiswa::where('id_mhs',$nilai->id_mhs)->with('users')->first();
        $gettendik = SA_Tendik::where('id_jurusan',$toMahasiswa->id_jurusan)->with('users')->first();

        $module = 'Update Nilai Seminar';
        $email = $toMahasiswa->users->email;
        $nama = $toMahasiswa->nama;
        $text = 'Nilai Seminar anda telah di input, silahkan cek aplikasi SIMKP';

        $module1 = 'Tendik input nilai pembimbing lapangan';
        $email1 = $gettendik->users->email;
        $nama1 = $gettendik->nama;
        $text1 = 'Nilai Seminar KP mahasiswa atas nama '.$toMahasiswa->nama.'('.$toMahasiswa->nim.') telah di update, silahkan cek aplikasi SIMKP untuk menginputkan nilai dari pembimbing lapangan';


        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);
        $mail->generateMail($module1,$id_users,$email1,$nama1,$text1);


        return redirect()->route('koor.nilaiseminar')->with('status','berhasil update data');
    }
}
