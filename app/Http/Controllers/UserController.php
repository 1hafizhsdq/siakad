<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $data['title'] = 'User';
        $data['role'] = Role::whereNotIn('id',[1,5])->get();
        
        return view('user.index',$data);
    }

    public function list($role){
        $data = User::where('role_id',$role)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascript:void(0)" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning editData" title="Edit Data">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'telp' => 'required|unique:users,telp',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
        ], [
            'role_id.required' => 'Role tidak boleh kosong!',
            'nama.required' => 'Nama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Email tidak sesuai!',
            'email.unique' => 'Email sudah terdaftar!',
            'telp.required' => 'Telepon tidak boleh kosong!',
            'telp.unique' => 'Telepon sudah terdaftar!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong!',
            'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                User::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'role_id' => $request->role_id,
                        'nama' => strtoupper($request->nama),
                        'email' => $request->email,
                        'telp' => $request->telp,
                        'alamat' => $request->alamat,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tempat_lahir' => strtoupper($request->tempat_lahir),
                        'tgl_lahir' => $request->tanggal_lahir,
                        'password' => Hash::make($request->email),
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data '.$th]]);
            }
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
