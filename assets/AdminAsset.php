<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 15-9-15
 * Time: 下午11:31
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'assets/jeasyui/themes/metro/easyui.css',
        'assets/jeasyui/themes/icon.css',
        'css/admin.css'
    ];
    public $js = [
        'assets/jeasyui/jquery.min.js',
        'assets/jeasyui/jquery.easyui.min.js',
        'assets/jeasyui/locale/easyui-lang-zh_CN.js',
        'http://api.map.baidu.com/api?v=2.0&ak=OCkKj3VPvSCFI3UTzDY5n4DX',
        'js/datagrid-filter.js',
        'js/admin.js'
    ];
    public $depends = [
    ];
}