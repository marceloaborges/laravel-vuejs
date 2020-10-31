<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name','description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function search($filter = null)
    {
        return $this->where(function ($query) use ($filter) {
            if($filter){
                $query->where('name', 'LIKE', "%$filter%");
                $query->orwhere('description', 'LIKE', "%$filter%");                        
            }
        })->paginate();
    }

    public function permissionAdd($permission)
    {
        if(is_string($permission))
        {
            $permission = Role::where('name','=',$permission)->firstOrFail();
        }

        if($this->existsPermission($permission))
        {
            return;
        }

        return $this->permissions()->attach($permission);
    }

    public function existsPermission($permission)
    {
        if(is_string($permission))
        {
            $permission = Permission::where('name','=',$permission)->firstOrFail();
        }

        return (boolean) $this->permissions()->find($permission->id);
    }

    public function permissionRemove($permission)
    {
        if(is_string($permission))
        {
            $permission = Permission::where('name','=',$permission)->firstOrFail();
        }

        return $this->permissions()->detach($permission);
    }
}
