<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function createRole($name) {
        $role = Role::create(['name' => $name]);
        return $role;
    }

    public function createPermission($permissionName) {
        $permission = Permission::create(['name' => $permissionName]);
        return $permission;
    }

    public function attachPermissionToRole($roleName, $permissionName) {
        try {
            $role = Role::findByName($roleName);
            $permission = Permission::findByName($permissionName);
            $role->givePermissionTo($permission);
            return "success";
        } catch(Exception $ex) {
            return $ex->getMessage();        
        }   
    }


    public function attachRoleToUser($userId, $roleName) {
        try {
            $role = Role::findByName($roleName);
            $user = User::findById($userId);
            $user->assignRole($role);
            return "success";
        } catch(Exception $ex) {
            return $ex->getMessage();        
        }   
    }


    public function getRoles($userId) {
        try {
            $user = User::findById($userId);
            $roles = $user->getRoleNames();
            return $roles;
        } catch(Exception $ex) {
            return $ex->getMessage();        
        }   
    }


    public function editArticle() {
        $user = Auth::user();
        if($user->can('edit articles')) {
            return "edit success";
        } else {
            return "edit fail";
        }
    }
}
