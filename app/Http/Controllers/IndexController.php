<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request) {
        $role = Role::findById(1);
        $permission = Permission::findById(1);
        $role->givePermissionTo($permission);
        //echo "ww";

        $user = Auth::user();
        $user->assignRole('writer');
        return $user;

    }

    public function index(Request $request) {

    }
}
