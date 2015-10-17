<?php
/**
 * Created by PhpStorm.
 * User: guoxiaotian
 * Date: 15/9/17
 * Time: 下午11:59
 */
$this->title = "注册用户管理";
?>
<div class="userRol">
    <span style="font-size: 20px">用户角色：</span>
    <select id="select" onchange="changeRol()">
        <option value="{3404ED17-10BB-411A-BFC0-78BF0407C1F4}">注册用户</option>
        <option value="{1278CC8E-DAE3-4065-970D-A0A661994D05}">数据录入人员</option>
        <option value="{AAED6BBE-1DB4-4BF0-B53B-E45F235734D2}">administrator</option>
    </select>
</div>
<div id="userData" style="width: 100%;height:350px"></div>
<script>
    var userData = <?=$userData?>;
    $('#userData').datagrid({
        title: '注册用户管理',
        iconCls: 'icon-save',
        fitColumns: true,
        striped: true,
        singleSelect: true,
        columns: [[
            {field: 'UserName', title: '用户名', width: 50},
            {field: 'Email', title: '邮箱', width: 100},
            {field: 'CreateDate', title: '注册时间', width: 100},
            {field: 'LastLoginDate', title: '最后登陆时间', width: 100},
            {field: 'LastLockoutDate', title: '最近一次有效时间', width: 100},
            {field: 'RoleName', title: '角色', width: 100},
//            {
//                field: 'opt', title: '操作', width: 50, align: 'center',
//                formatter: function (value, rec) {
//                    var btn = "<a class='' href='javascript:;' onclick='show()'>查看</a>";
//                    return btn;
//                }
//            }
        ]],
        data: userData,
        pagination: true
    });
    (function ($) {
        function pagerFilter(data) {
            if ($.isArray(data)) {    // is array
                data = {
                    total: data.length,
                    rows: data
                }
            }
            var dg = $(this);
            var state = dg.data('datagrid');
            var opts = dg.datagrid('options');
            if (!state.allRows) {
                state.allRows = (data.rows);
            }
            var start = (opts.pageNumber - 1) * parseInt(opts.pageSize);
            var end = start + parseInt(opts.pageSize);
            data.rows = $.extend(true, [], state.allRows.slice(start, end));
            return data;
        }

        var loadDataMethod = $.fn.datagrid.methods.loadData;
        $.extend($.fn.datagrid.methods, {
            clientPaging: function (jq) {
                return jq.each(function () {
                    var dg = $(this);
                    var state = dg.data('datagrid');
                    var opts = state.options;
                    opts.loadFilter = pagerFilter;
                    var onBeforeLoad = opts.onBeforeLoad;
                    opts.onBeforeLoad = function (param) {
                        state.allRows = null;
                        return onBeforeLoad.call(this, param);
                    }
                    dg.datagrid('getPager').pagination({
                        onSelectPage: function (pageNum, pageSize) {
                            opts.pageNumber = pageNum;
                            opts.pageSize = pageSize;
                            $(this).pagination('refresh', {
                                pageNumber: pageNum,
                                pageSize: pageSize
                            });
                            dg.datagrid('loadData', state.allRows);
                        }
                    });
                    $(this).datagrid('loadData', state.data);
                    if (opts.url) {
                        $(this).datagrid('reload');
                    }
                });
            },
            loadData: function (jq, data) {
                jq.each(function () {
                    $(this).data('datagrid').allRows = null;
                });
                return loadDataMethod.call($.fn.datagrid.methods, jq, data);
            },
            getAllRows: function (jq) {
                return jq.data('datagrid').allRows;
            }
        })
    })(jQuery);
    $('#userData').datagrid('clientPaging');
    var changeRol = function () {
        $('#userData').datagrid('loadData', {total: 0, rows: []});//清空下方DateGrid

        var roleId = $("#select").val();
        $.get('?r=admin/regbyid&RoleID=' + roleId, function (result) {
            var userData = JSON.parse(result);
            userData = JSON.parse(userData.data);
            for(var i =0;i<userData.length;i++) {
                $('#userData').datagrid('insertRow', {
                    index: i,
                    row: userData[i]
                })
            }
        });
        $('#userData').datagrid('clientPaging');
    }
</script>

