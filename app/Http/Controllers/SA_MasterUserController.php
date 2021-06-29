<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GenerateMailController;


use Illuminate\Http\Request;

use App\Model\SA_MasterUser;
use App\Model\SA_Mahasiswa;
use App\Model\SA_Dosen;
use App\Model\SA_Koordinator;
use App\Model\SA_Tendik;
use DB;
use Exception;
use Session;
use URL;
use Auth;


class SA_MasterUserController extends Controller
{
    public function index()
    {
        $user = SA_MasterUser::paginate(10);
        return view('pages/superadmin/user',['user' => $user]);
    }

    public function tambah()
    {
        $jurusan = DB::table('tbl_jurusan')->selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = DB::table('tbl_prodi')->select("nama_prodi AS name","id_prodi as id")->pluck('name','id');
        $dosen = DB::table('tbl_dosen')->select("nama AS name","id_dosen as id")->where('isWali',1)->pluck('name','id');

        return view('pages/superadmin/tambah_user',[
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'dosen' => $dosen,
        ]);
    }

    public function registermhs()
    {
        $jurusan = DB::table('tbl_jurusan')->selectRaw("nama_jurusan AS name,id_jurusan as id")->pluck('name','id');
        $prodi = DB::table('tbl_prodi')->select("nama_prodi AS name","id_prodi as id")->pluck('name','id');
        $dosen = DB::table('tbl_dosen')->select("nama AS name","id_dosen as id")->where('isWali',1)->pluck('name','id');

        return view('register',[
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'dosen' => $dosen,
        ]);
    }

    public function storeregistermhs(Request $request)
    {
        $id_users = 1; //id_users admin

            $request->validate([
                'name' => 'required',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required',
                'nim' => 'required | unique:tbl_mahasiswa',
                'tahun_angkatan' => 'required',
                'dosenwali' => 'required',
                'jurusan' => 'required',
                'prodi' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            try{
                $users = SA_MasterUser::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'pass_txt' => $request->password,
                    'role' => $request->role,
                ]);
                
                $mahasiswa = new SA_Mahasiswa([
                    'nim' => $request->nim,
                    'nama' => $request->name,
                    'tahun_angkatan' => $request->tahun_angkatan,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'id_dosenwali' => $request->dosenwali,
                    'id_jurusan' => $request->jurusan,
                    'id_prodi' => $request->prodi,
                ]);
                $users->mahasiswa()->save($mahasiswa);

                $data = 'berhasil menambahkan data mahasiswa';

                //send mail

                $module = 'Akun Mahasiswa Berhasil Dibuat';
                $email = $request->email;
                $nama = $request->name;
                $text = 'username : '.$request->username.' | password : '.$request->password;

                $mail = new GenerateMailController;
                $mail->generateMail($module,$id_users,$email,$nama,$text);
                
            } catch (Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());
            }

        return redirect()->route('login')->with('status',$data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $id_users = $user->id_users;

        if($request->role == 'mahasiswa') {
            $request->validate([
                'name' => 'required',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required',
                'role' => 'required',
                'nim' => 'required | unique:users',
                'tahun_angkatan' => 'required',
                'dosenwali' => 'required',
                'jurusan' => 'required',
                'prodi' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            try{
                $users = SA_MasterUser::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'nim' => $request->nim,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'pass_txt' => $request->password,
                    'role' => $request->role,
                ]);
                
                $mahasiswa = new SA_Mahasiswa([
                    'nim' => $request->nim,
                    'nama' => $request->name,
                    'tahun_angkatan' => $request->tahun_angkatan,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'id_dosenwali' => $request->dosenwali,
                    'id_jurusan' => $request->jurusan,
                    'id_prodi' => $request->prodi,
                ]);
                $users->mahasiswa()->save($mahasiswa);

                $data = 'berhasil menambahkan';
                
            } catch (Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());
            }
        } else if($request->role == 'dosen') {
            $request->validate([
                'name' => 'required',
                'nip' => 'required | unique:users',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required',
                'role' => 'required',
                'alamat' => 'required',
                'jurusan' => 'required',
                'prodi' => 'required',
                'telepon' => 'required',
            ]);

            try{
                $users = SA_MasterUser::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'pass_txt' => $request->password,
                    'role' => $request->role,
                ]);
                
                $dosen = new SA_Dosen([
                    'nip' => $request->nip,
                    'nama' => $request->name,
                    'alamat' => $request->alamat,
                    'telepon' => $request->telepon,
                    'id_jurusan' => $request->jurusan,
                    'id_prodi' => $request->prodi,
                ]);
                $users->dosen()->save($dosen);

                $data = 'berhasil menambahkan';
                
            } catch (\Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());

                return $data;
            }
        } else if($request->role == 'koordinator') {
            $request->validate([
                'name' => 'required',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'id_prodi' => 'unique:tbl_koordinator',
                'jurusan' => 'required',
                'prodi' => 'required',
                'nip' => 'required | unique:users',
                'password' => 'required',
                'role' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            try{
                $getkor = SA_Koordinator::where('id_prodi',$request->prodi)->count();
                if($getkor<1) {

                    $users = SA_MasterUser::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'nip' => $request->nip,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'pass_txt' => $request->password,
                        'role' => $request->role,
                    ]);

                
                    $koor = new SA_Koordinator([
                        'nip' => $request->nip,
                        'nama' => $request->name,
                        'alamat' => $request->alamat,
                        'telepon' => $request->telepon,
                        'id_jurusan' => $request->jurusan,
                        'id_prodi' => $request->prodi,
                    ]);
                    $users->koor()->save($koor);

                    $dosen = new SA_Dosen([
                        'nip' => $request->nip,
                        'nama' => $request->name,
                        'alamat' => $request->alamat,
                        'telepon' => $request->telepon,
                        'id_jurusan' => $request->jurusan,
                        'id_prodi' => $request->prodi,
                        'isKoor' => 1
                    ]);

                    $users->dosen()->save($dosen);


                    $data = 'berhasil menambahkan';

                } else {
                    $data = 'koor dengan prodi tersebut sudah ada';
                }

                
                
            } catch (\Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());

                return $data;
            }
        } else if($request->role == 'tendik') {
            $request->validate([
                'name' => 'required',
                'username' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required',
                'role' => 'required',
                'nip' => 'required | unique:users',
                'jurusan' => 'required ',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            try{
                $gettendik = SA_Tendik::where('id_jurusan',$request->jurusan)->count();
                // return $gettendik;
                if($gettendik<1) {

                    $users = SA_MasterUser::create([
                        'name' => $request->name,
                        'username' => $request->username,
                        'nip' => $request->nip,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'pass_txt' => $request->password,
                        'role' => $request->role,
                    ]);
                    
                    $tendik = new SA_Tendik([
                        'nip' => $request->nip,
                        'nama' => $request->name,
                        'alamat' => $request->alamat,
                        'telepon' => $request->telepon,
                        'id_jurusan' => $request->jurusan,
                    ]);

                    $users->tendik()->save($tendik);

                    $data = 'berhasil menambahkan';

                } else {
                    $data = 'tendik dengan jurusan tersebut sudah ada';
                }
                
            } catch (\Exception $e){
                $data = array("status"=>"error","message"=>$e->getMessage());

                return $data;
            }
        } else {
            $request->validate([
                'role' => 'required',
            ]);
        }


        //send mail
        $module = 'Akun '.$request->role.' Berhasil Dibuat';
        $email = $request->email;
        $nama = $request->name;
        $text = 'username : '.$request->username.' | password : '.$request->password;

        $mail = new GenerateMailController;
        $mail->generateMail($module,$id_users,$email,$nama,$text);

        return redirect()->route('sa-user-index')->with('status',$data);
    }

    public function edit($id)
    {
        Session::put('requestReferrer', URL::previous());
        $user = SA_MasterUser::findOrFail($id);
        return view('pages/superadmin/edit_user',['user' => $user]);
    }

    public function update(Request $request,$id)
    {
        $user = SA_MasterUser::findOrFail($id);

        if($user->username !== $request->username ) {

            $request->validate([
                'name' => 'required ',
                'username' => 'required | unique:users',
                'email' => 'required',
                'role' => 'required',
            ]);
        }else if($user->email !== $request->email) {
            $request->validate([
                'name' => 'required ',
                'username' => 'required',
                'email' => 'required | unique:users',
                'role' => 'required',
            ]);
        }else {
            $request->validate([
                'name' => 'required ',
                'username' => 'required',
                'email' => 'required',
                'role' => 'required',
            ]);
        }


        $role = $request->role;

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'isActive' => $request->isActive,
        ]);

        if($role == 'mahasiswa') {
            $mahasiswa = SA_Mahasiswa::where('id_users',$id);
            $mahasiswa->update(["nama" => $request->name]);
            // $mahasiswa->save();
        } else if($role == 'dosen' || $role == 'koordinator') {
            $dosen = SA_Dosen::where('id_users',$id);
            $dosen->update(["nama" => $request->name]);
            // $dosen->save();
        // } else if() {
            $koor = SA_Koordinator::where('id_users',$id);
            $koor->update(["nama" => $request->name]);
        } else if($role == 'tendik') {
            $tendik = SA_Tendik::where('id_users',$id);
            $tendik->update(["nama" => $request->name]);
        }

        if(!empty($request->password)) {
            $user->password = bcrypt($request->password);
            $user->pass_txt = $request->password;
            $user->save();
        }

        return redirect(Session::get('requestReferrer'))->with('status','berhasil update');
    }

    public function deleted($id)
    {

        $user = SA_MasterUser::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
    
}
