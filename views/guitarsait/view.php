<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;

// Регистрируем CSS для уведомления
$this->registerCss("
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transform: translateX(150%);
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
    }
    .notification.show {
        transform: translateX(0);
    }
    .notification.error {
        background-color: #dc3545;
    }
");

// Регистрируем JavaScript для обработки добавления в корзину
$this->registerJs("
    // Эта функция уже определена в main.php, здесь не нужно дублировать
    // Код для кнопки добавления в корзину уже есть в атрибуте onclick
");
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['home']) ?></li>
            <li class="breadcrumb-item"><?= Html::a(ucfirst($model->category), ['category', 'category' => $model->category]) ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($model->name) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <?php if (!empty($model->image) && file_exists(Yii::getAlias('@webroot/uploads/' . $model->image))): ?>
                        <img src="<?= Url::to('@web/uploads/' . $model->image) ?>" 
                             alt="<?= Html::encode($model->name) ?>" 
                             class="img-fluid" 
                             style="max-height: 400px; object-fit: contain;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center text-center"
                             style="height: 400px; background-color: #f8f9fa; color: #6c757d; border-radius: 0.25rem;">
                            <div>
                                <i class="fas fa-image fa-5x mb-3"></i>
                                <div class="h5">Изображение отсутствует</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-4"><?= Html::encode($model->name) ?></h1>
                    
                    <div class="price-block mb-4">
                        <h2 class="text-primary mb-0">
                            <span style="font-size: 2rem;"><?= number_format($model->price, 0, '.', ' ') ?></span>
                            <span style="font-size: 1.5rem;">₽</span>
                        </h2>
                    </div>

                    <?php if ($model->description): ?>
                        <div class="description mb-4">
                            <h5>Описание</h5>
                            <p class="card-text"><?= Html::encode($model->description) ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="action-buttons">
                        <?= Html::a('Добавить в корзину', 
                            'javascript:void(0);', 
                            [
                                'class' => 'btn btn-success btn-lg mb-2 w-100',
                                'id' => 'add-to-cart-btn',
                                'onclick' => "addToCart('" . Url::to(['add-to-cart', 'id' => $model->id]) . "')",
                                'data-id' => $model->id
                            ]
                        ) ?>
                        <?= Html::a('Вернуться к категории', 
                            ['category', 'category' => $model->category], 
                            ['class' => 'btn btn-secondary w-100']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 