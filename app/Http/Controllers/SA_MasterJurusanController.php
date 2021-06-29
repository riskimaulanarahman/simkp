<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use URL;

use App\Model\SA_Jurusan;

class SA_MasterJurusanController extends Controller
{
    public function index()
    {
        $jurusan = SA_Jurusan::paginate(10);
        return view('pages/superadmin/jurusan',['jurusan' => $jurusan]);
    }

    public function tambah()
    {
        return view('pages/superadmin/tambah_jurusan');
    }

    public function store(Request $request)
    {
            $request->validate([
                'nama_jurusan' => 'required | unique:tbl_jurusan',
            ]);

            try{
                $jurusan = SA_Jurusan::create([
                    'nama_jurusan' => $request->nama_jurusan,
                ]);
                
                $jurusan->save();
                
            } catch (Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());
            }
        

        return redirect()->route('sa-jurusan-index');
    }

    public function edit($id)
    {
        $jurusan = SA_Jurusan::findOrFail($id);
        Session::put('requestReferrer', URL::previous());
        return view('pages/superadmin/edit_jurusan',['jurusan' => $jurusan]);
    }

    public function update(Request $request,$id)
    {
        $jurusan = SA_Jurusan::findOrFail($id);

        if($jurusan->nama_jurusan !== $request->nama_jurusan) {

            $request->validate([
                'nama_jurusan' => 'required | unique:tbl_jurusan',
                ]);
        }

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }

    public function deleted($id)
    {

        $jurusan = SA_Jurusan::findOrFail($id);
        $jurusan->delete();

        // return redirect()->route('sa-jurusan-index');
        return redirect()->back();
    }
}
