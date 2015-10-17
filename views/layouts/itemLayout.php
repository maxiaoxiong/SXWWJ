<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/15
 * Time: 上午8:15
 */

use app\assets\ItemAsset;
use yii\helpers\Html;

ItemAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();