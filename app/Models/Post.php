<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // this is not recommended at all
    protected $guarded = [];

    /**
     * Get the author for the blog post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
