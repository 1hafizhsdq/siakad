<?php

namespace App\Http\Controllers;

use App\Models\PaketMatkul;
use App\Models\PaketMatkulDetail;
use App\Models\Pendaftaran;
use App\Models\Perkuliahan;
use App\Models\PerkuliahanDetail;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HerregistrasiController extends Controller
{
    public function index()
    {
        $data['title'] = 'Herregistrasi';
        $data['tahun_ajarans'] = TahunAjaran::get();
        $data['prodi'] = Prodi::get();
        $data['dosens'] = User::where('role_id',3)->get();

        return view('herregistrasi.index',$data);
    }

    public function list($tahunajaran = null, $prodi = null){
        $data = Pendaftaran::with('user','prodi')
            ->whereNotNull('bukti_bayar_herregistrasi')
            ->whereNull('is_valid');
        
        if($tahunajaran != null){
            $data = $data->where('tahun_ajaran_id',$tahunajaran);
        }
        if($prodi != null){
            $data = $data->where('prodi_id',$prodi);
        }

        $data = $data->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('nim', function($data){
                return $data->user->no_induk ?? 'Mahasiswa Baru';
            })
            ->editColumn('nama', function($data){
                return $data->user->nama;
            })
            ->editColumn('prodi', function($data){
                return $data->prodi->nama_prodi;
            })
            ->editColumn('bukti', function($data){
                return '<a href="/herregistrasi/'.$data->bukti_bayar_herregistrasi.'" target="_blank">Lihat Bukti</a>';
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascripts:void(0)" id="btn-accept" data-nim="'.$data->user->no_induk.'" data-id="'.$data->id.'" data-userid="'.$data->user_id.'" data-prodiid="'.$data->prodi_id.'" 
                        data-dosen="'.$data->user->dosen_id.'" data-semester="'.$data->semester.'" class="btn btn-xs btn-success acceptData" title="Terima Data">
                        Konfirmasi
                    </a>
                ';
            })
            ->rawColumns(['aksi','bukti'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nim' => 'required',
            'semester' => 'required',
            'paket' => 'required',
            'dosen_id' => 'required',
        ], [
            'id.required' => 'ID tidak boleh kosong!',
            'nim.required' => 'NIM tidak boleh kosong!',
            'semester.required' => 'Semester tidak boleh kosong!',
            'paket.required' => 'Paket tidak boleh kosong!',
            'dosen_id.required' => 'Dosen tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        try {
            $paket = PaketMatkulDetail::where('paket_id',$request->paket)->get();
            Pendaftaran::where('id',$request->id)->update(['is_valid' => 1]);
            User::where('id',$request->userid)->update([
                'no_induk' => $request->nim,
                'role_id' => 4,
            ]);
            $perkuliahan = Perkuliahan::create([
                'user_id' => $request->userid,
                'dosen_id' => $request->dosen_id,
                'tahun_ajaran_id' => $request->tahun_ajaran_id,
                'prodi_id' => $request->prodi_id,
                'semester' => $request->semester,
            ]);

            foreach($paket as $p){
                PerkuliahanDetail::create([
                    'perkuliahan_id' => $perkuliahan->id,
                    'jadwal_id' => $p->jadwal_id,
                ]);
            }
            
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
        $data = PaketMatkul::where('prodi_id',$id)->get();

        return response()->json($data);
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
