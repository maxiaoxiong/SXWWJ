<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/18
 * Time: 下午5:12
 */

$this->title = "增加用户";

?>
<div class="easyui-panel" style="width:100%;height: 600px">
    <div style="padding:10px 60px 20px 60px">
        <form id="ff" method="post">
            <table cellpadding="5">
                <tr>
                    <td>用户名:</td>
                    <td><input class="easyui-textbox" id="username" type="text" name="name" data-options="required:true"/></td>
                </tr>
                <tr>
                    <td>密码:</td>
                    <td><input class="easyui-textbox" id="password" type="password" name="email" data-options="required:true"/>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input class="easyui-textbox" id="email" type="text" name="subject" data-options="required:true,validType:'email'"/></td>
                </tr>
                <tr>
                    <td>角色规则:</td>
                    <td>
                        <select  id="role">
                            <option value="{3404ED17-10BB-411A-BFC0-78BF0407C1F4}">注册用户</option>
                            <option value="{1278CC8E-DAE3-4065-970D-A0A661994D05}">数据录入人员</option>
                            <option value="{AAED6BBE-1DB4-4BF0-B53B-E45F235734D2}">administrator</option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <div style="text-align:left;padding:5px;margin-top: 40px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">Submit</a>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        var username = $("#username").val();
        var password = $("#password").val();
        var role = $("#role").val();
        $.post('?r=admin/addnewuser', {
                user: username,
                pass: password,
                roleId: role
            },
            function (res) {
                res = JSON.parse(res);
                if(res.status == 'success'){
                    addsucc();
                }else{
                    adderr();
                }
            }
        )
    }
    function addsucc(){
        $.messager.alert('成功','添加用户成功');
    }
    function adderr(){
        $.messager.alert('失败','注册失败：用户名已经存在','error');
    }
</script>