@extends('layouts.app')

@section('content')
<!-- Секция FAQ -->
<div class="container faq-section">
    <h2 class="sub_title text-center">Ответы на вопросы (FAQ)</h2>
    <div class="accordion py-5" id="faqAccordion">
      <!-- Вопрос 1 -->
        <div class="faq-item">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    Как восстановить пароль?
                    </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                    Перейдите на страницу входа и нажмите "Забыли пароль?". Введите ваш email, и мы отправим инструкции по восстановлению.
                    </div>
                </div>
            </div>
        </div>

        <!-- Вопрос 2 -->
        <div class="faq-item">
            <div class="accordion-item">
            <h3 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                Как изменить email в профиле?
                </button>
            </h3>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Перейдите в раздел "Профиль" и нажмите "Редактировать". Введите новый email и сохраните изменения.
                </div>
            </div>
            </div>
        </div>

        <!-- Вопрос 3 -->
        <div class="faq-item">
            <div class="accordion-item">
            <h3 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                Как связаться с поддержкой?
                </button>
            </h3>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Вы можете написать нам через форму выше или отправить email на support@example.com.
                </div>
            </div>
            </div>
        </div>

      <!-- Вопрос 4 -->
        <div class="faq-item">
            <div class="accordion-item">
            <h3 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                Какие способы оплаты вы поддерживаете?
                </button>
            </h3>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Мы поддерживаем оплату банковскими картами (Visa, MasterCard), PayPal и криптовалютой.
                </div>
            </div>
        </div>    
    </div>

</div>

@endsection