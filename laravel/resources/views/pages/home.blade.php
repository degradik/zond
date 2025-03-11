@extends('layouts.app')

@section('content')

<button onclick="openModal(1, 'Тестовая станция', 'ул. Примерная, 1', 'Описание тестовой станции')">Тест</button>

<div class="light-blue" style="height: 1200px;">

    <div id="map" style="width: 100%; height: 500px;"></div>

    <div id="modal" style="display: none;">
        <h3><strong>Адрес:</strong> <span id="station-address"></span></h3>
        <p><strong>Описание:</strong> <span id="station-description"></span></p>
        <p id="available-umbrellas"></p>

        <div id="umbrellas-list"></div> <!-- Сюда выведем кнопки аренды зонтов -->

        <button type="button" onclick="$('#modal').hide();">Закрыть</button>
    </div>

</div>  

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=ВАШ_API_КЛЮЧ"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    ymaps.ready(init);
    
    function init() {
        var myMap = new ymaps.Map("map", {
            center: [47.228609, 39.715995],
            zoom: 10
        });

        // Загружаем станции через AJAX
        $.getJSON('/stations', function (stations) {
            stations.forEach(station => {
                let address = station.address;

                let placemark = new ymaps.Placemark(
                    [address.latitude, address.longitude],
                    {
                        balloonContent: `<strong>${station.name}</strong><br>${address.address}`,
                        hintContent: station.name
                    }
                );

                placemark.events.add('click', function (e) {
                    e.preventDefault();
                    openModal(station.id, station.name, address.address, address.description);
                });

                myMap.geoObjects.add(placemark);
            });
        });
    }

    // Функция открытия модального окна
    function openModal(stationId, stationName, stationAddress, stationDescription) {
        $('#station-name').text(stationName || "Название не указано");
        $('#station-address').text(stationAddress || "Адрес не указан");
        $('#station-description').text(stationDescription || "Описание не указано");

        // Сначала очистим список зонтов
        $('#umbrellas-list').html('');

        // Получаем доступные зонты по станции
        $.getJSON(`/stations/${stationId}/available-umbrellas-list`, function (umbrellas) {

            if (umbrellas.length === 0) {
                $('#available-umbrellas').text('Свободных зонтов нет.');
                return;
            }

            $('#available-umbrellas').text(`Свободных зонтов: ${umbrellas.length}`);

            // Для каждого зонта создаём кнопку аренды
            umbrellas.forEach(umbrella => {
                $('#umbrellas-list').append(`
                    <div style="margin-bottom: 10px;">
                        <p>Зонт №${umbrella.id}</p>
                        <button onclick="rentUmbrella(${umbrella.id})" class="btn btn-primary">Арендовать</button>
                    </div>
                `);
            });

            $('#modal').show();
        });
    }

    function rentUmbrella(umbrellaId) {
        fetch('{{ route('rentals.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },

            body: JSON.stringify({
                umbrella_id: umbrellaId
            })
        })


        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                $('#modal').hide();
                // TODO: Можно обновить карту или количество доступных зонтов на станции
            } else {
                alert('Ошибка при аренде');
            }
        });
    }
</script>

@endsection
