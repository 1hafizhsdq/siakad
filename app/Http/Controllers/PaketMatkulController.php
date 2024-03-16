<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\Matkul;
use App\Models\PaketMatkul;
use App\Models\PaketMatkulDetail;
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
    
    public function listDetail($paket){
        $data = PaketMatkulDetail::with(['jadwal.matkul', 'jadwal.dosen'])
            ->leftJoin('jadwal_kuliahs', 'paket_matkul_details.jadwal_id', '=', 'jadwal_kuliahs.id')
            ->where('paket_id', $paket)
            ->orderByRaw("
                CASE
                    WHEN jadwal_kuliahs.hari = 'SENIN' THEN 1
                    WHEN jadwal_kuliahs.hari = 'SELASA' THEN 2
                    WHEN jadwal_kuliahs.hari = 'RABU' THEN 3
                    WHEN jadwal_kuliahs.hari = 'KAMIS' THEN 4
                    WHEN jadwal_kuliahs.hari = 'JUMAT' THEN 5
                    WHEN jadwal_kuliahs.hari = 'SABTU' THEN 6
                    WHEN jadwal_kuliahs.hari = 'MINGGU' THEN 7
                    ELSE 8
                END
            ")
            ->orderBy('jadwal_kuliahs.jam_perkuliahan_id')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('waktu', function ($data) {
                return $data->jadwal->hari.' '.$data->jadwal->jam_perkuliahan->mulai.'-'.$data->jadwal->jam_perkuliahan->selesai;
            })
            ->addColumn('matkul', function ($data) {
                return $data->jadwal->matkul->mata_kuliah;
            })
            ->addColumn('dosen', function ($data) {
                return $data->jadwal->dosen->nama;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascript:void(0)" id="btn-delete" data-id="'.$data->id.'" class="btn btn-xs btn-danger deleteData" title="Hapus Data">
                        <i class="bi bi-trash"></i>
                    </a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function getMatkul($prodi){
        $data = JadwalKuliah::with('matkul','jam_perkuliahan')->where('prodi_id',$prodi)->get();

        return response()->json($data);
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
        $data['title'] = "Detail Paket Kuliah";
        $data['paket'] = PaketMatkul::where('id',$id)->first();

        return view('paket_kuliah.detail',$data);
    }

    public function storeDetail(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jadwal.*' => 'required',
        ], [
            'id.required' => 'Paket ID tidak boleh kosong!',
            'jadwal.*.required' => 'Jadwal tidak boleh kosong!',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        try {
            foreach($request->jadwal as $j){
                PaketMatkulDetail::updateOrCreate(
                    [
                        'paket_id' => $request->id,
                        'jadwal_id' => $j,
                    ],
                    [
                        'paket_id' => $request->id,
                        'jadwal_id' => $j,
                        'created_at' => now(),
                    ]
                );
            }
            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data '.$th]]);
        }
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
    
    public function destroyDetail($id)
    {
        PaketMatkulDetail::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
