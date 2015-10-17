<?php $this->title = '山西地区现存宋金建筑三维信息数据库' ?>
<div class="am-container">
    <div class="header">
        <div class="welcome">
            <a href="javascript:;" onclick="login()">[ 登录 ]</a>
            <a href="javascript:;" onclick="reg()">[ 注册 ]</a>
        </div>
    </div>
    <div class="main">
        <img src="image/index_main.gif" alt=""/>
    </div>
    <div class="index-menu">
        <a href="">
            <img src="image/rc.png" alt="请登录后查看具体详细内容"/>
        </a>
    </div>
    <div class="footer">
        <img src="image/index_bottum.gif" alt=""/>
    </div>

    <div id="loginModal" class="easyui-window" closed="true">
        <form class="am-form" style="padding:10px 20px 10px 20px;" method="post">

            <div class="am-form-group">
                <label for="username">用户名</label>
                <input type="text" class="" id="username" placeholder="输入用户名">
            </div>

            <div class="am-form-group">
                <label for="password">密码</label>
                <input type="password" class="" id="password" placeholder="输入密码">
            </div>
            <div class="am-form-group">
                <label class="am-checkbox-inline">
                    <input type="checkbox" value="option1"> 保持登录状态
                </label>
                <label style="margin-left: 90px;color: #0052A3" onclick="reg()"
                       class="am-checkbox-inline">注册未注册用户 </label>
            </div>

            <div style="padding:5px;text-align:center;">
                <a href="#" class="easyui-linkbutton" icon="icon-ok" id="lo" onclick="userLogin()">Ok</a>
                <a href="javascript:;" onclick="closeLoginModal()" class="easyui-linkbutton"
                   icon="icon-cancel">Cancel</a>
            </div>
        </form>
    </div>

    <div id="regModal" closed="true" class="easyui-window" style="padding: 10px 10px 30px 10px;">
        <h2>创建新用户</h2>

        <p>使用以下表单创建新帐户。</p>

        <p>密码的长度至少必须为 6 个字符。</p>

        <form class="am-form" style="padding:10px 20px 10px 20px;" method="post">

            <div class="am-form-group">
                <label for="username">用户名 <span id="usererr" style="color: red"></span></label>
                <input type="text" class="" id="uname" placeholder="输入用户名">
            </div>
            <div class="am-form-group">
                <label for="doc-ipt-email-1">电子邮件</label>
                <input type="email" class="" id="email" placeholder="输入电子邮件">
            </div>
            <div class="am-form-group">
                <label for="password"> <span id="passerr" style="color: red"></span> 密码</label>
                <input type="password" class="" id="pword" placeholder="输入密码">
            </div>
            <div class="am-form-group am-form-error">
                <label for="password">确认密码</label>
                <input type="password" class="am-form-field" id="password2" placeholder="确认密码">
            </div>

            <div style="padding:5px;text-align:center;">
                <a href="#" class="easyui-linkbutton" icon="icon-ok" id="su" onclick="formSubmit()">创建用户</a>
                <a href="javascript:;" onclick="closeRegModal()" class="easyui-linkbutton"
                   icon="icon-cancel">取消</a>
            </div>
        </form>
    </div>


</div>
<script>
    function formSubmit() {
        $.post('?r=admin/addquser', {
            username: $('#uname').val(),
            email: $('#email').val(),
            password: $('#pword').val()
        },
            function (res) {
            res = JSON.parse(res);
            if (res.status == 'success') {
                addsucc();
            } else {
                adderr();
            }
        })
    }

    function userLogin()
    {
        $.post('?r=admin/userlogin', {
                username: $('#username').val(),
                password: $('#password').val()
            },
            function (res) {
                res = JSON.parse(res);
                if (res.status == 'success') {
                    addsucc1(0);
                } else if(res.status == 'success1') {
                    addsucc1(1);
                }else{
                    adderr1();
                }
            })
    }
    function addsucc() {
        $.messager.alert('成功', '添加用户成功');
        setTimeout(function () {
            location.href = "?r=item/index";
        },3000);
    }
    function addsucc1(n) {
        $.messager.alert('成功', '用户登录成功,正在跳转...');
        setTimeout(function () {
            if(n == 0){
                location.href = "?r=item/index";
            }else{
                location.href = "?r=admin/index";
            }
        },3000);
    }
    function adderr() {
        $.messager.alert('失败', '注册失败：用户名已经存在', 'error');
    }
    function adderr1() {
        $.messager.alert('失败', '登录失败：用户名或密码错误', 'error');
    }
</script>
