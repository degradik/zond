<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Station;

class Umbrella extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "station_id", // ✅ Добавляем возможность обновлять station_id!
    ];

    public function station(){
        return $this->belongsTo(Station::class);
    }
}
