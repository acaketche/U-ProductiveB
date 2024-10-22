<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Imagick;

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
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Relasi ke thumbnail
    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'teknik_sipil_id', 'ts_id');
    }

    // Metode untuk menghasilkan thumbnail dari PDF
    public function generateThumbnail($pdfPath)
    {
        // Tentukan path thumbnail
        $thumbnailPath = 'thumbnails/' . basename($pdfPath, '.pdf') . '.jpg';

        // Periksa apakah thumbnail sudah ada
        if (!Storage::exists($thumbnailPath)) {
            // Membuat thumbnail dari PDF menggunakan Imagick
            try {
                $imagick = new Imagick();
                $imagick->setResolution(300, 300); // Resolusi untuk thumbnail
                $imagick->readImage($pdfPath . '[0]'); // Ambil halaman pertama
                $imagick->setImageFormat('jpg');
                $imagick->thumbnailImage(300, 0); // Mengubah ukuran thumbnail
                $imagick->writeImage(storage_path('app/' . $thumbnailPath));
                $imagick->clear();
                $imagick->destroy();
            } catch (\Exception $e) {
                // Menangani kesalahan jika terjadi
                return null;
            }
        }

        return $thumbnailPath;
    }
}
