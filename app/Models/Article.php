<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Jika primary key bukan 'id', Anda perlu menyebutkan nama kolom primary key
    protected $primaryKey = 'article_id';


    // Jika primary key bukan auto-incrementing, tambahkan properti ini
    public $incrementing = false;

    // Jika primary key bukan integer, tambahkan properti ini
    protected $keyType = 'string'; // Ganti dengan tipe data yang sesuai

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'title',
        'category_id',
        'content',
        'image',
    ];

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    // Relasi ke model User (untuk menyatakan bahwa artikel ini ditulis oleh pengguna)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Pastikan 'user_id' di sini sesuai dengan kolom di database
    }


    // Relasi ke model Category (untuk menyatakan kategori artikel)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Relasi ke model History (untuk menyatakan riwayat artikel)
    public function histories()
    {
        return $this->hasMany(History::class, 'article_id', 'article_id');
    }
}
