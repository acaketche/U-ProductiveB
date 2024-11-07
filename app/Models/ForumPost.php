<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forum_post';
    protected $primaryKey = 'post_id';

    protected $fillable = [ 'content', 'user_id', 'created_at', 'is_lecturer'];

    public $timestamps = false; // Nonaktifkan timestamps jika kolom tidak ada

    // Deklarasikan kolom tanggal
    protected $dates = ['created_at'];


   // Relasi dengan model User
   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi dengan model Comment

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    // public function favoritedBy()
    // {
    //     return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id');
    // }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id'); // Pastikan nama foreign key benar
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id'); // Pastikan nama foreign key benar
    }

    public function favorited()
    {
        // Misalkan Anda punya tabel favorites dengan kolom user_id dan post_id
        return $this->hasOne(Favorite::class, 'post_id')
                    ->where('user_id', Auth::id());
    }

    public function favorites()
    {
        return $this->belongsToMany(ForumPost::class, 'favorites', 'user_id', 'post_id');
    }

}

