<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    protected $fillable = ['name', 'prodi_id']; // Menambahkan prodi_id ke fillable

    // Relasi ke Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'prodi_id');
    }

    // Memperbaiki typo pada 'categori_id' menjadi 'category_id'
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'category_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id', 'category_id');
    }

    public function teknik_sipils()
    {
        return $this->hasMany(teknik_sipil::class, 'category_id', 'category_id');
    }

    public function informatics()
    {
        return $this->hasMany(Informatica::class, 'category_id', 'category_id');
    }
}
