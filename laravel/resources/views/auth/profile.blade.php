@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-section">
                <h2>Профиль пользователя</h2>
                <div class="text-center">
                    <img src="https://via.placeholder.com/150" alt="Аватар" class="img-fluid rounded-circle mb-3">
                </div>
                <p><strong>Имя:</strong> {{ $user->full_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Телефон:</strong> +7 (999) 123-45-67</p>
                <p><strong>Дата регистрации:</strong> 01.01.2023</p>
                <button class="btn btn-primary w-100">Редактировать профиль</button>
            </div>
        </div>

        <div class="col-md-8">
            <div class="rentals-section">
                <h2>Мои аренды</h2>
                @if($rentals->isEmpty())
                <p class="text-muted">У вас пока нет аренд.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            
                            <tbody>
                                @foreach ($rentals as $rental)
                                    <div class="list-group mt-2">
                                        <div class="list-group-item">
                                            <h5 class="py-2 px-0">Зонт №{{ $rental->umbrella->id ?? 'Неизвестно' }} <span class="fs-6 text-secondary">ID:{{ $rental->id }} </span></h5>
                                            <p><strong>Время Аренды:</strong> {{ $rental->date_start }} -- {{ $rental->date_end ?? '—' }}</p>
                                            <p><strong>Стоймость:</strong> {{ $rental->total_cost}}</p>
                                            <p>
                                                <strong>Статус:</strong>
                                                @if ($rental->status === 'active')
                                                    <span class="badge bg-success">Активна</span>
                                                @else
                                                    <span class="badge bg-secondary">Завершена</span>
                                                @endif
                                            </p>
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
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            
                    
            </div>
        </div>
    </div>
</div>


    {{-- <div class="container-fluid col-12 d-flex justify-content-center flex-wrap mt-4">
        <div class="card shadow-sm col-12 col-md-12 col-xxl-2 p-4">
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

        <div class="card col-12 col-md-12 col-xxl-8 shadow-sm p-4">
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
    </div> --}}

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
