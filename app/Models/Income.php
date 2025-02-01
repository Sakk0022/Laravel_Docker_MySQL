<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public function scopeFresh($query)
    {
        return $query->where('date', '>=', now()->subDays(7)); // Данные за последнюю неделю
    }
}
