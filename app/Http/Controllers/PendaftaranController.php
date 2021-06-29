<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GenerateMailController;

use App\Model\SA_MasterUser;
use App\Model\SA_Dosen;
use App\Model\SA_Mahasiswa;
use App\Model\Formkp;
use App\Model\Berkas;
use App\Model\Mitrakp;
use App\Model\Approval;
use Auth;
use DB;
use Exception;

class PendaftaranController extends Controller
{
    public function all()
    {
        $data = Formkp::select('*')
            ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_formkp.id_formkp')
            ->with(['mahasiswa','users','dosens','berkas'])
            ->get();

        return $data;
    }

    public function check()
    {
        $users = Auth::user();

        $count = Formkp::where('id_users',$users->id_users)->count();
        if($count < 1) {
            $status = 200;
        } else {
            $status = 404;
        }

        return $status;
    }

    public function index()
    {
        try {
            $users = Auth::user();

            $count = Formkp::where('id_users',$users->id_users)->where('isStatus','!=',99)->count();
            if($count < 1) {
                $code = 200;
            } else {
                $code = 404;
            }

            $data = Formkp::select('tbl_formkp.*','tbl_mitrakp.*','users.name as rejectuser')
            ->leftJoin('tbl_mitrakp','tbl_mitrakp.id_formkp','tbl_formkp.id_formkp')
            ->leftJoin('users','users.id_users','tbl_formkp.rejectedby')
            ->where('tbl_formkp.id_users',$users->id_users)
            ->with(['mahasiswa','users','dosens'])
            ->get();

            return view('pages/mahasiswa/pengajuankp',[
                'formkp' => $data,
                'code' => $code,
            ]);

        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return $data;
            
        }

    }

    public function add()
    {
        return view('pages/mahasiswa/pengajuankp-tambah');
    }

    public function storekp(Request $request)
    {
        $request->validate([
            'nama_mitra' => 'required',
            'alamat_mitra' => 'required',
            'jenis_bidang' => 'required',
            'periodekp' => 'required',
            'endperiode' => 'required',
            'file' => 'required',
        ]);
        try{
            $users = Auth::user();
            $id_users = $users->id_users;
            
            $module = 'pengajuanKP';
            
            $mahasiswa = SA_Mahasiswa::where('id_users',$id_users)->first();

            //formulir pendaftaran
            
            $file = $request->file('file');

            $nama_file = $module."_".time()."_".$file->getClientOriginalName();


            $formkp = Formkp::create([
                'id_users' => $id_users,
                'id_mhs' => $mahasiswa->id_mhs,
                // 'dosen_pembimbing' => $mahasiswa->id_dosenwali
            ]);

            $berkas = Berkas::create([
                'id_formkp' => $formkp->id_formkp,
                'id_users' => $id_users,
                'id_mhs' => $mahasiswa->id_mhs,
                'module' => $module,
                'nama_file' => $nama_file
            ]);

            $mitrakp = Mitrakp::create([
                'id_formkp' => $formkp->id_formkp,
                'nama_mitra' => $request->nama_mitra,
                'alamat_mitra' => $request->alamat_mitra,
                'jenis_bidang' => $request->jenis_bidang,
                'periodekp' => $request->periodekp,
                'endperiode' => $request->endperiode,
            ]);
            
            //create approval untuk dosen wali
            $approval = Approval::create([
                'id_users' => $id_users,
                'id_mhs' => $mahasiswa->id_mhs,
                'id_formkp' => $formkp->id_formkp,
                'id_dosen' => $mahasiswa->id_dosenwali,
                'id_koor' => $mahasiswa->id_prodi,
                'id_tendik' => $mahasiswa->id_jurusan,
                'module' => $module,
            ]);

            $tujuan_upload = 'data_berkas';
            $file->move($tujuan_upload,$nama_file);
            
            //send mail
            $toDosenwali = SA_Dosen::where('id_dosen',$mahasiswa->id_dosenwali)->with('users')->first();

            $module = 'Pendaftaran KP';
            $email = $toDosenwali->users->email;
            $nama = $toDosenwali->nama;
            $text = $mahasiswa->nama.'('.$mahasiswa->nim.') menunggu persetujuan anda, silahkan cek aplikasi SIMKP';

            $mail = new GenerateMailController;
            $mail->generateMail($module,$id_users,$email,$nama,$text);

            // return 'success';
            return redirect()->route('mahasiswa.pengajuan')->with('status', 'Berhasil! mengajukan.');
            
        } catch (\Exception $e){
            $data = array("status"=>"error","message"=>$e->getMessage());

            return $data;
            
        }
    }
}
