<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = User::with('pendaftaran','biodatamahasiswa')
            ->where('id', Auth::user()->id)
            ->first();
        
        if(Auth::user()->role_id == 5){
            return redirect()->action([PendaftaranController::class, 'index']);
        }

        return view('dashboard.index',$data);
    }
}
