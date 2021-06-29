<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Model\Jadwal;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'admin') {

            return redirect()->route('dashboard-admin');

        } elseif(Auth::user()->role == 'koordinator') {

            return redirect()->route('koor.datamhskoor');

        } elseif(Auth::user()->role == 'dosen') {

            return redirect()->route('dosen.request.index');

        } elseif(Auth::user()->role == 'mahasiswa') {

            return redirect()->route('mahasiswa.pengajuan');
            
        } elseif(Auth::user()->role == 'tendik') {

            return redirect()->route('tendik.request.index');
            
        } else {
            return view('notyet');
        }
    }

}
