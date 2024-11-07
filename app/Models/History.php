<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $primaryKey = 'history_id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'article_id', 'video_id', 'ts_id' ,'if_id','tk_id' , 'viewed_at'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model TeknikSipil
    public function teknik_sipils()
    {
        return $this->belongsTo(TeknikSipil::class, 'ts_id');
    }

        // Relasi ke model TeknikComputer
        public function teknik_computers()
        {
            return $this->belongsTo(TeknikComputer::class, 'tk_id');
        }

    // Di dalam model History
public function article()
{
    return $this->belongsTo(Article::class, 'article_id');
}

public function video()
{
    return $this->belongsTo(Video::class, 'video_id');
}

public function informatics()
{
    return $this->belongsTo(Informatica::class, 'if_id');
}

}
