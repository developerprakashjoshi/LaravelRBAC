<?php

namespace App\Traits;
use App\Models\{Role,Permission};
trait HasPermissionsTrait
{
    //get permissions
    public function getAllPermission($permission) {
        return Permission::where('slug',$permission->get());
    }

    //check permissions
    public function hasPermission($permission) {
        return (bool) $this->permissions->where('slug',$permission->slug)->count();
    }
    //check roles
    public function hasRole(...$roles) {
        foreach ($roles as $role) {
            if($this->roles->contains('slug',$role)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission) {
        $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);

    }

    public function givePermissionTo(...$permissions) {
        $permission=$this->getAllPermission($permissions);
        if($permission==null){
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;

    }


    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role) {
            if($this->roles->conatins($role)){
                return true;
            }
        }
        return false;
    }

    public function permissions() {
        return  $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function roles() {
        return  $this->belongsToMany(Role::class,'users_roles');
    }
}
