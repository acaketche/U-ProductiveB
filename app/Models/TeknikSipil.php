<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class TeknikSipil extends Model
{
    use HasFactory;

    protected $table = 'teknik_sipils'; // Nama tabel
    protected $primaryKey = 'ts_id'; // Primary key

    public $timestamps = false; // Menggunakan timestamps untuk created_at dan updated_at

    protected $fillable = [
        'title',
        'file_pdf',
        'category_id',
        'user_id',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function user()

    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Sesuaikan 'id' dengan primary key pada tabel users
    }

    // Relasi ke model History (untuk menyatakan riwayat artikel)
    public function histories()
    {
        return $this->hasMany(History::class, 'ts_id', 'ts_id');
    }

}
