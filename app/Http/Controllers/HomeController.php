<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = User::with('pendaftaran','biodatamahasiswa')
            ->where('id', Auth::user()->id)
            ->first();
        // dd($data['user']);
        if($data['user']->pendaftaran->isEmpty()){
            return view('dashboard.calon-mahasiswa',$data);
        }else{
            dd('ada');
        }

        return view('dashboard.index',$data);
    }
}
