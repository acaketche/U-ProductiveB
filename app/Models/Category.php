<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasFactory;

    protected $primaryKey = 'category_id';
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'category_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id', 'category_id');
    }
}
