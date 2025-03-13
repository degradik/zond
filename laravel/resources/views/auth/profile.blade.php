@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h1 class="mb-3 text-primary">Профиль пользователя</h1>

            <div class="mb-3">
                <p><strong>Имя:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>
        </div>

        <div class="card shadow-sm mt-4 p-4">
            <h2 class="mb-3 text-success">Мои аренды</h2>

            @if($rentals->isEmpty())
                <p class="text-muted">У вас пока нет аренд.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Зонт</th>
                                <th>Время аренды</th>
                                <th>Стоимость</th>
                                <th>Статус</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                                <tr>
                                    <td>{{ $rental->id }}</td>
                                    <td>Зонт №{{ $rental->umbrella->id ?? 'Неизвестно' }}</td>
                                    <td>{{ $rental->date_start }} -- {{ $rental->date_end ?? '—' }}</td>

                                    <td>{{ $rental->total_cost}}</td>
                                    <td>
                                        @if ($rental->status === 'active')
                                            <span class="badge bg-success">Активна</span>
                                        @else
                                            <span class="badge bg-secondary">Завершена</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($rental->status === 'active')
                                            <div class="d-flex flex-column">
                                                <select id="station-{{ $rental->id }}" class="form-select mb-2">
                                                    <option value="">Выберите станцию</option>
                                                    @foreach ($stations as $station)
                                                        <option value="{{ $station->id }}">Станция #{{ $station->id }}</option>
                                                    @endforeach
                                                </select>
                                                <button onclick="completeRental({{ $rental->id }})" class="btn btn-danger btn-sm">Сдать</button>
                                            </div>
                                        @else
                                            <span class="text-muted">Завершена</span>
                                        @endif
                                    </td>                                                                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script>
        function completeRental(rentalId) {
            let stationId = document.getElementById(`station-${rentalId}`).value;
            
            if (!stationId) {
                alert("Выберите станцию перед сдачей зонта!");
                return;
            }
    
            console.log(`Отправляем запрос: rentalId=${rentalId}, stationId=${stationId}`);
    
            fetch(`/rentals/${rentalId}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    station_id: stationId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Ответ от сервера:", data);
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
