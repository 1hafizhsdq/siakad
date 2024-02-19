<?php
namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\RoleMenu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SharingComposer{
    public function compose(View $view){
        $data['menus'] = RoleMenu::with('menu.children')
            ->where('role_id',Auth::user()->id)
            ->where('is_active', 1)
            ->whereHas('menu', function($q){
                $q->whereNull('parent_id');
            })
            ->get();
        $data['childMenus'] = RoleMenu::with('menu')
            ->where('role_id',Auth::user()->id)
            ->where('is_active', 1)
            ->whereHas('menu', function($q){
                $q->whereNotNull('parent_id');
            })
            ->get();
        
        $view->with('layouts.patials.sidebar')->with($data);
    }
}