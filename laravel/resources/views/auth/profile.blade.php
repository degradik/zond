@extends('layouts.app')

@section('content')
    <h1>Профиль пользователя: {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Выйти</button>
    </form>
    <div class="rental_list">
        <h2>Мои аренды</h2>

        @if($rentals->isEmpty())
            <p>У вас пока нет аренд.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Зонт</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>Зонт №{{ $rental->umbrella->id ?? 'Неизвестно' }}</td>
                            <td>{{ $rental->date_start }}</td>
                            <td>{{ $rental->date_end ?? '—' }}</td>
                            <td>
                                @if ($rental->status === 'active')
                                    <span class="badge bg-success">Активна</span>
                                @else
                                    <span class="badge bg-secondary">Завершена</span>
                                @endif
                            </td>
                            <td>
                                @if ($rental->status === 'active')
                                    <button onclick="completeRental({{ $rental->id }})" class="btn btn-danger">Сдать</button>
                                @else
                                    <span class="badge bg-secondary">Завершена</span>
                                @endif
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function completeRental(rentalId) {
            fetch(`/rentals/${rentalId}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Обновляем страницу
                } else {
                    alert('Ошибка: ' + data.message);
                }
            })
            .catch(error => console.error('Ошибка:', error));
        }
    </script>
@endsection
