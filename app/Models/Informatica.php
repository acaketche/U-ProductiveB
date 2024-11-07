<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informatica extends Model
{
    protected $table = 'informatics'; // Nama tabel di database
    protected $primaryKey = 'if_id'; // Primary key dari tabel

    public $timestamps = false; // Nonaktifkan timestamps jika kolom tidak ada

    protected $fillable = [
        'title',
        'file_pdf',
        'category_id',
        'user_id',
    ];

    // Relasi ke model Category (jika ada)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Sesuaikan 'id' dengan primary key pada tabel users
    }

    // Relasi ke model History (untuk menyatakan riwayat artikel)
    public function histories()
    {
        return $this->hasMany(History::class, 'if_id', 'if_id');
    }

}
