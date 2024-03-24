<?php

namespace App\Http\Controllers;

use App\Models\JadwalKuliah;
use App\Models\JenisPerkuliahan;
use App\Models\Matkul;
use App\Models\Pertemuan;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PertemuanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Pertemuan';
        $data['prodis'] = Prodi::get();
        $data['tahunajarans'] = TahunAjaran::get();

        return view('pertemuan.index',$data);
    }

    public function list($user,$tahunajaran,$prodi){
        $data = Pertemuan::with('dosen','tahunajaran','matkul','jadwal','jenisperkuliahan','ruangan')
            ->where('dosen_id',$user);
        if($tahunajaran != null){
            $data = $data->where('tahun_ajaran_id',$tahunajaran);
        }
        if($prodi != null){
            $data = $data->whereHas('matkul', function($q) use($prodi){
                $q->where('prodi_id',$prodi);
            });
        }
        $data = $data->orderBy('pertemuan_ke','ASC')
            ->get()
            ->sortBy('matkul.mata_kuliah');

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('jenispertemuan', function ($data){
                return $data->jenisperkuliahan->jenis_perkuliahan;
            })
            ->editColumn('waktu', function ($data){
                return $data->tgl_pertemuan.' @ '.$data->waktu_mulai.' s/d '.$data->waktu_selesai;
            })
            ->editColumn('tahun_ajaran', function ($data){
                return $data->tahunajaran->nama_tahun_ajaran.' - '.$data->tahunajaran->semester;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/pertemuan/'.$data->id.'/edit" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning" title="Edit Data">
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
        $data['title'] = 'Detail Pertemuan';
        $data['prodis'] = Prodi::get();
        $data['jenis_perkuliahans'] = JenisPerkuliahan::get();
        $data['tahunajarans'] = TahunAjaran::get();
        $data['user'] = User::find(Auth::user()->id);

        return view('pertemuan.form',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pertemuan_ke' => 'required',
            'jenis_perkuliahan_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'prodi_id' => 'required',
            'matkul_id' => 'required',
            'dosen_id' => 'required',
            'tgl_pertemuan' => 'required',
        ], [
            'pertemuan_ke.required' => 'Pertemuan Ke- tidak boleh kosong!',
            'jenis_perkuliahan_id.required' => 'Jenis Pertemuan tidak boleh kosong!',
            'tahun_ajaran_id.required' => 'Tahun Ajaran tidak boleh kosong!',
            'prodi_id.required' => 'Program Studi tidak boleh kosong!',
            'matkul_id.required' => 'Mata Kuliah tidak boleh kosong!',
            'dosen_id.required' => 'Dosen tidak boleh kosong!',
            'tgl_pertemuan.required' => 'Tanggal Pertemuan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $data = [
            'pertemuan_ke' => $request->pertemuan_ke,
            'jenis_perkuliahan_id' => $request->jenis_perkuliahan_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'prodi_id' => $request->prodi_id,
            'matkul_id' => $request->matkul_id,
            'jadwal_id' => $request->jadwal_id,
            'ruangan_id' => $request->ruangan_id,
            'sks' => $request->sks,
            'dosen_id' => $request->dosen_id,
            'tgl_pertemuan' => $request->tgl_pertemuan,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'rencana_materi' => $request->rencana_materi,
            'realisasi_materi' => $request->realisasi_materi,
        ];

        if ($request->hasfile('materi')) {
            $materi = round(microtime(true) * 1000).'.' . $request->materi->extension();
            $request->materi->move(storage_path('app/materi/'), $materi);
            $data['materi'] = $materi;
        }

        try {
            Pertemuan::updateOrCreate(
                ['id' =>  $request->id],
                $data
            );

            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data '.$th]]);
        }
    }

    public function getMatkul($id){
        $data = Matkul::where('prodi_id',$id)->get();

        return response()->json($data);
    }
    
    public function getJadwal($matkul,$dosen){
        $data = JadwalKuliah::with('jam_perkuliahan')->where('matkul_id',$matkul)->where('user_id',$dosen)->get();

        return response()->json($data);
    }
    
    public function getJadwalFind($id){
        $data = JadwalKuliah::with('jam_perkuliahan','dosen','matkul')->where('id',$id)->first();

        return response()->json($data);
    }

    public function show(Pertemuan $pertemuan)
    {
        //
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Pertemuan';
        $data['prodis'] = Prodi::get();
        $data['jenis_perkuliahans'] = JenisPerkuliahan::get();
        $data['tahunajarans'] = TahunAjaran::get();
        $data['user'] = User::find(Auth::user()->id);
        $data['pertemuan'] = Pertemuan::where('id',$id)->first();
        $data['matkuls'] = Matkul::where('prodi_id',$data['pertemuan']->prodi_id)->get();
        $data['jadwals'] = JadwalKuliah::with('jam_perkuliahan')->where('matkul_id',$data['pertemuan']->matkul_id)->where('user_id',$data['pertemuan']->dosen_id)->get();


        return view('pertemuan.form',$data);
    }

    public function update(Request $request, Pertemuan $pertemuan)
    {
        //
    }

    public function delMateri($id){
        $data = Pertemuan::where('id',$id)->first();
        Storage::disk('public')->delete($data->materi);
        Pertemuan::where('id',$id)->update(['materi' => null]);

        return response()->json(['success' => 'Berhasil menyimpan perubahan']);
    }

    public function destroy($id)
    {
        Pertemuan::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
