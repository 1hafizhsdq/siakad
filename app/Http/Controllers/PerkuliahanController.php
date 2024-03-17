<?php

namespace App\Http\Controllers;

use App\Models\Perkuliahan;
use App\Models\PerkuliahanDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PerkuliahanController extends Controller
{
    public function index()
    {
        $data['title'] = 'Data Perkuliahan';

        return view('perkuliahan.index',$data);
    }

    public function list($user){
        $data = Perkuliahan::with('dosen','tahunajaran')
            ->where('user_id',$user)
            ->orderBy('id','desc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('dosen', function ($data){
                return $data->dosen->nama;
            })
            ->editColumn('tahunajaran', function ($data){
                return $data->tahunajaran->nama_tahun_ajaran.' '.$data->tahunajaran->semester;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/perkuliahan/'.$data->id.'" id="btn-detail" data-id="'.$data->id.'" class="btn btn-xs btn-info detailData" title="Edit Data">
                        <i class="bi bi-eye"></i>
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
        //
    }

    public function show($id)
    {
        $data['title'] = 'Data Perkuliahan Detail';
        $data['data'] = PerkuliahanDetail::with('dosen','matkul')
            ->where('perkuliahan_id',$id)
            ->get();

        return view('perkuliahan.detail',$data);
    }

    public function edit(Perkuliahan $perkuliahan)
    {
        //
    }

    public function update(Request $request, Perkuliahan $perkuliahan)
    {
        //
    }

    public function destroy(Perkuliahan $perkuliahan)
    {
        //
    }
}
