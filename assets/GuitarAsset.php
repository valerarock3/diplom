<?php

namespace app\assets;



use yii\web\AssetBundle;

class GuitarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/styles.css',
        'css/home.css'
    ];
    public $js = [
        // Добавьте JS файлы, если необходимо
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
