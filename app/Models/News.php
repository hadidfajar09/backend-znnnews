<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id', 'user_id', 'name', 'author', 'title', 'description', 'url', 'urlToImage', 'publishedAt', 'content', 'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
