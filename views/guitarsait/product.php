<?php
/** @var yii\web\View $this */
/** @var app\models\ProductForm $model */

use yii\helpers\Html;

$this->title = 'Продукт';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
    <h1>Ваш товар</h1>
    <div class="product-view">
        <?php if ($model->image_path): ?>
            <img src="<?= Yii::getAlias('@web/uploads/' . $model->image_path) ?>" alt="<?= Html::encode($model->name) ?>" style="max-width: 100%; height: auto;">
        <?php else: ?>
            <p>Изображение отсутствует</p>
        <?php endif; ?>
        <h2><?= Html::encode($model->name) ?></h2>
        <p><?= Html::encode($model->description) ?></p>
        <p>Цена: <?= Html::encode($model->price) ?> руб.</p>
    </div>
</body>
</html>
