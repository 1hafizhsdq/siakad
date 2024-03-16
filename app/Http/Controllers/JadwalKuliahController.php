<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\JamPerkuliahan;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $data['title'] = "Jadwal Kuliah";
        $data['dosens'] = User::where('role_id',3)->get();
        $data['ruangans'] = Ruangan::get();
        $data['tahun_ajarans'] = TahunAjaran::get();
        $data['jam_perkuliahans'] = JamPerkuliahan::get();
        $data['prodis'] = Prodi::get();

        return view('jadwal_kuliah.index',$data);
    }

    public function list($tahunAjaran,$prodi){
        $data = JadwalKuliah::with('dosen','matkul','ruangan','jam_perkuliahan')
            ->where('tahun_ajaran_id',$tahunAjaran)
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
                        ['tahun_ajaran_id', '=', $request->tahun_ajaran_id],
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
                            'tahun_ajaran_id' => $request->tahun_ajaran_id,
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
