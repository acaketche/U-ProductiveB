<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{


    use HasFactory;

    protected $table = 'videos';
    protected $primaryKey = 'video_id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'url',
        'category_id',
        'description',
        'thumbnail_url',
        'created_at',
        'updated_at',
        'user_id',
        'status'
    ];

    // app/Models/Video.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    use HasFactory;

    public function histories()
    {
        return $this->hasMany(History::class, 'video_id');
    }

}
