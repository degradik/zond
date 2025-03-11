@extends('layouts.app')

@section('content')
    <h1>Профиль пользователя: {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
@endsection
