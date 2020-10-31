<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Teste;


class TestePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*public function before($user, $ability)
    {
        dd($user);
        if($user->isSuperAdmin($user))
        {
            return true;
        } 
    }*/

    public function showTeste($user, Teste $teste)
    {
        return $user->id == $teste->user_id;
    }

    public function editTeste($user, Teste $teste)
    {
        return $user->id == $teste->user_id;
    }

    public function deleteTeste($user, Teste $teste)
    {
        return $user->id == $teste->user_id;
    }
}
