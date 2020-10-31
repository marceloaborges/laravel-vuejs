<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Teste' => 'App\Policies\TestePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        Gate::before(function($user, $ability){
            if($user->hasRoles('Admin'))
                return true;             
        });            
        

        $permissions = Permission::with('roles')->get();
        foreach( $permissions as $permission )
        {           
            Gate::define($permission->name, function($user) use ($permission) {
                return $user->hasRoles($permission->roles);
            });
        }
    }
}
