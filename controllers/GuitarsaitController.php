<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\ProductForm;
use yii\web\NotFoundHttpException;


class GuitarsaitController extends Controller{


    //  домашняя страница
    public function actionHome()
    {
        return $this->render('home');
    }

    // корзина
    public function actionKorzina()
    {
        return $this->render('korzina');
    }
    // отзывы
    public function actionReviews()
    {
        return $this->render('reviews');
    }
    // вызов страницы с товарами
    // public function actionView($id)
    // {
    //     $model = ProductForm::findOne($id);
    //     if ($model === null) {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }

    //     return $this->render('product', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionProduct(){

    return $this->render('product');

    
    }

}