<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index()
    {
        $data['title'] = "Fakultas";

        return view('fakultas.index',$data);
    }

    public function list(){
        $data = Fakultas::orderBy('id','desc')->get();

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
            'nama_fakultas' => 'required',
        ], [
            'nama_fakultas.required' => 'Nama Fakultas tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Fakultas::updateOrCreate(
                    ['id' =>  $request->id],
                    ['nama_fakultas' => $request->nama_fakultas]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(Fakultas $fakultas)
    {
        //
    }

    public function edit($id)
    {
        $data = Fakultas::find($id);

        return response()->json($data);
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        //
    }

    public function destroy($id)
    {
        Fakultas::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
