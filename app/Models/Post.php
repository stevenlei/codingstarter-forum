<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
