/**
 * Created by guoxiaotian on 15/9/11.
 */
function login() {
    $('#loginModal').window({
        width:400,
        title:'登录',
        maximizable:false,
        minimizable:false,
        collapsible:false,
        modal:true
    });
    $('#loginModal').window('open');
}
function closeLoginModal(){
    $('#loginModal').window('close');
}
function closeRegModal(){
    $('#regModal').window('close');
}

function reg(){
    $('#loginModal').window('close');
    $('#regModal').window({
        width:400,
        title:'注册新用户',
        maximizable:false,
        minimizable:false,
        collapsible:false,
        modal:true
    });
    $('#regModal').window('open');
}
