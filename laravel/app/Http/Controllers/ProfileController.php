<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rental;

class ProfileController extends Controller
{
    public function index()
    {
        $rentals = Rental::where('user_id', auth()->id())->with('umbrella')->latest()->get();
        $user = auth()->user();
    
        return view('auth.profile', compact('user', 'rentals'));
    }
    
}
