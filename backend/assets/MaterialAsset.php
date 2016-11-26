<?php
namespace backend\assets;

use yii\base\Exception;
use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class MaterialAsset extends AssetBundle
{
    public $sourcePath = '@vendor/mervick/material-design-icons';
    public $css = [
        'css/material-icons.css',
    ];
    public $js = [
        
    ];
    public $depends = [
    ];


}
