<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetShowForm extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
        'css/main-show-form.css',
        'css/util-show-form.css',
    ];
    public $js = [
//        'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js',
        'form_editor/js/jquery-ui.min.js',
        'form_editor/js/form-builder.min.js',
        'form_editor/js/form-render.min.js',
//        'http://formbuilder.online/assets/js/form-builder.min.js',
//        'http://formbuilder.online/assets/js/form-render.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
