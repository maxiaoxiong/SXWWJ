/**
 * Created by guoxiaotian on 15/9/15.
 */
$('#itemData').datagrid({
    title: '数据库列表',
    iconCls: 'icon-save',
    fitColumns: true,
    striped: true,
    singleSelect: true,
    columns: [[
        {field: 'Item_NO', title: '项目编号', width: 50},
        {field: 'ID', hidden: true, title: 'ID', width: 100},
        {field: 'Item_Name', title: '名称', width: 100},
        {field: 'Item_Position', title: '位置', width: 100},
        {
            field: 'opt', title: '操作', width: 50, align: 'center',
            formatter: function (value, rec) {
                var btn = "<a class='' href='javascript:;' onclick='show()'>查看</a>";
                return btn;
            }
        }
    ]],
    data: data,
    pagination: true
});

(function($){
    function pagerFilter(data){
        if ($.isArray(data)){    // is array
            data = {
                total: data.length,
                rows: data
            }
        }
        var dg = $(this);
        var state = dg.data('datagrid');
        var opts = dg.datagrid('options');
        if (!state.allRows){
            state.allRows = (data.rows);
        }
        var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
        var end = start + parseInt(opts.pageSize);
        data.rows = $.extend(true,[],state.allRows.slice(start, end));
        return data;
    }

    var loadDataMethod = $.fn.datagrid.methods.loadData;
    $.extend($.fn.datagrid.methods, {
        clientPaging: function(jq){
            return jq.each(function(){
                var dg = $(this);
                var state = dg.data('datagrid');
                var opts = state.options;
                opts.loadFilter = pagerFilter;
                var onBeforeLoad = opts.onBeforeLoad;
                opts.onBeforeLoad = function(param){
                    state.allRows = null;
                    return onBeforeLoad.call(this, param);
                }
                dg.datagrid('getPager').pagination({
                    onSelectPage:function(pageNum, pageSize){
                        opts.pageNumber = pageNum;
                        opts.pageSize = pageSize;
                        $(this).pagination('refresh',{
                            pageNumber:pageNum,
                            pageSize:pageSize
                        });
                        dg.datagrid('loadData',state.allRows);
                    }
                });
                $(this).datagrid('loadData', state.data);
                if (opts.url){
                    $(this).datagrid('reload');
                }
            });
        },
        loadData: function(jq, data){
            jq.each(function(){
                $(this).data('datagrid').allRows = null;
            });
            return loadDataMethod.call($.fn.datagrid.methods, jq, data);
        },
        getAllRows: function(jq){
            return jq.data('datagrid').allRows;
        }
    })
})(jQuery);

$(function(){
    $('#itemData').datagrid('clientPaging');
    $.get("?r=item/item&act=GBI&ItemID=5-257-63", function (res) {
        setDetail(res);
    })
});


function show() {
    var selected = $('#itemData').datagrid('getSelected');
    if (selected) {
        getPosition(selected.Item_NO, function (result) {
            console.log(JSON.parse(result));
        });
        getItemByItemNO(selected.Item_NO,function(result2){
            setDetail(result2)
        })
    }
}
var getPosition = function (id, callback) {
    $.get("?r=item/position&act=getById&ItemID=" + id, function (res) {
        callback(res)
    })
};
var getAllPosition = function (callback) {
    $.get("?r=item/position&act=getAll", function (res) {
        callback(res)
    })
};
$('#detail-header').panel({
    title:'项目详细信息'
});

var getItemByItemNO = function(id,callback){
    $.get("?r=item/item&act=GBI&ItemID="+id, function (res) {callback(res)})
};

var setDetail = function(res){
    var jsonObj = JSON.parse(res);
    var str = jsonObj.data[0];
    $("#sysid").html(str.ID);
    $("#ItemNO").html(str.Item_NO);
    $("#ItemName").html(str.Item_Name);
    $("#ItemPosition").html(str.Item_Position);
    $("#Item_Info").html(str.Item_Info);
    $("#Item_Photos").html(str.Item_Photos);
    $("#Item_Graphy").html(str.Item_Graphy);
    $("#Item_Other").html(str.Item_Other);
    $("#Env_Nature").html(str.Env_Nature);
    $("#Env_His").html(str.Env_His);
    $("#Env_Sur").html(str.Env_Sur);
    $("#Env_Native").html(str.Env_Native);
    $("#Res_His").html(str.Res_His);
    $("#Res_Achi").html(str.Res_Achi);
    $("#Res_Protect").html(str.Res_Protect);
    $("#Res_Exp").html(str.Res_Exp);

};
var PosArr = Position.data;

//    百度地图API功能
var map = new BMap.Map("map");    // 创建Map实例
map.centerAndZoom(new BMap.Point(112.554312, 37.830122), 8);  // 初始化地图,设置中心点坐标和地图级别
map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
map.addControl(new BMap.NavigationControl());
map.addControl(new BMap.ScaleControl());
map.addControl(new BMap.OverviewMapControl());
map.addControl(new BMap.MapTypeControl());
map.setCurrentCity("山西");          // 设置地图显示的城市 此项是必须设置的


var opts = {
    width: 100,     // 信息窗口宽度
    height: 100,     // 信息窗口高度
    title: "山西金代建筑三维数据库系统"  // 信息窗口标题
};

getBoundary();


function addMarker(point,name,ItemNO){
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);
    var label = new BMap.Label(name,{offset:new BMap.Size(20,-10)});
    marker.setLabel(label);
    var infoWindow = new BMap.InfoWindow("<br/>项目ID："+ItemNO+"<br/>"+"项目名称："+name+"<br/><br/><button>点击查看详情</button>", opts);
    marker.addEventListener("click", function(){
        map.openInfoWindow(infoWindow,point); //开启信息窗口
    });
}

for(var i = 0; i<PosArr.length;i++){
    var point = new BMap.Point(PosArr[i].Lng,PosArr[i].Lat);
    addMarker(point,PosArr[i].Item_Name,PosArr[i].ItemID);
}



function getBoundary(){
    var bdary = new BMap.Boundary();
    bdary.get("山西", function(rs){       //获取行政区域
        //map.clearOverlays();        //清除地图覆盖物
        var count = rs.boundaries.length; //行政区域的点有多少个
        if (count === 0) {
            alert('未能获取当前输入行政区域');
            return ;
        }
        var pointArray = [];
        for (var i = 0; i < count; i++) {
            var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 2, strokeColor: "#ff0000"}); //建立多边形覆盖物
            map.addOverlay(ply);  //添加覆盖物
            pointArray = pointArray.concat(ply.getPath());
        }
        map.setViewport(pointArray);    //调整视野
    });
}
function getBoundary2() {
    var bdary = new BMap.Boundary();
    var select1 = document.getElementById("Select1");
    var name = select1.options[select1.selectedIndex].text;
    var corlor = select1.value;
    bdary.get(name, function (rs) {       //获取行政区域
        map.clearOverlays();        //清除地图覆盖物
        var count = rs.boundaries.length; //行政区域的点有多少个
        for (var i = 0; i < count; i++) {
            var ply = new BMap.Polygon(rs.boundaries[i], { strokeWeight: 2, fillColor: corlor, strokeColor: "FF0000" }); //建立多边形覆盖物
            map.addOverlay(ply);  //添加覆盖物
            map.setViewport(ply.getPath());    //调整视野
            // alert(name);
        }
    });
}
