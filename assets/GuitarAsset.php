<?php

namespace app\assets;



use yii\web\AssetBundle;

class GuitarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css', // Новый файл стилей
    ];
    public $js = [
        // JavaScript файлы если нужны
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
