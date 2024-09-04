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
        'updated_at'
    ];

    // app/Models/Video.php
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
