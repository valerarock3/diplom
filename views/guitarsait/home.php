<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $categories array */

$this->title = 'Музыкальный магазин';

// Регистрируем CSS файлы
$this->registerCssFile('@web/css/site.css');
$this->registerCssFile('@web/css/style.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>

<div class="container mt-5">
    <!-- Приветственный блок -->
    <div class="text-center mb-5" style="margin-top: 70px;">
        <h1 class="display-4 fw-bold">Добро пожаловать в музыкальный магазин</h1>
        <p class="lead">Найдите идеальный инструмент для вашего творчества</p>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        <?php foreach ($categories as $category): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?= Url::to('@web/' . $category['image']) ?>" 
                         class="card-img-top" 
                         alt="<?= Html::encode($category['title']) ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="min-height: 48px;"><?= Html::encode($category['title']) ?></h5>
                        <?= Html::a('Перейти в категорию', 
                            ['/guitarsait/category', 'category' => $category['params']['category']], 
                            ['class' => 'btn btn-primary mt-auto']
                        ) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Преимущества магазина -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Наши преимущества</h2>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Быстрая доставка</h3>
                    <p>Доставляем товары по всей России. Сроки доставки от 1 до 7 дней.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-medal fa-3x mb-3 text-warning"></i>
                    <h3 class="h5">Гарантия качества</h3>
                    <p>Только оригинальные товары от проверенных производителей.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3 text-success"></i>
                    <h3 class="h5">Поддержка клиентов</h3>
                    <p>Наши специалисты готовы помочь вам с выбором 24/7.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Информация о магазине -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h4 mb-4">О нашем магазине</h3>
                    <p class="card-text">Music Store - ваш надежный партнер в мире музыкальных инструментов. Мы работаем с 2010 года и предлагаем широкий ассортимент гитар, аксессуаров и музыкального оборудования.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Более 1000 товаров в каталоге</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Официальный дилер ведущих брендов</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Профессиональная консультация</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Гарантия на все товары</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h4 mb-4">Контакты и время работы</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <strong>Адрес:</strong><br>
                            г. Москва, ул. Музыкальная, д. 10
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <strong>Телефон:</strong><br>
                            +7 (999) 123-45-67
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <strong>Email:</strong><br>
                            info@musicstore.ru
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <strong>Время работы:</strong><br>
                            Пн-Пт: 10:00 - 20:00<br>
                            Сб-Вс: 11:00 - 18:00
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>