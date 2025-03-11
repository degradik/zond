@extends('layouts.app')

@section('content')
<div class="callBack page-grid position-relative d-flex flex-wrap px-5 pt-5 col-12">
    <div class="col-12">
        <h2 class="sub_title text-center">Обратная связь</h2>
        <div class="col-12">
            <h3 class="text-primary small_sub_title">Оператор (ИИ) отвечает в течение 2 минут  </h3>
        </div>
        </div>

        <form class="col-6 position-absolute top-50 start-50 translate-middle mt-5" action="">
        @csrf
        <div class="form-floating mb-3 col-12">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Чтото</label>
        </div>
        <div class="form-floating mb-5 col-12">
            <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Имя пользователя">
            <label for="floatingInputGroup1">Имя пользователя</label>
        </div>
        
        <div class="form-floating mb-3 col-12">
            <textarea class="form-control" placeholder="Оставьте комментарий здесь" id="floatingTextarea2" style="height: 200px"></textarea>
            <label for="floatingTextarea2">Комментарии</label>
        </div>
        <div class="col-12">
            <div class="d-flex flex-lg-row align-items-md-stretch align-items-center justify-content-md-start gap-3 mb-4">
            <button class="btn col-12 btn-lg p-3 mt-5 text-white bg-primary btn-blue-neon d-flex align-items-center justify-content-start fw-semibold">Отправить 
                
            </button>
            </div>
        </div>
    </form>
</div>
@endsection