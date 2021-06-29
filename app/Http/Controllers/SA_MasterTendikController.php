<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SA_Tendik;
use App\Model\Jurusan;
use App\Model\Prodi;
use Session;
use URL;
use DB;

class SA_MasterTendikController extends Controller
{
    public function index()
    {

        $tendik = SA_Tendik::with(['users','jurusan'])->get();
        return view('pages/superadmin/tendik',['tendik' => $tendik]);
    }

    public function edit($id)
    {
        Session::put('requestReferrer', URL::previous());
        $tendik = SA_Tendik::findOrFail($id);
        $jurusan = DB::table('tbl_jurusan')->selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = DB::table('tbl_prodi')->select("nama_prodi AS name","id_prodi as id")->pluck('name','id');

        return view('pages/superadmin/edit_tendik',[
            'tendik' => $tendik,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            ]);
    }

    public function update(Request $request,$id)
    {
        DB::enableQueryLog();
        $tendik = SA_Tendik::findOrFail($id);

        $gettendik = SA_Tendik::where('id_jurusan',$request->jurusan)->count();

        // return $request->jurusan;
        if($tendik->nip !== $request->nip ) {
            $request->validate([
                'nip' => 'required | unique:tbl_tendik|unique:tbl_dosen|unique:tbl_koordinator',
                // 'nip' => 'unique:tbl_dosen',
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

        if($gettendik<1) {

            $tendik->update([
                'nip' => $request->nip,
                // 'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
            ]);
            $data = 'berhasil update';

        } else {
            $data = 'tendik dengan jurusan tersebut sudah ada';

        }
        return redirect()->back()->with('status',$data);

        // dd(DB::getQueryLog());
        // return $tendik;

    }
}
