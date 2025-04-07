<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'created_by',
        'description',
        'media_link',
        'thumbnail_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
