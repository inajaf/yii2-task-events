<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatepickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/datepicker/css/bootstrap-datepicker.min.css',
    ];
    public $js = [
        'js/datepicker/js/bootstrap-datepicker.min.js',
        'js/datepicker/js/init.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
