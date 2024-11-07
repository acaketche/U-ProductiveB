<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class TeknikComputer extends Model
{
    use HasFactory;

    protected $table = 'teknik_computers';
    protected $primaryKey = 'tk_id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'file_pdf',
        'category_id',
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

}
