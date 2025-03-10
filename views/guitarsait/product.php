<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $models app\models\Product[] */
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>товар</title>
    <link rel="stylesheet" href="rew.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="products-grid">
        <?php foreach ($models as $model): ?>
            <div class="product-item">
                <h2><?= Html::encode($model->name) ?></h2>
                
                <div class="product-image">
                    <?php if ($model->image): ?>
                        <?= Html::img('@web/uploads/' . $model->image, [
                            'alt' => $model->name,
                            'class' => 'product-image'
                        ]) ?>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <div class="price">
                        Цена: <?= number_format($model->price, 2, '.', ' ') ?> ₽
                    </div>
                    <div class="category">
                        Категория: <?= Html::encode($model->category) ?>
                    </div>
                    <?= Html::a('Подробнее', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    $this->registerCss("
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        
        .product-item {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        .product-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        
        .product-info {
            margin-top: 15px;
        }
        
        .price {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .category {
            color: #666;
            margin-bottom: 10px;
        }
    ");
    ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>