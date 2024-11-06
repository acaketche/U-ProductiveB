<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodies';
    protected $primaryKey = 'id_id';

    // Karena kita menggunakan create_at dan modified_at custom
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
        'prodi_id',
        'title',
        'user_id',
        'category_id',
        'file_pdf',
        'thumbnail'
    ];

    // Enum untuk prodi_id
    public const PRODI_INFORMATIKA = 'Informatika';
    public const PRODI_TEKNIK_SIPIL = 'Teknik Sipil';
    public const PRODI_TEKNIK_KOMPUTER = 'Teknik Komputer';

    // Validasi enum prodi_id
    public static function getProdiOptions()
    {
        return [
            self::PRODI_INFORMATIKA,
            self::PRODI_TEKNIK_SIPIL,
            self::PRODI_TEKNIK_KOMPUTER
        ];
    }

    // Relasi ke user jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke category jika diperlukan
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
