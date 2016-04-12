<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>调查问卷后台管理系统</title>
  <meta name="description" content="这是一个 index 页面">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="../../assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="../../assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="../../assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="../../assets/css/admin.css">
 <link rel="stylesheet" href="../../assets/css/admin.css">
  <link rel="stylesheet" href="../../assets/css/js_demo.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<?php include 'header.php';?>
<div class="am-cf admin-main">
<?php include 'sidebar.php';?>
  <!-- content start -->
<!-- content start -->
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div style="text-align:center"><strong class="am-text-primary am-text-lg"></strong> </div>
    </div>
	<form action="/home_info/add_home_info" id="myform" method="post">
							<input type="hidden" value="<?php echo $id?>" name="id" id="id">
							<input type="hidden" value="" name="answer_list" id="answer_list">
							<table class="hd_del_ta  am-table-striped am-table-hover table-main" id="table1" align="center" border="0" cellpadding="0" cellspacing="1" width="97%">
								<tbody>
									<tr>
										<td class="hd_ta_t"style="background:#7cb5ec" colspan="2"><strong class="am-text-primary am-text-lg" style="color:white">户基本信息</span><input name="num" value="060001" type="hidden"></td>
									</tr>
								</tbody>
								<tbody><tr>
									<td>现在住户地址:</td>
									<td><input name="address" id="address" value=""></td>
								</tr>
								<tr>
									<td>经度:</td>
									<td><input name="lng" id="lng"  value=""><a href="javascript:getLngLat(2);">选择经纬度</a>
									</td>
								</tr>
								<tr>
									<td>纬度:</td>
									<td><input name="lat" id="lat"  value=""><a href="javascript:getLngLat(1);">选择经纬度</a></td>
								</tr>
								<?php foreach ($list as $item):?>
									<?php if($item['type'] == 1 || $item['type'] == 4){?>
									<tr><td><?php echo $item['question']?></td>
									<td><input name="<?php echo $item['number']?>" class="question" value="">
									</tr>
									<?php }else if($item['type'] == 2){?>
										<tr>
                                                                                <td><?php echo $item['question']?></td>
										<td><select name="<?php echo $item['id']?>" class="question">
											<?php foreach ($item['option_list'] as $option):?>
												<option value="<?php echo $option['number']?>"><?php echo $option['content']?></option>				
											<?php endforeach;?>
									<?php }else if($item['type'] == 3){?>


									<?php }?>
								<?php endforeach;?>
								
								
								
							</tbody></table>
							<button type="button" class="am-btn am-btn-primary am-btn-xs" style="margin-left:400px;margin-top:10px;margin-bottom:10px;" onclick="mysubmit();">提交保存</button>
						</form>

  </div>
  <!-- content end -->  
<!-- content end -->

</div>

<footer>
  <hr>
</footer>

<script src="../../assets/js/zDrag.js"></script>
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="../../assets/js/app.js"></script>
<script src="../../assets/js/common.js"></script>
<script src="../../assets/js/jquery-form.js"></script>
<script src="../../assets/js/zDialog.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=437a0558f1ae01520a7c0ba63fb69ed8"></script>
<script type="text/javascript">
function mysubmit(){
        var answer_list = "";
        $(".question").each(function(){
                var content = $(this).val();
                var num = $(this).attr("name");
                answer_list = answer_list + num +":" +content +";";
        });
        $("#answer_list").val(answer_list);
/*
	var address = $("#address").val();
	var lng = $("#lng").val();
	var lat = $("#lat").val();
	var id = $("#id").val();
	$.ajax({
                type: 'POST',
                url: "/survey_result/update_home_info",
                data: {id:id,answer_list:answer_list,lng:lng,lat:lat,address:address},
                dataType: 'json',
                success: function(result){
                        if(result['result'] ){
				alert("保存成功");
                        }
                },
                error: function(){
                        alert('Error loading PHP document');

                }
        });
*/
	$("#myform").submit();
}
 var diag;
        var type;
        function getLngLat(t) {
                 diag = new Dialog();
                type = t;
                diag = new Dialog();
                diag.Height = 1000;
                diag.Width = 800;
                diag.Title = "维度选取";
                diag.InnerHtml = "<br><input id='keyWord' style='width:300px;' />&nbsp;&nbsp;<a href='javascript:search()'>搜索</a><br><br><div style='height:800px;width:800px;' id = 'map'></div>";
                diag.show();
                init();
        }
        function search() {
                var value = $("#keyWord").val();
                mapObj.clearMap();
                mapObj.plugin([ "AMap.PlaceSearch" ], function() {
                        MSearch = new AMap.PlaceSearch({ //构造地点查询类  
                                pageSize : 10,
                                pageIndex : 1
                                //city : "" //城市  
                        });
                        AMap.event.addListener(MSearch, "complete", Search_CallBack);//返回地点查询结果  
                        MSearch.search(value); //关键字查询  
                });
        }
        function Search_CallBack(data) {
                var poiArr = data.poiList.pois;
                var resultCount = poiArr.length;
                for ( var i = 0; i < resultCount; i++) {
                        addmarker(i, poiArr[i]);
                }
                mapObj.setFitView();
        }
	function addmarker(i, d) {
                var lngX;
                var latY;
                if (d.location) {
                        lngX = d.location.getLng();
                        latY = d.location.getLat();
                } else {
                        lngX = d._location.getLng();
                        latY = d._location.getLat();
                }
                var markerOption = {
                        map : mapObj,
                        icon : "http://webapi.amap.com/images/" + (i + 1) + ".png",
                        position : new AMap.LngLat(lngX, latY)
                };
                var mar = new AMap.Marker(markerOption);
                AMap.event.addListener(mar, "click", getLngLat1);
        }
        
        var mapObj;
        function init() {
                mapObj = new AMap.Map("map");
                mapObj.plugin([ "AMap.ToolBar", "AMap.OverView", "AMap.Scale" ],
                                function() {
                                        toolbar = new AMap.ToolBar();
                                        toolbar.autoPosition = false; //加载工具条
                                        mapObj.addControl(toolbar);
                                        overview = new AMap.OverView(); //加载鹰眼
                                        mapObj.addControl(overview);
                                        scale = new AMap.Scale(); //加载比例尺
                                        mapObj.addControl(scale);
                                });
                AMap.event.addListener(mapObj,"dblclick",getLngLat1);
        }
	function getLngLat1(e) {
                if (confirm("确定使用此经纬度么?精度: " + e.lnglat.lng + " 维度:" + e.lnglat.lat)) {
                        if(type == 2){
                                $("#lng").val(e.lnglat.lng);
                                $("#lat").val(e.lnglat.lat);
                        }else{
                                $("input[name=faddress]").val(e.lnglat.lng+","+e.lnglat.lat);
                        }
                        diag.close();
                }
        }
        function getVal(obj) {
                var div = $(obj).parent();
                var checkBoxs = div.find("input[type=checkbox]");
                var val = "";
                var k = 0;
                for ( var i = 0; i < checkBoxs.length; i++) {
                        var box = checkBoxs[i];
                        if ($(box).is(":checked")) {
                                if (k == 0) {
                                        val += $(box).val();
                                } else {
                                        val += "," + $(box).val();
                                }
                                k++;
                        }
                }
                div.find("input[name=item_value]").val(val);
        }
</script>
</body>
</html>
