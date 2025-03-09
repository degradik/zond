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
    ];

    public function station(){
        return $this->belongsTo(Station::class);
    }
}
