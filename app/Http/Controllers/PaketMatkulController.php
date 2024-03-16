<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use App\Models\PaketMatkul;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaketMatkulController extends Controller
{
    public function index()
    {
        $data['title'] = "Paket Kuliah";
        $data['prodis'] = Prodi::get();

        return view('paket_kuliah.index',$data);
    }

    public function list($prodi){
        $data = PaketMatkul::where('prodi_id',$prodi)->get();

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
                    <a href="/paketkuliah/'.$data->id.'" id="btn-detail" data-id="'.$data->id.'" class="btn btn-xs btn-info" title="Detail Data">
                    <i class="bi bi-eye"></i>
                    </a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function matkul($prodi){
        $data = Matkul::where('prodi_id',$prodi)->get();

        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prodi_id' => 'required',
            'nama_paket' => 'required',
            'semester' => 'required',
        ], [
            'prodi_id.required' => 'Program Studi tidak boleh kosong!',
            'nama_paket.required' => 'Nama Paket tidak boleh kosong!',
            'semester.required' => 'semester tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                PaketMatkul::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'prodi_id' => $request->prodi_id,
                        'nama_paket' => $request->nama_paket,
                        'semester' => $request->semester,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show($id)
    {
        dd($id);
    }

    public function edit($id)
    {
        $data = PaketMatkul::find($id);

        return response()->json($data);
    }

    public function update(Request $request, PaketMatkul $paketMatkul)
    {
        //
    }

    public function destroy($id)
    {
        PaketMatkul::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
