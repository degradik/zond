<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'umbrella_id',
        "status",
        "date_start",
        "date_end",
        "total_cost",
        "status",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function umbrella(){
        return $this->belongsTo(Umbrella::class);
    }

    #подсчет цены
    protected static function booted()
    {
        static::saving(function ($rental) {
            if ($rental->date_start && $rental->date_end) {
                $rental->total_cost = $rental->calculatePrice();
            }
        });
    }
    
    public function calculatePrice(): float
    {
        $start = Carbon::parse($this->date_start);
        $end = Carbon::parse($this->date_end);
        $minutes = $end->diffInMinutes($start);
        
        // Фиксированная цена за 10 минут
        $pricePerInterval = 50;
        $intervalMinutes = 10;
    
        return ceil($minutes / $intervalMinutes) * $pricePerInterval;
    }
    
}
