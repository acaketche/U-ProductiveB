<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Informatica extends Model
{
    protected $table = 'informatics'; // Nama tabel di database
    protected $primaryKey = 'if_id'; // Primary key dari tabel

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

    protected $fillable = [
        'title',
        'file_pdf',
        'thumbnail',
        'category_id',
    ];


    // Relasi ke model Category (jika ada)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

