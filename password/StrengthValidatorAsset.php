<?php

namespace kartik\password;

use yii\web\AssetBundle;

/**
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class StrengthValidatorAsset extends AssetBundle {

    public $sourcePath = '@vendor/kartik-v/yii2-password/kartik/assets';
    public $js = [
        'js/strength-validation.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
