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

    public function isLiked()
    {
        if (!\Auth::check()) return false;

        return PostReaction::where('post_id', $this->id)
                           ->where('user_id', \Auth::user()->id)
                           ->where('is_like', true)
                           ->exists();
    }

    public function isDisliked()
    {
        if (!\Auth::check()) return false;

        return PostReaction::where('post_id', $this->id)
                           ->where('user_id', \Auth::user()->id)
                           ->where('is_like', false)
                           ->exists();
    }

    public function toggleReaction($type)
    {
        if (!\Auth::check()) return;

        $existingReaction = PostReaction::where('post_id', $this->id)
                                        ->where('user_id', \Auth::user()->id)
                                        ->first();

        if (!$existingReaction) {
            // Didn't reacted before
            PostReaction::create([
                'post_id' => $this->id,
                'user_id' => \Auth::user()->id,
                'is_like' => ($type === 'like'),
                'ip' => \Request::ip(),
            ]);
        } else {
            $shouldCleanUp = false;

            if ($existingReaction->is_like) {
                // Liked before
                if ($type === 'dislike') {
                    $existingReaction->is_like = false;
                } else {
                    $shouldCleanUp = true;
                }
            } else {
                // Disliked before
                if ($type === 'like') {
                    $existingReaction->is_like = true;
                } else {
                    $shouldCleanUp = true;
                }
            }

            if ($shouldCleanUp) {
                // Clean up
                PostReaction::where('post_id', $this->id)
                            ->where('user_id', \Auth::user()->id)
                            ->delete();
            } else {
                $existingReaction->save();
            }
        }

        $this->refreshReactionCount();
    }

    public function reactions()
    {
        return $this->hasMany('App\Models\PostReaction');
    }

    public function refreshReactionCount()
    {
        $this->likes_count = $this->reactions->where('is_like', true)->count();
        $this->dislikes_count = $this->reactions->where('is_like', false)->count();
        $this->save();
    }
}
