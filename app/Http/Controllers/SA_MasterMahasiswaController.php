<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\SA_Mahasiswa;
use App\Model\Jurusan;
use App\Model\Prodi;
use Session;
use URL;
use DB;

class SA_MasterMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = SA_Mahasiswa::all();
        return view('pages/superadmin/mahasiswa',['mahasiswa' => $mahasiswa]);
    }

    public function edit($id)
    {
        Session::put('requestReferrer', URL::previous());
        
        $mahasiswa = SA_Mahasiswa::findOrFail($id);
        $jurusan = Jurusan::selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = Prodi::selectRaw("nama_prodi AS name,id_prodi as id")->pluck('name','id');
        $doswal = DB::table('tbl_dosen')->select("nama AS name","id_dosen as id")->where('isWali',1)->pluck('name','id');

        return view('pages/superadmin/edit_mahasiswa',['mahasiswa' => $mahasiswa, 'jurusan' => $jurusan, 'prodi' => $prodi, 'doswal' => $doswal]);
    }

    public function update(Request $request,$id)
    {
        $mahasiswa = SA_Mahasiswa::findOrFail($id);
        if($mahasiswa->nim !== $request->nim) {

            $request->validate([
                'nim' => 'required | unique:tbl_mahasiswa',
                'tahun_angkatan' => 'required',
                'jurusan' => 'required',
            ]);

        } else {
            $request->validate([
                'nim' => 'required',
                'tahun_angkatan' => 'required',
                'jurusan' => 'required',
            ]);
        }
                
        $mahasiswa->update([
            'nim' => $request->nim,
            'tahun_angkatan' => $request->tahun_angkatan,
            'id_jurusan' => $request->jurusan,
            'id_prodi' => $request->prodi,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'id_dosenwali' => $request->doswal,
        ]);

        return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }
}
