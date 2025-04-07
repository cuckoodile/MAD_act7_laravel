<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
