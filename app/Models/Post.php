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

    public function excerpt($limit = 180)
    {
        $content = strip_tags($this->content);

        if (mb_strlen($content, 'utf-8') > $limit ) {
            return mb_substr($content, 0, $limit, 'utf-8') . '...';
        }

        return $content;
    }
}
