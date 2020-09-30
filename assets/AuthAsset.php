<?php

namespace ravesoft\auth\assets;

use yii\web\AssetBundle;

/**
 * AuthAsset is an asset bundle for [[ravesoft\auth\widgets\AuthChoice]] widget.
 */
class AuthAsset extends AssetBundle
{
    public $sourcePath = '@vendor/rudderrave/yii2-rave-auth/assets/source';
    public $css = [
        'authstyle.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
