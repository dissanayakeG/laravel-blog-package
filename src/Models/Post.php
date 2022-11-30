<?php


namespace DissanayajeG\pack\Models;


use DissanayajeG\pack\Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Disable Laravel's mass assignment protection
    protected $guarded = [];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function author()
    {
        return $this->morphTo();
    }
}