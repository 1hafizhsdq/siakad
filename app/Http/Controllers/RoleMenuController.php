<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleMenuController extends Controller
{
    public function index()
    {
        $data['title'] = "Role Menu";
        $data['role'] = Role::with('rolemenu')->get();

        return view('role_menu.index',$data);
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
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="javascript:void(0)" id="btn-edit" data-id="'.$data->id.'" class="btn btn-xs btn-warning editData" title="Edit Data">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                ';
            })
            ->rawColumns(['aksi','menu'])
            ->make(true);
    }

    public function status($menuid){
        $data = Role::with('rolemenu')->get();

        return response()->json($data);
    }

    public function store(Request $request){
        try {
            foreach($request->role as $rl_key => $rl_val){
                RoleMenu::updateOrCreate(
                    [
                        'menu_id' =>  $request->menu_id,
                        'role_id' => $rl_key,
                    ],
                    [
                        'is_active' => ($rl_val == 'on') ? '1' : null, 
                    ]
                );
            }
            return response()->json([ 'success' => 'Berhasil menyimpan data.']);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['Gagal menyimpan data']]);
        }
    }
}
