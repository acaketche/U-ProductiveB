<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    protected $primaryKey = 'prodi_id';

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // Relasi ke Category
    public function categories()
    {
        return $this->hasMany(Category::class, 'prodi_id', 'prodi_id');
    }
}
