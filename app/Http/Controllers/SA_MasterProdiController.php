<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Prodi;
use App\Model\SA_Jurusan;
use Session;
use URL;

class SA_MasterProdiController extends Controller
{
    public function index()
    {
        $prodi = Prodi::paginate(10);
        return view('pages/superadmin/prodi',['prodi' => $prodi]);
    }

    public function tambah()
    {
        $jurusan = SA_Jurusan::all()->pluck('nama_jurusan','id_jurusan');
        return view('pages/superadmin/tambah_prodi',['jurusan' => $jurusan]);
    }

    public function store(Request $request)
    {

            $request->validate([
                'nama_prodi' => 'required | unique:tbl_prodi',
            ]);

            try{
                $prodi = Prodi::create([
                    'id_jurusan' => $request->nama_jurusan,
                    'nama_prodi' => $request->nama_prodi,
                ]);
                
                $prodi->save();
                
            } catch (Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());
            }
        

        return redirect()->route('sa-prodi-index');
    }

    public function edit($id)
    {
        Session::put('requestReferrer', URL::previous());

        $jurusan = SA_Jurusan::all()->pluck('nama_jurusan','id_jurusan');
        $prodi = Prodi::findOrFail($id);
        return view('pages/superadmin/edit_prodi',['prodi' => $prodi]);
    }

    public function update(Request $request,$id)
    {
        $prodi = Prodi::findOrFail($id);

        if($prodi->nama_prodi !== $request->nama_prodi) {
            $request->validate([
                'nama_prodi' => 'required | unique:tbl_prodi',
            ]);
        }

        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }

    public function deleted($id)
    {

        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        return redirect()->back();
    }
}
