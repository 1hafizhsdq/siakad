<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\JamPerkuliahan;
use App\Models\Matkul;
use App\Models\Perkuliahan;
use App\Models\PerkuliahanDetail;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $data['title'] = "Jadwal Kuliah";
        $data['tahun_ajarans'] = TahunAjaran::get();

        if(Auth::user()->role_id == 4){
            return view('jadwal_kuliah.index-mahasiswa',$data);
        }else{
            $data['dosens'] = User::where('role_id',3)->get();
            $data['ruangans'] = Ruangan::get();
            $data['jam_perkuliahans'] = JamPerkuliahan::get();
            $data['prodis'] = Prodi::get();
    
            return view('jadwal_kuliah.index',$data);
        }
    }

    public function list($prodi){
        $data = JadwalKuliah::with('dosen','matkul','ruangan','jam_perkuliahan')
            ->where('prodi_id',$prodi)
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('dosen', function ($data) {
                return $data->dosen->nama;
            })
            ->addColumn('matkul', function ($data) {
                return $data->matkul->mata_kuliah;
            })
            ->addColumn('jadwal', function ($data) {
                return $data->hari.' ('.$data->jam_perkuliahan->mulai.' - '.$data->jam_perkuliahan->selesai.')';
            })
            ->addColumn('ruangan', function ($data) {
                return $data->ruangan->nama_ruangan;
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

    public function listMahasiswa($tahunajaran){
        $data = PerkuliahanDetail::with('perkuliahan','jadwal.dosen','jadwal.matkul','jadwal.ruangan','jadwal.jam_perkuliahan')
            ->join('jadwal_kuliahs', 'perkuliahan_details.jadwal_id', '=', 'jadwal_kuliahs.id')
            ->whereHas('perkuliahan', function($q) use ($tahunajaran){
                $q->where('tahun_ajaran_id', $tahunajaran)->where('user_id', Auth::user()->id);
            })
            ->orderByRaw("CASE
                                WHEN jadwal_kuliahs.hari = 'SENIN' THEN 1
                                WHEN jadwal_kuliahs.hari = 'SELASA' THEN 2
                                WHEN jadwal_kuliahs.hari = 'RABU' THEN 3
                                WHEN jadwal_kuliahs.hari = 'KAMIS' THEN 4
                                WHEN jadwal_kuliahs.hari = 'JUMAT' THEN 5
                                WHEN jadwal_kuliahs.hari = 'SABTU' THEN 6
                                WHEN jadwal_kuliahs.hari = 'MINGGU' THEN 7
                                ELSE 8
                            END")
            ->orderBy('jadwal_kuliahs.jam_perkuliahan_id')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('dosen', function ($data) {
                return $data->jadwal->dosen->nama;
            })
            ->addColumn('matkul', function ($data) {
                return $data->jadwal->matkul->mata_kuliah;
            })
            ->addColumn('jadwal', function ($data) {
                return $data->jadwal->hari.' ('.$data->jadwal->jam_perkuliahan->mulai.' - '.$data->jadwal->jam_perkuliahan->selesai.')';
            })
            ->addColumn('ruangan', function ($data) {
                return $data->jadwal->ruangan->nama_ruangan;
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
            'user_id' => 'required',
            'matkul_id' => 'required',
            'ruangan_id' => 'required',
            'hari' => 'required',
            'jam_perkuliahan_id' => 'required',
        ], [
            'user_id.required' => 'Dosen tidak boleh kosong!',
            'matkul_id.required' => 'Mata Kuliah tidak boleh kosong!',
            'ruangan_id.required' => 'Ruangan tidak boleh kosong!',
            'hari.required' => 'Hari tidak boleh kosong!',
            'jam_perkuliahan_id.required' => 'Jam Perkuliahan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                $jadwal = JadwalKuliah::where(
                    [
                        ['user_id', '=', $request->user_id],
                        ['hari', '=', $request->hari],
                        ['jam_perkuliahan_id', '=', $request->jam_perkuliahan_id],
                    ]
                )
                ->get();

                if ($jadwal->count() > 0) {
                    return response()->json(['errors' => ['Dosen sudah ada jadwal perkuliahan pada jadwal ini']]);
                }else{
                    JadwalKuliah::updateOrCreate(
                        ['id' =>  $request->id],
                        [
                            'user_id' => $request->user_id,
                            'matkul_id' => $request->matkul_id,
                            'ruangan_id' => $request->ruangan_id,
                            'hari' => $request->hari,
                            'jam_perkuliahan_id' => $request->jam_perkuliahan_id,
                            'prodi_id' => $request->prodi_id,
                        ]
                    );
                }
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data ']]);
            }
        }
    }

    public function show(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    public function edit(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        //
    }

    public function destroy($id)
    {
        JadwalKuliah::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
