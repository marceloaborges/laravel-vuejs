<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','active','user_add','user_upd','user_dlt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function search($filter = null)
    {
        return $this->where(function ($query) use ($filter) {
            if($filter){
                $query->where('name', 'LIKE', "%$filter%");
                $query->orwhere('email', 'LIKE', "%$filter%");
                        
            }
        })->paginate();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function roleAdd($role)
    {
        if(is_string($role))
        {
            $role = Role::where('name','=',$role)->firstOrFail();
        }

        if($this->existsRole($role))
        {
            return;
        }

        return $this->roles()->attach($role);
    }

    public function existsRole($role)
    {
        if(is_string($role))
        {
            $role = Role::where('name','=',$role)->firstOrFail();
        }

        return (boolean) $this->roles()->find($role->id);
    }

    public function roleRemove($role)
    {
        if(is_string($role))
        {
            $role = Role::where('name','=',$role)->firstOrFail();
        }

        return $this->roles()->detach($role);
    }

    public function isSuperAdmin(User $user)
    {
        // if($user->hasRoles('Admin'))
        //         return true;

        return $this->hasRoles('Admin');
    }

    /*public function hasPermission(Permission $permission)
    {
        return $this->hasRoles($permission->roles);
    }*/

    public function hasRoles($roles)
    {        
        if( is_array($roles) || is_object($roles) )
        {
            return !! $roles->intersect($this->roles)->count();
        }
        
        return $this->roles->contains('name', $roles);
    }
}
