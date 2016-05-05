<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/datepicker3.css',
        'css/styles.css',
        // 'css/site.css',
    ];
    public $js = [
        // 'js/jquery-1.11.1.min.js',
        // 'js/bootstrap.min.js',
        'js/lumino.glyphs.js',
        //'js/glyphs.co.js',
        // 'js/chart.min.js',
        // 'js/chart-data.js',
        // 'js/easypiechart.js',
        // 'js/easypiechart-data.js',
        // 'js/bootstrap-datepicker.js',
        // 'http://maps.googleapis.com/maps/api/js',
        // 'js/jquery-1.9.0.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
