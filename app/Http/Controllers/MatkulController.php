<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MatkulController extends Controller
{
    public function index()
    {
        $data['title'] = "Mata Kuliah";

        return view('matkul.index',$data);
    }

    public function list(){
        $data = Matkul::orderBy('id','desc')->get();

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
            'mata_kuliah' => 'required',
            'sks' => 'required',
        ], [
            'mata_kuliah.required' => 'Mata Kuliah tidak boleh kosong!',
            'sks.required' => 'SKS tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Matkul::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'mata_kuliah' => $request->mata_kuliah,
                        'sks' => $request->sks,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Matkul $matkul)
    {
        //
    }

    public function edit($id)
    {
        $data = Matkul::find($id);

        return response()->json($data);
    }

    public function update(Request $request, Matkul $matkul)
    {
        //
    }

    public function destroy($id)
    {
        Matkul::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
