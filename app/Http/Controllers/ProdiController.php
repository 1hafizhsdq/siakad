<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    public function index()
    {
        $data['title'] = "Program Studi";
        $data['fakultas'] = Fakultas::get();

        return view('prodi.index',$data);
    }

    public function list(){
        $data = Prodi::with('fakultas')->orderBy('id','desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascript:void(0)" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning editData" title="Edit Data">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="javascript:void(0)" id="btn-delete" data-id="'.$data->id.'" class="btn btn-xs btn-danger deleteData" title="Hapus Data">
                        <i class="bi bi-trash"></i>
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
            'fakultas_id' => 'required',
            'nama_prodi' => 'required',
        ], [
            'fakultas_id.required' => 'Fakultas tidak boleh kosong!',
            'nama_prodi.required' => 'Nama Program Studi tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Prodi::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'fakultas_id' => $request->fakultas_id,
                        'nama_prodi' => $request->nama_prodi,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Prodi $prodi)
    {
        //
    }

    public function edit($id)
    {
        $data = Prodi::find($id);

        return response()->json($data);
    }

    public function update(Request $request, Prodi $prodi)
    {
        //
    }

    public function destroy($id)
    {
        Prodi::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
