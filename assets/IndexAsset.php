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
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/amazeui/dist/css/amazeui.min.css',
        'assets/jeasyui/themes/icon.css',
//        'assets/jeasyui/themes/default/easyui.css',
        'assets/jeasyui/themes/metro/easyui.css',
        'css/style.css',
    ];
    public $js = [
        'assets/jeasyui/jquery.min.js',
        'assets/jeasyui/jquery.easyui.min.js',
        'assets/amazeui/dist/js/amazeui.min.js',
        'js/index.js'
    ];
    public $depends = [
    ];
}
