<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $categories array */

$this->title = 'Добавление товара';
?>

<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= Html::a('Главная', ['home']) ?></li>
            <li class="breadcrumb-item active" aria-current="page">Добавление товара</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-4"><?= Html::encode($this->title) ?></h1>

                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <?php foreach ((array)Yii::$app->session->getFlash('error') as $message): ?>
                            <?= Alert::widget([
                                'options' => ['class' => 'alert-danger'],
                                'body' => $message,
                            ]) ?>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <?= Alert::widget([
                            'options' => ['class' => 'alert-success'],
                            'body' => Yii::$app->session->getFlash('success'),
                        ]) ?>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'category')->dropDownList($categories, [
                        'prompt' => 'Выберите категорию...',
                        'onchange' => '
                            let selectedValue = $(this).val();
                            if (selectedValue) {
                                $("#product-name").attr("placeholder", "Введите название " + $(this).find("option:selected").text().toLowerCase());
                            } else {
                                $("#product-name").attr("placeholder", "");
                            }
                        '
                    ]) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'price')->textInput([
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '0',
                                'id' => 'min-price',
                                'onchange' => '
                                    let minPrice = parseFloat($(this).val());
                                    let maxPrice = parseFloat($("#max-price").val());
                                    if (maxPrice && minPrice > maxPrice) {
                                        $(this).val(maxPrice);
                                    }
                                '
                            ])->label('Минимальная цена') ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::textInput('max_price', '', [
                                'class' => 'form-control',
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '0',
                                'id' => 'max-price',
                                'placeholder' => 'Максимальная цена',
                                'onchange' => '
                                    let maxPrice = parseFloat($(this).val());
                                    let minPrice = parseFloat($("#min-price").val());
                                    if (minPrice && maxPrice < minPrice) {
                                        $(this).val(minPrice);
                                    }
                                '
                            ]) ?>
                        </div>
                    </div>

                    <div class="text-center mt-3 mb-4">
                        <?= Html::button('Фильтр', [
                            'class' => 'btn btn-primary',
                            'onclick' => '
                                let category = $("#product-category").val();
                                let minPrice = $("#min-price").val();
                                let maxPrice = $("#max-price").val();
                                // Здесь можно добавить логику фильтрации
                                console.log("Категория:", category);
                                console.log("Мин. цена:", minPrice);
                                console.log("Макс. цена:", maxPrice);
                            '
                        ]) ?>
                    </div>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'imageFile')->fileInput() ?>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('Добавить товар', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Отмена', ['home'], ['class' => 'btn btn-secondary ms-2']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div> 