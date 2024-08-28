<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id'; // Ensure this matches the actual primary key in your users table
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed', // Ensure this matches your hashing method
    ];

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Relasi ke artikel yang dibuat oleh user.
     */
    public function articles()
    {
       return $this->hasMany(Article::class, 'user_id', 'user_id');
     }

    // /**
    //  * Relasi ke video yang dibuat oleh user.
    //  */
    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id', 'user_id');
    }
    // /**
    //  * Relasi ke komentar yang dibuat oleh user.
    //  */
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // /**
    //  * Relasi ke favorit user.
    //  */
    // public function favorites()
    // {
    //     return $this->hasMany(Favorite::class);
    // }

    // /**
    //  * Relasi ke log yang dibuat oleh user.
    //  */
    // public function logs()
    // {
    //     return $this->hasMany(Log::class);
    // }

    // /**
    //  * Relasi ke notifikasi user.
    //  */
    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class);
    // }

    // /**
    //  * Relasi ke post forum yang dibuat oleh user.
    //  */
    // public function forumPosts()
    // {
    //     return $this->hasMany(ForumPost::class);
    // }

    /**
     * Set the user's password, hashing it if needed.
     *
     * @param string $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
