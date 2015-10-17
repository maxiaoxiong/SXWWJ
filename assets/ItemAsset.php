<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ItemAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/jeasyui/themes/icon.css',
//        'assets/jeasyui/themes/default/easyui.css',
        'assets/jeasyui/themes/metro/easyui.css',
        'css/style.css'
    ];
    public $js = [
        'assets/jeasyui/jquery.min.js',
        'assets/jeasyui/jquery.easyui.min.js',
        'assets/jeasyui/locale/easyui-lang-zh_CN.js',
//        'assets/amazeui/dist/js/amazeui.min.js',
        'http://api.map.baidu.com/api?v=1.5&ak=cMLcf84b298PghXgCvvTap2h',
        'js/item.js'
    ];
    public $depends = [
    ];
}
