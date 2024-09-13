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

    protected $fillable = [
        'title',
        'category_id',
        'content',
        'image',
    ];

    public $timestamps = false; // Menonaktifkan penggunaan kolom created_at dan updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
