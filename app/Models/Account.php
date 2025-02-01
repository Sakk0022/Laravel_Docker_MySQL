<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id']; // Добавлен company_id

    // Связь с компанией
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class); // Один аккаунт принадлежит одному пользователю
    }
}
