<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $categories array */

$this->title = 'Музыкальный магазин';

// Регистрируем CSS файлы
$this->registerCssFile('@web/css/site.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>

<div class="container mt-5">
    <!-- Поиск и корзина -->
    <div class="row mb-2">
        <div class="col-12">
            <div class="header-buttons">
                <?= Html::a('<i class="fas fa-plus"></i> Добавить товар', ['guitarsait/create'], [
                    'class' => 'btn btn-success'
                ]) ?>
                <?= Html::a('<i class="fas fa-star"></i> Новинка', ['guitarsait/new'], [
                    'class' => 'btn btn-warning'
                ]) ?>
                <?= Html::a('<i class="fas fa-shopping-cart"></i> Корзина', ['guitarsait/korzina'], [
                    'class' => 'btn btn-primary'
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="get" class="d-flex gap-2 search-form">
                <input type="hidden" name="r" value="guitarsait/search">
                <?= Html::textInput('query', '', [
                    'class' => 'form-control',
                    'placeholder' => 'Поиск товаров...'
                ]) ?>
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
            </form>
        </div>
    </div>

    <!-- Баннер -->
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Добро пожаловать в музыкальный магазин</h1>
            <p class="col-md-8 fs-4">Найдите идеальные инструменты для вашего творчества</p>
        </div>
    </div>

    <h2 class="mb-4">Категории товаров</h2>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        <?php foreach ($categories as $category): ?>
            <div class="col">
                <div class="card h-100">
                    <?= Html::img('@web/' . $category['image'], [
                        'class' => 'card-img-top',
                        'alt' => $category['title']
                    ]) ?>
                    <div class="card-body">
                        <h3 class="card-title h5"><?= Html::encode($category['title']) ?></h3>
                        <?= Html::a('Перейти в категорию', ['guitarsait/category', 'category' => $category['params']['category']], [
                            'class' => 'btn btn-primary'
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Преимущества -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Быстрая доставка</h3>
                    <p class="card-text">По всей России</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-medal fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Гарантия качества</h3>
                    <p class="card-text">Только оригинальные товары</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3 text-primary"></i>
                    <h3 class="h5">Поддержка 24/7</h3>
                    <p class="card-text">Всегда на связи</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Контакты -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title h5">Свяжитесь с нами</h3>
                    <p class="card-text">
                        <i class="fas fa-phone"></i> +7 (999) 999-99-99<br>
                        <i class="fas fa-envelope"></i> info@example.com<br>
                        <i class="fas fa-map-marker-alt"></i> ул. Пушкина, д. 10
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title h5">Время работы</h3>
                    <p class="card-text">
                        Пн-Пт: 10:00 - 20:00<br>
                        Сб-Вс: 11:00 - 18:00
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>