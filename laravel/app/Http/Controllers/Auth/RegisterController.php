<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Валидация данных
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Создание пользователя
        $user = User::create([
            'full_name' => $request->full_name, // Исправлено: используем $request->full_name
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Авторизация пользователя
        auth()->login($user);

        // Перенаправление на страницу профиля
        return redirect()->route('profile');
    }
}