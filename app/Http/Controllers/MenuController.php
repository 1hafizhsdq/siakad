<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        $data['title'] = "Menu";
        $data['role'] = Role::get();

        return view('menu.index',$data);
    }

    public function list(){
        $data = Menu::with('children')
                ->whereNull('parent_id')
                ->orderBy('sequence')
                ->get();

        $formattedData = collect();

        foreach ($data as $menu) {
            $formattedData->push($menu);
            foreach($menu->children as $chl){
                $formattedData->push($chl);
            }
        }

        return DataTables::of($formattedData)
            ->addIndexColumn()
            ->editColumn('menu', function ($data) {
                if($data->parent_id == null){
                    return $data->menu;
                }else{
                    return '&emsp;&emsp;'.$data->menu;
                }
            })
            ->editColumn('parent', function ($data) {
                if($data->parent_id != null){
                    return $data->parent->menu;
                }else{
                    return '';
                }
            })
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
            ->rawColumns(['aksi','menu'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu' => 'required',
        ], [
            'menu.required' => 'Menu tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            try {
                Menu::updateOrCreate(
                    ['id' =>  $request->id],
                    [
                        'menu' => $request->menu,
                        'url' => $request->url,
                        'parent_id' => $request->parent_id,
                        'sequence' => $request->sequence ?? 0,
                        'icon' => $request->icon,
                    ]
                );
    
                return response()->json([ 'success' => 'Berhasil menyimpan data.']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['Gagal menyimpan data, '.$th]]);
            }
        }
    }

    public function show(Menu $menu)
    {
        $data = Menu::whereNull('parent_id')->get();

        return response()->json($data);
    }

    public function edit(Menu $menu)
    {
        $data = Menu::where('id',$menu->id)->first();

        return response()->json($data);
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        Menu::where('id',$menu->id)->update(['deleted_at' => now()]);
        return response()->json(['success' => 'Berhasil menghapus data']);
    }
}
