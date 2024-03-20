<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AgamaController extends Controller
{
    public function index()
    {
        $data['title'] = "Agama";

        return view('agama.index',$data);
    }

    public function list(){
        $data = Agama::orderBy('id','desc')->get();

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
            'agama' => 'required',
        ], [
            'agama.required' => 'Agama tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Agama::updateOrCreate(
                    ['id' =>  $request->id],
                    ['agama' => $request->agama]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Agama $agama)
    {
        //
    }

    public function edit(Agama $agama)
    {
        $data = Agama::find($agama);

        return response()->json($data);
    }

    public function update(Request $request, Agama $agama)
    {
        //
    }

    public function destroy(Agama $agama)
    {
        Agama::find($agama)->each->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
