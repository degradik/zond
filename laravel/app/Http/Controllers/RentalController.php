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
        if ($rental->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Вы не можете завершить эту аренду.'
            ], 403);
        }
    
        $request->validate([
            'station_id' => 'required|exists:stations,id'
        ]);
        
        // Завершаем аренду
        $rental->update([
            'date_end' => now()->toDateTimeString(),
            'status' => 'completed',
        ]);
    
        // Обновляем зонт: освобождаем и меняем станцию
        $umbrella = $rental->umbrella;
        if ($umbrella) {
            $umbrella->update([
                'status' => 'available',
                'station_id' => $request->station_id // ✅ Теперь обновляем станцию у зонта
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Аренда завершена! Зонт возвращён на станцию.',
            'rental' => $rental
        ]);
    }

    public function returnRental(Request $request, $rentalId)
    {
        $rental = Rental::where('id', $rentalId)
                        ->where('user_id', auth()->id())
                        ->where('status', 'active')
                        ->first();

        if (!$rental) {
            return response()->json([
                'success' => false,
                'message' => 'Активная аренда не найдена'
            ], 404);
        }

        $request->validate([
            'station_id' => 'required|exists:stations,id'
        ]);

        $stationId = $request->station_id;

        // Завершаем аренду
        $rental->update([
            'date_end' => now()->toDateTimeString(),
            'status' => 'completed'
        ]);

        // Возвращаем зонт на станцию
        $umbrella = Umbrella::find($rental->umbrella_id);

        if (!$umbrella) {
            return response()->json([
                'success' => false,
                'message' => 'Зонт не найден'
            ], 404);
        }

        $umbrella->update([
            'station_id' => $stationId,
            'status' => 'available'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Зонт успешно возвращён'
        ]);
    }


    public function getActiveRentals()
    {
        $rentals = Rental::where('user_id', auth()->id())
                        ->where('status', 'active')
                        ->with('umbrella') // чтобы сразу подтянуть зонты
                        ->get();
    
        return response()->json($rentals);
    }
    

        
}
