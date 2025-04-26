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
                        <div class="col-md-12">
                            <?= $form->field(
                                $model, 'price'
                            )->textInput([
                                'type' => 'number',
                                'step' => '0.01',
                                'min' => '0',
                                'placeholder' => 'Цена'
                            ])->label('Цена') ?>
                        </div>
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