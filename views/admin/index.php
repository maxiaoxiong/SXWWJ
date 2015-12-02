<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 15-9-16
 * Time: 下午2:40
 */
use app\assets\AdminAsset;
AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <img src="<?php echo \Yii::$app->request->baseUrl ?>/image/index_top.gif" alt="">
</header>

<section>
    <div id="cc" class="easyui-layout" style="width: 100%;height: 500px">
        <div data-options="region:'west',title:'导航目录',split:true" style="width:200px;">

            <ul id="tt" class="easyui-tree" data-options="animate:'true'">

            </ul>
        </div>
        <div id="content" class="easyui-tabs" data-options="region:'center'" style="padding:5px;background:#eee;">

        </div>
    </div>
</section>

<footer>
    <img src="<?php echo \Yii::$app->request->baseUrl ?>/image/index_bottum.gif" alt="">
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
