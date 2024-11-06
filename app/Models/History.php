<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $primaryKey = 'history_id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'article_id', 'video_id', 'viewed_at'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Di dalam model History
public function article()
{
    return $this->belongsTo(Article::class, 'article_id');
}

public function video()
{
    return $this->belongsTo(Video::class, 'video_id');
}

public function forumPost()
{
    return $this->belongsTo(ForumPost::class, 'post_id');
}

}
