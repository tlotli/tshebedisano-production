<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'notes',
        'repository_id',
    ];

    public function user() {
       return $this->belongsTo('App\User');
    }
}
