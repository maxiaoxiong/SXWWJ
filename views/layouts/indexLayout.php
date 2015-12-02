<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/11
 * Time: 下午11:45
 */

use app\assets\IndexAsset;
use yii\helpers\Html;
IndexAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title)?></title>
    <?php $this->head();?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>