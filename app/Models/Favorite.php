<?php

// app/Models/Favorite.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ForumPost;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites'; // Nama tabel
    public const UPDATED_AT = 'modified_at'; // Gunakan 'modified_at' sebagai timestamp untuk updated_at
    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    // Relationship with ForumPost
    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id', 'post_id');
    }

    // Relasi ke model ForumPost
    public function forumPost()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }

    public function favorited()
    {
        // Misalkan Anda punya tabel favorites dengan kolom user_id dan post_id
        return $this->hasOne(Favorite::class, 'post_id')
                    ->where('user_id', Auth::id());
    }
}
