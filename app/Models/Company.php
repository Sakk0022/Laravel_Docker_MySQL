<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'account_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}


    // Связь с аккаунтом
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Отношение с сервисами API
    public function apiServices()
    {
        return $this->belongsToMany(ApiService::class, 'company_api_service', 'company_id', 'api_service_id');
    }

    // Отношение с типами токенов
    public function tokenTypes()
    {
        return $this->belongsToMany(TokenType::class, 'company_token_type', 'company_id', 'token_type_id');
    }
}

