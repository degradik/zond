<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rental;
use App\Models\Station;



class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rentals = Rental::where('user_id', $user->id)->with('umbrella')->latest()->get();
        $stations = Station::all(); // ✅ Получаем список станций
    
        return view('auth.profile', compact('user', 'rentals', 'stations'));
    }
}
