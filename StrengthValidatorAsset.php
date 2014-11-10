<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-password
 * @version 1.3.0
 */

namespace kartik\password;

/**
 * Asset bundle for StrengthValidator
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StrengthValidatorAsset extends \kartik\base\AssetBundle
{

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('js', ['js/strength-validation']);
        parent::init();
    }

}