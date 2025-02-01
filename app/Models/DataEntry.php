<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEntry extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'date', 'data'];

    public $timestamps = false;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

