<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Связь с аккаунтом (один пользователь может иметь один аккаунт)
    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
