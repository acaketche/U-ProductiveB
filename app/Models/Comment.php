<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    public $timestamps = false; // Nonaktifkan timestamps jika kolom tidak ada

    protected $fillable = ['post_id', 'content', 'user_id'];

    // Relasi dengan model ForumPost
    public function post()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
