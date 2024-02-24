<?php

namespace App\Http\Controllers;

use App\Models\BiodataMahasiswa;
use App\Models\Pendaftaran;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pendaftaran';
        $data['user'] = User::with('pendaftaran','biodatamahasiswa')
            ->where('id', Auth::user()->id)
            ->first();

        if($data['user']->pendaftaran->isEmpty()){
            $data['prodi'] = Prodi::get();
            $data['tahun_ajaran'] = TahunAjaran::where('is_active',1)->first();
            $data['is_regis'] = false;
        }else{
            $data['is_regis'] = true;
        }

        return view('pendaftaran.calon-mahasiswa',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'nisn' => 'required',
            'jenis_sekolah' => 'required',
            'nama_sekolah' => 'required',
            'jurusan_sekolah' => 'required',
            'tahun_masuk' => 'required',
            'tahun_lulus' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
            'no_ijazah' => 'required',
            'prodi_id' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong!',
            'tgl_lahir.required' => 'Tanggal Lahir tidak boleh kosong!',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'telp.required' => 'Nomor Telepon tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'nik.required' => 'NIK tidak boleh kosong!',
            'nisn.required' => 'NISN tidak boleh kosong!',
            'jenis_sekolah.required' => 'Jenis Sekolah tidak boleh kosong!',
            'nama_sekolah.required' => 'Nama Sekolah tidak boleh kosong!',
            'jurusan_sekolah.required' => 'Jurusan Sekolah tidak boleh kosong!',
            'tahun_masuk.required' => 'Tahun Masuk tidak boleh kosong!',
            'tahun_lulus.required' => 'Tahun Lulus tidak boleh kosong!',
            'file.required' => 'Ijazah tidak boleh kosong!',
            'file.mimes' => 'Ijazah harus berformat PDF!',
            'file.max' => 'Ijazah maksimal berukuran 2MB!',
            'no_ijazah.required' => 'No. Ijazah tidak boleh kosong!',
            'prodi_id.required' => 'Program Studi tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        
        if ($request->hasfile('file')) {
            $filename = round(microtime(true) * 1000).'-'.$request->no_ijazah. '.' . $request->file->extension();
            $request->file->move(storage_path('app/ijazah/'), $filename);
        }

        try {
            User::where('id',$request->user_id)
                ->update([
                    'tempat_lahir' => strtoupper($request->tempat_lahir), 
                    'tgl_lahir' => $request->tgl_lahir, 
                    'jenis_kelamin' => $request->jenis_kelamin, 
                    'nik' => $request->nik, 
                    'alamat' => $request->alamat, 
                ]);
            
            BiodataMahasiswa::create([
                'user_id' => $request->user_id,
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'jenis_sekolah' => strtoupper($request->jenis_sekolah),
                'nama_sekolah' => strtoupper($request->nama_sekolah),
                'jurusan_sekolah' => strtoupper($request->jurusan_sekolah),
                'tahun_masuk' => $request->tahun_masuk,
                'tahun_lulus' => $request->tahun_lulus,
                'nama_ayah' => strtoupper($request->nama_ayah),
                'tempat_lahir_ayah' => strtoupper($request->tempat_lahir_ayah),
                'tgl_lahir_ayah' => $request->tgl_lahir_ayah,
                'nik_ayah' => $request->nik_ayah,
                'alamat_ayah' => $request->alamat_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => strtoupper($request->pekerjaan_ayah),
                'nama_ibu' => strtoupper($request->nama_ibu),
                'tempat_lahir_ibu' => strtoupper($request->tempat_lahir_ibu),
                'tgl_lahir_ibu' => $request->tgl_lahir_ibu,
                'nik_ibu' => $request->nik_ibu,
                'alamat_ibu' => $request->alamat_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => strtoupper($request->pekerjaan_ibu),
                'prodi_id' => $request->prodi_id,
                'ijazah' => $filename,
                'no_ijazah' => $request->no_ijazah,
            ]);

            Pendaftaran::create([
                'user_id' => $request->user_id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'prodi_id' => $request->prodi_id,
            ]);

            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data']]);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
