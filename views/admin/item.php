<?php

$this->title = "项目管理";

?>
<script src='lib/kindeditor/kindeditor.js'></script>
<script src='lib/kindeditor/lang/zh_CN.js'></script>
<table id="dg" style="width:auto;height:auto">
    <thead>
    <tr>
        <th data-options="field:'ID',width:100,align:'center'">项目id</th>
        <th data-options="field:'Item_NO',width:150,align:'center'">项目编号</th>
        <th data-options="field:'Item_Name',width:150,align:'center'">项目名称</th>
        <th data-options="field:'Item_Position',width:200,align:'center'">项目位置</th>
        <th data-options="field:'Item_Edit',width:150,align:'center'">操作</th>
    </tr>
    </thead>
</table>

<div id="win" class="easyui-window" title="项目编辑" style="width:600px;height:400px"
     data-options="iconCls:'icon-save',modal:false">
    <form id="gg" method="post" style="background-color: white"
          action="<?php echo \Yii::$app->request->baseUrl ?>/index.php?r=admin/update">
        <input type="hidden" name="ID" id="ID">
        <table style="width: 100%;border-bottom: 1px solid #000">
            <tr>
                <td style="width: 25%;font-size: 20px"><label for="Item_NO">项目编号:</label></td>
                <td><input class="easyui-validatebox" id="Item_NO" type="text" name="Item_NO" data-options="required:true"/>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;font-size: 20px"><label for="Item_Name">项目名称:</label></td>
                <td><input class="easyui-validatebox" id="Item_Name" type="text" name="Item_Name"
                           data-options="validType:'ture'"/></td>
            </tr>
            <tr>
                <td style="width: 25%;font-size: 20px"><label for="Item_Position">项目地理位置:</label></td>
                <td><input class="easyui-validatebox" id="Item_Position" type="text" name="Item_Position"
                           data-options="validType:'ture'"/>&nbsp;&nbsp;
                </td>
                <td><input type="hidden" id="Lng" name="Lng"></td>
                <td><input type="hidden" id="Lat" name="Lat"></td>

            </tr>
        </table>
        <div id="box">
            <div class="easyui-tabs" style="width:100%;height:auto;">
                <div title="本体" style="width:100%;padding:10px;">
                    <h2>本体-简况</h2>
                    <textarea id="Item_Info" style="width:100%;height:200px;visibility:hidden;" name="Item_Info"></textarea>

                    <h2>本体-照片</h2>
            <textarea id="Item_Photos" style="width:100%;height:200px;visibility:hidden;"
                      name="Item_Photos'"></textarea>

                    <h2>本体-图纸</h2>
                <textarea id="Item_Graphy" style="width:100%;height:200px;visibility:hidden;"
                          name="Item_Graphy"></textarea>

                    <h2>本体-其他</h2>
                <textarea id="Item_Other" style="width:100%;height:200px;visibility:hidden;"
                          name="Item_Other"></textarea>
                </div>
                <div title="环境" style="width:100%;padding:10px;">
                    <h2>环境-自然环境</h2>
                <textarea id="Env_Nature" style="width:100%;height:200px;visibility:hidden;"
                          name="Env_Nature"></textarea>

                    <h2>环境-历史环境</h2>
                    <textarea id="Env_His" style="width:100%;height:200px;visibility:hidden;" name="Env_His"></textarea>

                    <h2>环境-周边建筑</h2>
                    <textarea id="Env_Sur" style="width:100%;height:200px;visibility:hidden;" name="Env_Sur"></textarea>

                    <h2>环境-民俗民风</h2>
                <textarea id="Env_Native" style="width:100%;height:200px;visibility:hidden;"
                          name="Env_Native"></textarea>
                </div>
                <div title="研究" style="width:100%;padding:10px;">
                    <h2>研究-史料</h2>
                    <textarea id="Res_His" style="width:100%;height:200px;visibility:hidden;" name="Res_His"></textarea>

                    <h2>研究-成果</h2>
                    <textarea id="Res_Achi" style="width:100%;height:200px;visibility:hidden;" name="Res_Achi"></textarea>

                    <h2>研究-保护</h2>
                <textarea id="Res_Protect" style="width:100%;height:200px;visibility:hidden;"
                          name="Res_Protect"></textarea>

                    <h2>研究-利用</h2>
                    <textarea id="Res_Exp" style="width:100%;height:200px;visibility:hidden;" name="Res_Exp"></textarea>
                </div>
            </div>
        </div>
        <input type="button" onclick="update()" value="更新"/>
    </form>
</div>
<script>
    var itemdata = <?= $ItemData;?>;
    $(function(){
        $('#win').window('close');
        var dg = $('#dg').datagrid({
            singleSelect: true,
            data: itemdata,
            filterBtnIconCls: 'icon-filter',
            pagination: true,
            pageSize: 10,
            fitColumns: true,
        });
        dg.datagrid('enableFilter');
    });

    $('#Item_Position').blur(function () {
        var map = new BMap.Map("allmap");
        //var city = document.getElementById("").value;

        var localSearch = new BMap.LocalSearch(map);
        localSearch.enableAutoViewport(); //允许自动调节窗体大小

        var keyword = document.getElementById("Item_Position").value;
        localSearch.setSearchCompleteCallback(function (searchResult) {
            var poi = searchResult.getPoi(0);
            document.getElementById("Lng").value = poi.point.lng;
            document.getElementById("Lat").value = poi.point.lat;
            console.log(poi.point.lng + ':' + poi.point.lat);
        });
        localSearch.search(keyword);
    });


    function edit(value) {
        $.getJSON('./index.php?r=admin/edit&id=' + value.name, function (data) {
            $('#gg').form('load', {
                ID: data.ID,
                Item_NO: data.Item_NO,
                Item_Name: data.Item_Name,
                Item_Position: data.Item_Position,
            });	// 读取表单的URL
            setTimeout(function() {
                var map = new BMap.Map("allmap");
                //var city = document.getElementById("").value;

                var localSearch = new BMap.LocalSearch(map);
                localSearch.enableAutoViewport(); //允许自动调节窗体大小

                var keyword = document.getElementById("Item_Position").value;
                localSearch.setSearchCompleteCallback(function (searchResult) {
                    var poi = searchResult.getPoi(0);
                    document.getElementById("Lng").value = poi.point.lng;
                    document.getElementById("Lat").value = poi.point.lat;
                });
                localSearch.search(keyword);
            },2000);
            editor1.html(data.Item_Info);
            editor2.html(data.Item_Photos);
            editor3.html(data.Item_Graphy);
            editor4.html(data.Item_Other);
            editor5.html(data.Env_Nature);
            editor6.html(data.Env_His);
            editor7.html(data.Env_Sur);
            editor8.html(data.Env_Native);
            editor9.html(data.Res_His);
            editor10.html(data.Res_Achi);
            editor11.html(data.Res_Protect);
            editor12.html(data.Res_Exp);

        });
        $('#win').window('open');
    }

    function dele(value){
        $.getJSON('./index.php?r=admin/delete&id=' + value.name,function(data){
            console.log(data);
            if(data.status == 'success'){
                $.messager.alert("成功","删除数据成功,刷新页面中..");
                setTimeout(function () {
                    history.go(0);
                })
            }else{
                $.messager.alert("失败","删除数据失败");
            }
        })
    }

    function update() {
        $.post('./index.php?r=admin/update', {
                ID:$("#ID").val(),
                Item_NO: $("#Item_NO").val(),
                Item_Name: $("#Item_Name").val(),
                Item_Position: $("#Item_Position").val(),
                Lng:$("#Lng").val(),
                Lat:$("#Lat").val(),
                Item_Info: KindEditor.instances[0].html(),
                Item_Photos: KindEditor.instances[1].html(),
                Item_Graphy: KindEditor.instances[2].html(),
                Item_Other: KindEditor.instances[3].html(),
                Env_Nature: KindEditor.instances[4].html(),
                Env_His: KindEditor.instances[5].html(),
                Env_Sur: KindEditor.instances[6].html(),
                Env_Native: KindEditor.instances[7].html(),
                Res_His: KindEditor.instances[8].html(),
                Res_Achi: KindEditor.instances[9].html(),
                Res_Protect: KindEditor.instances[10].html(),
                Res_Exp: KindEditor.instances[11].html(),
            },
            function (data) {
                console.log(data);
                var dataJson = JSON.parse(data);
                if (dataJson.status == 'success') {
                    $.messager.alert('成功', '更新信息成功');
                } else if (data.error) {
                    $("#error").window('close');
                }
            })
    }


    function theLocation() {
        var map = new BMap.Map("allmap");
        //var city = document.getElementById("").value;

        var localSearch = new BMap.LocalSearch(map);
        localSearch.enableAutoViewport(); //允许自动调节窗体大小

        var keyword = document.getElementById("Item_Position").value;
        localSearch.setSearchCompleteCallback(function (searchResult) {
            var poi = searchResult.getPoi(0);
            document.getElementById("Lng").value = poi.point.lng;
            document.getElementById("Lat").value = poi.point.lat;
            $("#Lng").val(poi.point.lng);
            $("#Lat").val(poi.point.lat);
//            console.log(poi.point.lng + ':' + poi.point.lat);
        });
        localSearch.search(keyword);
    }

    KindEditor.ready(function(K) {
        window.editor1 = K.create('#Item_Info',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor2 = K.create('#Item_Photos',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor3 = K.create('#Item_Graphy',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor4 = K.create('#Item_Other',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor5 = K.create('#Env_Nature',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor6 = K.create('#Env_His',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor7 = K.create('#Env_Sur',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor8 = K.create('#Env_Native',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor9 = K.create('#Res_His',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor10 = K.create('#Res_Achi',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor11 = K.create('#Res_Protect',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });
    KindEditor.ready(function(K) {
        window.editor12 = K.create('#Res_Exp',{
            resizeType : 1,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|',  'image', 'link'],
        });
    });







</script>