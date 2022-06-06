<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    public $user;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthday',
        'address',
        'phonenumber',
        'google_id',
        'admin',
        'gender',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Custom class
    // protected $dispatchesEvents = [
    //     'created' => UserCreated::class,
    // ];

    // Closures
    // public static function boot()
    // {
    //     parent::boot();
    //     static::created(function ($user) {
    //         dd('From boot', $user);
    //     });
    // }
}
