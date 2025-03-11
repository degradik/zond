<?php

// app/Http/Controllers/MapController.php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Umbrella;
use Illuminate\Http\Request;



class MapController extends Controller
{
    public function getStations()
    {
        $stations = Station::with('address')->get(); // Загружаем станции с адресами
        return response()->json($stations);
    }
    public function getAvailableUmbrellasList($stationId)
    {
        $umbrellas = Umbrella::where('station_id', $stationId)
            ->where('status', 'available')
            ->get();
    
        return response()->json($umbrellas);
    }

    public function home()
    {
        $umbrellas = Umbrella::where('status', 'available')->get(); // например, все доступные зонты
        return view('home', compact('umbrellas'));
    }

}