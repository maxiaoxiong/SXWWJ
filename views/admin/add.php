<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 15-9-18
 * Time: 下午5:13
 */
$this->title = "项目添加";
?>
<script src='lib/kindeditor/kindeditor.js'></script>
<script src='lib/kindeditor/lang/zh_CN.js'></script>

<form id="ff" method="post" style="background-color: white"
      action="<?php echo \Yii::$app->request->baseUrl ?>/index.php?r=admin/add">
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
    <input type="button" onclick="add()" value="添加"/>
</form>

<script>
    function add() {
        $.post('./index.php?r=admin/add', {
                Item_NO: $("#Item_NO").val(),
                Item_Name: $("#Item_Name").val(),
                Item_Position: $("#Item_Position").val(),
                Lng:$("#Lng").val(),
                Lat:$("#Lat").val(),
                Item_Info: $("#Item_Info").val(),
                Item_Photos: $("#Item_Photos").val(),
                Item_Graphy: $("#Item_Graphy").val(),
                Item_Other: $("#Item_Other").val(),
                Env_Nature: $("#Env_Nature").val(),
                Env_His: $("#Env_His").val(),
                Env_Sur: $("#Env_Sur").val(),
                Env_Native: $("#Env_Native").val(),
                Res_His: $("#Res_His").val(),
                Res_Achi: $("#Res_Achi").val(),
                Res_Protect: $("#Res_Protect").val(),
                Res_Exp: $("#Res_Exp").val()
            },
            function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    $.messager.alert('成功', '添加信息成功');
                } else if (data.error) {
                    $.messager.alert('失败', '添加信息成功');
                }
            })
    }

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
//            console.log(poi.point.lng + ':' + poi.point.lat);
        });
        localSearch.search(keyword);
    });

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
        });
        localSearch.search(keyword);
    }

    KindEditor.ready(function (K) {
        window.editor1 = K.create('#Item_Info', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor2 = K.create('#Item_Photos', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor3 = K.create('#Item_Graphy', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor4 = K.create('#Item_Other', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor5 = K.create('#Env_Nature', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor6 = K.create('#Env_His', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor7 = K.create('#Env_Sur', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor8 = K.create('#Env_Native', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor9 = K.create('#Res_His', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor10 = K.create('#Res_Achi', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor11 = K.create('#Res_Protect', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
    KindEditor.ready(function (K) {
        window.editor12 = K.create('#Res_Exp', {
            allowFileManager: true,
            items: [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'image', 'link'],
            afterChange: function () {
                this.sync();//这个是必须的,如果你要覆盖afterChange事件的话,请记得最好把这句加上.
            }
        });
    });
</script>


