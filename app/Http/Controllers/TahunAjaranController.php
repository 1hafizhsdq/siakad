<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $data['title'] = "Tahun Ajaran";

        return view('tahun_ajaran.index',$data);
    }

    public function list(){
        $data = TahunAjaran::orderBy('id','desc')->get();

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
            'nama_tahun_ajaran' => 'required',
            'semester' => 'required',
        ], [
            'nama_tahun_ajaran.required' => 'Nama Tahun Ajaran tidak boleh kosong!',
            'semester.required' => 'Semester tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                TahunAjaran::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'nama_tahun_ajaran' => $request->nama_tahun_ajaran,
                        'semester' => $request->semester,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        //
    }

    public function edit($id)
    {
        $data = TahunAjaran::find($id);

        return response()->json($data);
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        //
    }

    public function destroy($id)
    {
        TahunAjaran::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
