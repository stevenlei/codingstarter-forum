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
        return $this->hasMany('App\Models\Post');
    }

    public function getOrderedPosts($order)
    {
        if ($order === 'default')
        {
            return $this->posts()->orderBy('is_first', 'DESC')->orderBy('created_at', 'ASC')->get();
        } else if ($order === 'latest')
        {
            return $this->posts()->orderBy('is_first', 'DESC')->orderBy('created_at', 'DESC')->get();
        } else if ($order === 'hot')
        {
            return $this->posts()->orderBy('is_first', 'DESC')->orderBy('likes_count', 'DESC')->orderBy('created_at', 'ASC')->get();
        } else {
            return [];
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function last_user()
    {
        return $this->belongsTo('App\Models\User', 'last_post_user_id', 'id');
    }

    // TODO: Optimisation required. Fetch all likes/dislikes status for one topic, and should includes the status of reaction for current logged-in user
    public function getReactions()
    {
        $reactions = collect($this->posts)->map(function ($post) {
            return [
                'likes' => $post->likes_count,
                'dislikes' => $post->dislikes_count,
            ];
        })->toArray();

        return $reactions;
    }
}
