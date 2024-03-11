<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Prodi;
use App\Models\TahunAjaran;
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
                    <a href="javascripts:void(0)" id="btn-accept" data-nim="'.$data->user->no_induk.'" data-id="'.$data->id.'" class="btn btn-xs btn-success acceptData" title="Terima Data">
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
        ], [
            'id.required' => 'ID tidak boleh kosong!',
            'nim.required' => 'NIM tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        try {
            Pendaftaran::where('id',$request->id)->update(['is_valid' => 1]);
            
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
