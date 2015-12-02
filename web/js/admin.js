/**
 * Created by xiongzai on 15-9-15.
 */
$(function(){
    var treeData = [{
        id: 1,
        text: "项目管理",
        children: [{
            id: 2,
            text: "项目编辑",
            attributes: {
                url: "./index.php?r=admin/item"
            }
        }, {
            id: 2,
            text: "增加项目",
            attributes: {
                url: "./index.php?r=admin/add"
            }
        }]
    }, {
        id: 1,
        text: "用户管理",
        children: [{
            id: 2,
            text: "注册用户管理",
            attributes: {
                url: "./index.php?r=admin/reg"
            }
        }, {
            id: 2,
            text: "新增用户",
            attributes: {
                url: "./index.php?r=admin/adduser"
            }
        }]
    }, {
        id: 1,
        text: "系统设置",
        children: [{
            id: 2,
            text: "数据库设置",
            attributes: {
                url: ""
            }
        }, {
            id: 2,
            text: "修改密码",
            attributes: {
                url: ""
            }
        }]
    }
    ];

    $('#tt').tree({
        data: treeData,
        onClick: function (node) {
            if (node.id == 2) {
                var content = "<iframe frameborder='0' scrolling='auto' style='width:100%;height:100%' src="
                    + node.attributes.url + "></iframe>";
                if ($("#content").tabs('exists', node.text)) {   //若选项卡已存在，选择该选项卡
                    $("#content").tabs('select', node.text);
                } else {
                    $('#content').tabs('add', {
                        title: node.text,
                        content: content,
                        closable: true,
                        tools: [{
                            iconCls: 'icon-mini-refresh',
                            handler: function () {
                                alert('refresh');
                            }
                        }]
                    });
                }
            }

        }
    });

    var content = "<iframe frameborder='0' scrolling='auto' style='width:100%;height:100%' src='./index.php?r=admin/item'></iframe>";
    $('#content').tabs('add', {
        title: "项目编辑",
        content: content,
        closable: true,
        tools: [{
            iconCls: 'icon-mini-refresh',
            handler: function () {
                alert('refresh');
            }
        }]
    });
})
