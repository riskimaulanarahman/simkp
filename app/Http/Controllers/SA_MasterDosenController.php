<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\SA_Dosen;
use App\Model\SA_Koordinator;
use Session;
use URL;
use DB;

class SA_MasterDosenController extends Controller
{
    public function index()
    {
        $dosen = SA_Dosen::with(['users','jurusan','prodi'])->get();
        return view('pages/superadmin/dosen',['dosen' => $dosen]);
    }

    public function edit($id)
    {
        $dosen = SA_Dosen::findOrFail($id);
        $jurusan = DB::table('tbl_jurusan')->selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = DB::table('tbl_prodi')->select("nama_prodi AS name","id_prodi as id")->pluck('name','id');
        Session::put('requestReferrer', URL::previous());
        return view('pages/superadmin/edit_dosen',[
            'dosen' => $dosen,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            ]);
    }

    public function update(Request $request,$id)
    {
        // $request->validate([
        //     'nip' => 'required | unique:tbl_dosen',
        // ]);

        $dosen = SA_Dosen::findOrFail($id);
        if($dosen->isKoor == 0) {
            
            if($dosen->nip !== $request->nip) {
                $request->validate([
                    'nip' => 'required | unique:tbl_tendik|unique:tbl_dosen|unique:tbl_koordinator',
                    'alamat' => 'required',
                    'telepon' => 'required',
                ]);
                
            } else {
                $request->validate([
                    'nip' => 'required',
                    'alamat' => 'required',
                    'telepon' => 'required',
                ]);
            }
            $dosen->update([
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
                'id_prodi' => $request->prodi,
            ]);
        } else if($dosen->isKoor == 1) {
            if($dosen->nip !== $request->nip) {
                $request->validate([
                    'nip' => 'required | unique:tbl_dosen',
                    'alamat' => 'required',
                    'telepon' => 'required',
                ]);
                
            } else {
                $request->validate([
                    'nip' => 'required',
                    'alamat' => 'required',
                    'telepon' => 'required',
                ]);
            }

            $dosen->update([
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
                'id_prodi' => $request->prodi,
            ]);
            $koor = SA_Koordinator::where('id_users',$dosen->id_users)->first();
            $koor->update([
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
                'id_prodi' => $request->prodi,
            ]);
        }

        return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }

    public function wali(Request $request,$id)
    {
        $wali = $request->wali;
        $dosen = SA_Dosen::findOrFail($id);

        if($wali == 'on') {
            $dosen->update([
                'isWali' => 1,
            ]);
        } else {
            $dosen->update([
                'isWali' => 0,
            ]);
        }

        // return redirect()->route('sa-dosen-index');
        return redirect()->back();
    }
}
