<?php

/**
 * @package   yii2-password
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015
 * @version   1.5.3
 */

namespace kartik\password;

/**
 * Asset bundle for PasswordInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class PasswordInputAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath('@vendor/kartik-v/strength-meter');
        $this->setupAssets('css', ['css/strength-meter']);
        $this->setupAssets('js', ['js/strength-meter']);
        parent::init();
    }
}