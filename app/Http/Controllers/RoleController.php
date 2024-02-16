<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $data['title'] = "Role";

        return view('role.index',$data);
    }

    public function list(){
        $data = Role::get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascript:void(0)" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning editData" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>
                    <a href="javascript:void(0)" id="btn-delete" data-id="'.$data->id.'" class="btn btn-xs btn-danger deleteData" title="Hapus Data"><i class="fa fa-trash"></i></a>
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
            'role' => 'required',
        ], [
            'role.required' => 'Role tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Role::updateOrCreate(
                    ['id' =>  $request->id],
                    ['role' => $request->role]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $data = Role::find($role);

        return response()->json($data);
    }

    public function update(Request $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        Role::where('id',$role)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
