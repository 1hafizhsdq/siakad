<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    public function index()
    {
        $data['title'] = "Ruangan";

        return view('ruangan.index',$data);
    }

    public function list(){
        $data = Ruangan::orderBy('id','desc')->get();

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
            'nama_ruangan' => 'required',
        ], [
            'nama_ruangan.required' => 'Nama Ruangan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Ruangan::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'nama_ruangan' => $request->nama_ruangan,
                        'kapasitas' => $request->kapasitas ?? 0,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Ruangan $ruangan)
    {
        //
    }

    public function edit($id)
    {
        $data = Ruangan::find($id);

        return response()->json($data);
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        //
    }

    public function destroy($id)
    {
        Ruangan::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
