<?php


namespace DissanayajeG\pack\Traits;


use DissanayajeG\pack\Models\Post;

trait HasPosts
{
    public function posts()
    {
        return $this->morphMany(Post::class, 'author');
    }
}