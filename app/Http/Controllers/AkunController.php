<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    public function index()
    {
        $data['title'] = 'Akun Saya';
        $data['user'] = User::with('role')->find(Auth::user()->id);
        $data['agamas'] = Agama::get();
        
        return view('akun.index',$data);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'newpassword' => 'required',
            'renewpassword' => 'required',
        ], [
            'password.required' => 'Password Lama tidak boleh kosong!',
            'newpassword.required' => 'Password Baru tidak boleh kosong!',
            'renewpassword.required' => 'Ulangi Password Baru tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $oldData = User::find($request->id_password);
        if(!Hash::check($request->password, $oldData->password)){
            return response()->json([ 'errors' => ['Password lama tidak sama!']]); 
        }else{
            if($request->newpassword != $request->renewpassword){
                return response()->json([ 'errors' => ['Password baru tidak sama!']]);
            }else{
                User::where('id',$request->id_password)->update(['password' => Hash::make($request->newpassword)]);
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            }
        }
    }
}
