<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/15
 * Time: 上午12:10
 */
$this->title = '文物数据库';
?>
<style>

</style>
<div class="item-head">
    <div class="item-welcome">
        欢迎 <?php echo $_SESSION['username'] ?> 登陆系统! <a href="#" onclick="dele()">[ 注销 ]</a>
    </div>
    <img src="image/index_top.gif" alt="文物数据库" style="width: 100%;height: auto;"/>
</div>
<div class="easyui-layout" style="width: 100%;height:1050px;">
    <div region="west" split="true" title="数据浏览" style="width:37%;padding-left: 10px;padding-right: 10px">
        <div id="itemData" class="itemTable" style="width: 100%;height:340px"></div>
        <br/>

        <div class="am-form">
            <div class="am-form-group">
                <label for="Select1">地市选择</label>
                <select id="Select1" name="SelectCity" onchange="getBoundary2();">
                    <option value="#FFFFFF">山西省</option>
                    <option value="#00ff00">大同市</option>
                    <option value="#ff5500">太原市</option>
                    <option value="#3300FF">忻州市</option>
                    <option value="#CC00FF">朔州市</option>
                    <option value="#CC3300">临汾市</option>
                    <option value="#3300FF">晋中市</option>
                    <option value="#00ff00">晋城市</option>
                    <option value="#3300FF">运城市</option>
                    <option value="#335500">阳泉市</option>
                    <option value="#CC00FF">长治市</option>
                    <option value="#00ff00">吕梁市</option>
                </select>
                <span class="am-form-caret"></span>
            </div>
        </div>
        <div id="map" style="width: 500px;height: 550px;"></div>
    </div>
    <div region="center" title="详情">
        <div id="detail-header">
            <h2>系统 &nbsp;&nbsp;ID: <span id="sysid"></span></h2>

            <h2>项目编号: <span id="ItemNO"></span></h2>

            <h2>项目名称: <span id="ItemName"></span></h2>

            <h2>位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;置: <span id="ItemPosition"></span></h2>
        </div>

        <div class="easyui-tabs" style="width:100%;height:1000px;margin-top: 10px">
            <div title="本体" style="padding:10px">
                <div class="easyui-tabs" data-options="fit:true,plain:true">
                    <div title="简况" id="Item_Info" style="padding:10px;"></div>
                    <div title="照片" id="Item_Photos" style="padding:10px;"></div>
                    <div title="图纸" id="Item_Graphy" style="padding:10px;"></div>
                    <div title="其他" id="Item_Other" style="padding:10px;"></div>
                </div>

            </div>
            <div title="环境" style="padding:10px">
                <div class="easyui-tabs" data-options="fit:true,plain:true">
                    <div title="自然环境" id="Env_Nature" style="padding:10px;"></div>
                    <div title="历史环境" id="Env_His" style="padding:10px;"></div>
                    <div title="周边环境" id="Env_Sur" style="padding:10px;"></div>
                    <div title="民俗民风" id="Env_Native" style="padding:10px;"></div>
                </div>
            </div>
            <div title="研究" style="padding:10px">
                <div class="easyui-tabs" data-options="fit:true,plain:true">
                    <div title="史料" id="Res_His" style="padding:10px;"></div>
                    <div title="成果" id="Res_Achi" style="padding:10px;"></div>
                    <div title="保护" id="Res_Protect" style="padding:10px;"></div>
                    <div title="利用" id="Res_Exp" style="padding:10px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="item-foot">
    <img src="image/index_bottum.gif" alt="太原理工大学" style="width: 100%;height: auto;"/>
</div>
<script>
    var data = <?= $ItemData;?>;
    var Position = <?= $PositionData; ?>;
    function dele() {
        $.post('./index.php?r=admin/logout', function (data) {
            if (data.status == 'success') {
                $.messager.alert("失败", "未注销");
            } else {
                $.messager.alert("成功", "已注销");
                location.href = "index.php?r=site/index";
            }
        })
    }
</script>
