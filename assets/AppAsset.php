<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap4\BootstrapAsset;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800",
        "https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800",
        "https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900",
        "css/bootstrap.min.css",
        "css/plugins.css",
        "style.css",
        "css/custom.css"
    ];
    public $js = [
        "js/vendor/modernizr-3.5.0.min.js",
//        "js/vendor/jquery-3.2.1.min.js",
        "js/popper.min.js",
        "js/bootstrap.min.js",
        "js/plugins.js",
        "js/active.js"
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];

}