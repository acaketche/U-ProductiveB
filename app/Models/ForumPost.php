<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forum_post';
    protected $primaryKey = 'post_id';

    protected $fillable = [ 'content', 'user_id', 'created_at', 'is_lecturer'];

    public $timestamps = false; // Nonaktifkan timestamps jika kolom tidak ada

    // Deklarasikan kolom tanggal
    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Comment

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

}

