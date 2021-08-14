<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany('App\Models\Post')->orderBy('created_at', 'ASC');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function last_user()
    {
        return $this->belongsTo('App\Models\User', 'last_post_user_id', 'id');
    }
}
