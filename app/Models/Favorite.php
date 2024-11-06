<?php

// app/Models/Favorite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites'; // Nama tabel
    public const UPDATED_AT = 'modified_at'; // Gunakan 'modified_at' sebagai timestamp untuk updated_at
    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = ['user_id', 'article_id', 'video_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }
}
