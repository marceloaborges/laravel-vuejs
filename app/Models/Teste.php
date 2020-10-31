<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teste extends Model
{
    protected $fillable = [
        'name', 'title','description','observation','user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
