@extends('layouts.app')

@section('content')

<!-- Основная обёртка -->
<div class="container-fluid px-0"> <!-- Изменено на container-fluid -->

    <!-- Карта с адаптивной высотой -->
    <div id="map" class="map-container-enhanced"></div>

    <!-- Модальное окно -->
    <div id="modal" class="modal-overlay">
        <div class="modal-content enhanced-modal">
            <h3 class="modal-title"><strong>Адрес:</strong> <span id="station-address"></span></h3>
            <p class="modal-text"><strong>Описание:</strong> <span id="station-description"></span></p>
            <p id="available-umbrellas" class="modal-text"></p>

            <div id="umbrellas-list" class="umbrellas-container"></div>

            <button type="button" onclick="$('#modal').hide();" 
                    class="btn btn-secondary mt-3 w-100">
                Закрыть
            </button>
        </div>
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
        $('#station-address').text(stationAddress || 'Адрес не указан');
        $('#station-description').text(stationDescription || 'Описание не указано');
        $('#available-umbrellas').text('Загрузка свободных зонтов...');

        $('#umbrellas-list').html('');

        // Загружаем зонты (пример)
        $.getJSON(`/stations/${stationId}/available-umbrellas-list`, function (umbrellas) {
            if (umbrellas.length === 0) {
                $('#available-umbrellas').text('Свободных зонтов нет.');
                return;
            }

            $('#available-umbrellas').text(`Свободных зонтов: ${umbrellas.length}`);

            umbrellas.forEach(umbrella => {
                $('#umbrellas-list').append(`
                    <button class="btn-primary" onclick="rentUmbrella(${umbrella.id})">
                        Арендовать зонт №${umbrella.id}
                    </button>
                `);
            });
        });

        $('#modal').css('display', 'flex');
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
