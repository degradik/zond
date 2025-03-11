<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Umbrella;

use Illuminate\Support\Facades\Log;


class RentalController extends Controller
{

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не авторизованы!'
            ], 401);
        }
    
        $request->validate([
            'umbrella_id' => 'required|exists:umbrellas,id',
        ]);
    
        $rental = Rental::create([
            'user_id' => auth()->id(),  // 👈 ТУТ ДОЛЖЕН БЫТЬ `user_id`
            'umbrella_id' => $request->umbrella_id,
            'date_start' => now()->toDateTimeString(), 
            'status' => 'active',
        ]);
    
        Umbrella::where('id', $request->umbrella_id)
            ->update(['status' => 'rented']);
    
        return response()->json([
            'success' => true,
            'message' => 'Аренда успешно оформлена!',
            'rental' => $rental
        ]);
    }

    public function complete(Request $request, Rental $rental)
    {
        // Проверяем, что это аренда текущего пользователя
        if ($rental->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете завершить эту аренду.'
            ], 403);
        }

        // Завершаем аренду
        $rental->update([
            'date_end' => now()->toDateTimeString(), 

            'status' => 'completed',
        ]);

        // Освобождаем зонт
        $rental->umbrella->update(['status' => 'available']);

        return response()->json([
            'success' => true,
            'message' => 'Аренда завершена!',
            'rental' => $rental
        ]);
    }

        
}
