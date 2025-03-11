<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
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
                    <?php if ($model->image): ?>
                        <img src="<?= Url::to('@web/uploads/' . $model->image) ?>" 
                             alt="<?= Html::encode($model->name) ?>" 
                             class="img-fluid" 
                             style="max-height: 400px; object-fit: contain;">
                    <?php else: ?>
                        <img src="<?= Url::to('@web/images/no-image.jpg') ?>" 
                             alt="Изображение отсутствует" 
                             class="img-fluid" 
                             style="max-height: 400px; object-fit: contain;">
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
                            ['add-to-cart', 'id' => $model->id], 
                            ['class' => 'btn btn-success btn-lg mb-2 w-100']
                        ) ?>
                        <?= Html::a('Вернуться к категории', 
                            ['category', 'category' => $model->category], 
                            ['class' => 'btn btn-outline-secondary w-100']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 