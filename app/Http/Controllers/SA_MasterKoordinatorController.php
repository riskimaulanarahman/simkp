<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SA_Koordinator;
use App\Model\SA_Dosen;
use App\Model\Jurusan;
use App\Model\Prodi;
use Session;
use URL;
use DB;

class SA_MasterKoordinatorController extends Controller
{
    public function index()
    {

        $koordinator = SA_Koordinator::with(['users','jurusan','prodi'])->get();
        return view('pages/superadmin/koordinator',['koordinator' => $koordinator]);
    }

    public function edit($id)
    {
        $koordinator = SA_Koordinator::findOrFail($id);
        $jurusan = DB::table('tbl_jurusan')->selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = DB::table('tbl_prodi')->select("nama_prodi AS name","id_prodi as id")->pluck('name','id');
        Session::put('requestReferrer', URL::previous());
        return view('pages/superadmin/edit_koordinator',[
            'koordinator' => $koordinator,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            ]);
    }

    public function update(Request $request,$id)
    {
        

        $koordinator = SA_Koordinator::findOrFail($id);
        $getkoor = SA_Koordinator::where('id_prodi',$request->prodi)->count();

        if($koordinator->nip !== $request->nip) {
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
        if($getkoor < 1) {

            $koordinator->update([
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
                'id_prodi' => $request->prodi,
            ]);


            $dosen = SA_Dosen::where('id_users',$koordinator->id_users)->first();
            $dosen->update([
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'id_jurusan' => $request->jurusan,
                'id_prodi' => $request->prodi,
            ]);

            $data = "berhasil update";

        } else {
            $data = "koordinator dengan prodi tersebut sudah ada";
        }

        return redirect()->back()->with('status',$data);



        // return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }
}
