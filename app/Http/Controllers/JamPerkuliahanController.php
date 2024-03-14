<?php

namespace App\Http\Controllers;

use App\Models\JamPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JamPerkuliahanController extends Controller
{
    public function index()
    {
        $data['title'] = "Jam Perkuliahan";

        return view('jam_perkuliahan.index',$data);
    }

    public function list(){
        $data = JamPerkuliahan::orderBy('jam_ke','ASC')->get();

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
            'jam_ke' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ], [
            'jam_ke.required' => 'Jam Ke tidak boleh kosong!',
            'mulai.required' => 'Mulai tidak boleh kosong!',
            'selesai.required' => 'Selesai tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                JamPerkuliahan::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'jam_ke' => $request->jam_ke,
                        'mulai' => $request->mulai,
                        'selesai' => $request->selesai,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data']]);
            }
        }
    }

    public function show(JamPerkuliahan $jamPerkuliahan)
    {
        //
    }

    public function edit($id)
    {
        $data = JamPerkuliahan::find($id);

        return response()->json($data);
    }

    public function update(Request $request, JamPerkuliahan $jamPerkuliahan)
    {
        //
    }

    public function destroy($id)
    {
        JamPerkuliahan::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
