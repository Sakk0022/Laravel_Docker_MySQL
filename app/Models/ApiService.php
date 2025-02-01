<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiService extends Model
{
    use HasFactory;

    public $timestamps = true; 

    protected $fillable = ['name', 'account_id'];

    // Отношение с компаниями
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_api_service', 'api_service_id', 'company_id');
    }
}
