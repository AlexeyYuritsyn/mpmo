<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetSite extends AssetBundle
{


    public $css = [
        'css/main-site.css',
        'https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,900&display=swap',
    ];
    public $js = [
        ['js/main-site.js', 'type'=>'module'],
    ];
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
