<?php

namespace App\Http\Controllers;

use App\Models\JenisPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JenisPerkuliahanController extends Controller
{
    public function index()
    {
        $data['title'] = "Jenis Perkuliahan";

        return view('jenis_perkuliahan.index',$data);
    }

    public function list(){
        $data = JenisPerkuliahan::orderBy('id','desc')->get();

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
            'jenis_perkuliahan' => 'required',
        ], [
            'jenis_perkuliahan.required' => 'Jenis Perkuliahan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                JenisPerkuliahan::updateOrCreate(
                    ['id' =>  $request->id],
                    ['jenis_perkuliahan' => $request->jenis_perkuliahan]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(JenisPerkuliahan $jenisPerkuliahan)
    {
        //
    }

    public function edit($id)
    {
        $data = JenisPerkuliahan::find($id);

        return response()->json($data);
    }

    public function update(Request $request, JenisPerkuliahan $jenisPerkuliahan)
    {
        //
    }

    public function destroy($id)
    {
        JenisPerkuliahan::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
