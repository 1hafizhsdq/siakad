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
            ->addColumn('status', function ($data) {
                switch ($data->is_active) {
                    case '0':
                        return 'Non Aktif';
                        break;
                    case '1':
                        return 'Aktif';
                        break;
                    case '2':
                        return 'Cuti';
                        break;
                    case '3':
                        return 'Lulus';
                        break;
                    case '4':
                        return 'Pensiun';
                        break;
                    case '5':
                        return 'Meninggal';
                        break;
                    default:
                        return '-';
                        break;
                }
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/user/'.$data->id.'/edit" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning" title="Edit Data">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="javascript:void(0)" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-primary resetData" title="Reset Password">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle me-1" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Ubah Status">
                            <i class="bi bi-power"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5" style="">
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="0">Non Aktif</a>
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="1">Aktif</a>
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="2">Cuti</a>
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="3">Lulus</a>
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="4">Pensiun</a>
                            <a class="dropdown-item isactive" data-id="'.$data->id.'" data-status="5">Meninggal</a>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $data['title'] = 'Form User';
        $data['role'] = Role::whereNotIn('id',[1,5])->get();
        
        return view('user.form',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'telp' => 'nullable|unique:users,telp,'.$request->id,
        ], [
            'role_id.required' => 'Role tidak boleh kosong!',
            'nama.required' => 'Nama tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Email tidak sesuai!',
            'email.unique' => 'Email sudah terdaftar!',
            'telp.unique' => 'Telepon sudah terdaftar!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                if(!empty($request->telp)){
                    if (substr($request->telp, 0, 1) === '0') {
                        $telp = '62' . substr($request->telp, 1);
                    }else{
                        $telp = $request->telp;
                    }
                }else{
                    $telp = null;
                }

                User::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'role_id' => $request->role_id,
                        'no_induk' => $request->no_induk,
                        'nama' => strtoupper($request->nama),
                        'email' => $request->email,
                        'telp' => $telp,
                        'alamat' => $request->alamat,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tempat_lahir' => strtoupper($request->tempat_lahir),
                        'tgl_lahir' => $request->tgl_lahir,
                        'password' => Hash::make($request->email),
                        'nidn' => $request->nidn,
                        'gelar_depan' => $request->gelar_depan,
                        'gelar_belakang' => $request->gelar_belakang,
                        'agama_id' => $request->agama_id,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data ']]);
            }
        }
    }

    public function isactive(Request $request){
        try {
            User::where('id',$request->id)->update(['is_active' => $request->status]);

            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data ']]);
        }
    }

    public function reset(Request $request){
        try {
            $data = User::find($request->id);
            User::where('id',$request->id)->update(['password' => Hash::make($data->email)]);

            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data ']]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['title'] = 'Form User';
        $data['role'] = Role::whereNotIn('id',[1,5])->get();
        $data['user'] = User::find($id);
        
        return view('user.form',$data);
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
