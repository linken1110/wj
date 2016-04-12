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
 <link rel="stylesheet" href="../../assets/css/screen.css">
<link rel="stylesheet" href="../../assets/css/editor.css">
<link rel="stylesheet" href="../../assets/css/jquery.gridly.css">
<link rel="stylesheet" href="../../assets/css/page_survey.css">
<link rel="stylesheet" href="../../assets/css/jMyCarousel.css">
</head>
<body class="g_wrapper page_survey g_survey">
<style type="text/css">
  .gridly {
    position: relative;
    width: 100%;
  }
  .brick.small {
    width: 100%;
    height: 140px;
  }
  .brick.large {
    width: 100%;
    height: 300px;
  }

.ui-jcoverflip {position: relative;}
.ui-jcoverflip--item {position: absolute; display: block;}
</style>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<?php include 'header.php';?>
<div class="am-cf admin-main">
<!-- content start -->
<!-- content start -->
  <div class="admin-content">
<div class="survey_options published" style="display: block;margin-top:20px;margin-bottom:-50px;margin-right:20px;float:right">
                 <a id="save_message" class="btn btn_middle btn_white"style="margin-right:300px;display: none;">保存成功</a>
		<a id="front_page" class="btn btn_middle btn_white" onclick="get_page(<?php echo $home_info['id']?>,<?php echo $id?>,1)">上一页</a>
		<a id="next_page" class="btn btn_middle btn_white" onclick="get_page(<?php echo $home_info['id']?>,<?php echo $id?>,2)">下一页</a>
		<?php if($home_info['status'] == 1){?>
		<a class="btn btn_middle btn_white"><i></i>已审核通过</a>
		<a onclick="change_result_status(<?php echo $home_info['id']?>,2)" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>审核不通过</a>
		<?php }else if($home_info['status'] == 2){?>
		<a class="btn btn_middle btn_white"><i></i>已审核不通过</a>
                <a onclick="change_result_status(<?php echo $home_info['id']?>,1)" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>审核通过</a>
		<?php }else{?>
		<a onclick="change_result_status(<?php echo $home_info['id']?>,1)" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>审核通过</a>
		<a onclick="change_result_status(<?php echo $home_info['id']?>,2)" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>审核不通过</a>
		<?php }?>
                <a onclick="save_survey_result(<?php echo $home_info['id']?>);" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>保存修改</a>
            </div>
<div class="survey_wrap" style="min-height:500px;margin-top:100px">
	<div class="survey_title" style="margin-top:-50px;">

                            <div class="inner">
                                <h1 class="title_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="false" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_34" style="position: relative;" id="survey_name"><?php echo $name?></h1>

                            </div>

                        </div>
	<div class="survey_prefix">

                            <div class="inner">

                                <div class="prefix_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="false" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_56" style="position: relative;" id="survey_description"><?php echo $description?></div>

                            </div>

                        </div>
	 <div class="survey_title" style="margin-top:50px;">

                            <div class="inner">
                                <h1 class="title_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="false" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_34" style="position: relative;" id="survey_name">录音</h1>

                            </div>

                        </div>
                        <div style="margin:0 auto;width:460px;">
                        <?php if($home_info['auto']){?>
                        <audio src="/upload/audio/<?php echo $home_info['auto']?>" preload="auto" />
                        <?php }?>
                        </div>
	<div class="page_edit">
	<div class="survey_pages_tab ">

                        <a class="pages_preview" href="javascript:;"><i></i></a>

                        <!-- 滚动容器 -->
			<div class="pages_wrap">

                            <!-- 页码容器 -->
                            <ul id ="pages_item"><li onclick="change_page(this)" id="page_0" class="pages_item current" data-pid="0"> <span class="pages_show">第0页</span> </li>
                                <?php for($i=1;$i<=$pages;$i++){?>
                                        <li onclick="change_page(this)" class="pages_item" id="page_<?php echo $i?>" data-pid="<?php echo $i?>"> <span class="pages_show">第<?php echo $i?>页</span>  </li>
                                <?php }?>
                                </ul>

                            <!-- 结束页码 -->
                            <a class=" pages_end" id="pages_end">
                                <span class="pages_show">结束页</span>
                            </a>

                        </div>
			<a class="pages_next" href="javascript:;"><i></i></a>

                    </div>
	</div>
	<div class="survey_main">
	<div class="survey_container">
		<div class="page" data-pid="0" style="display: block;">
			<div class="survey_title" style="margin-top:50px;">

                            <div class="inner">
                                <h1 class="title_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="false" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_34" style="position: relative;" id="survey_name">签到照片</h1>

                            </div>

                        </div>
			<div style="margin-top:360px">
    				<ul id="flip">
				<?php if($pictures){?>
                                <?php $num  =0; foreach ($pictures as $item): $num++;?>
				<li><img src="/upload/images/<?php echo $item?>" ></li>
                                <?php endforeach;?>
                        	<?php }?>
				</ul>
			</div>
		</div>
		<?php for($i=1;$i<=$pages;$i++){?>
			<div class="page" data-pid="<?php echo $i?>" style="display: none;">
			<?php if(isset($question_list[$i])){?>
                        <?php $num  =0; foreach ($question_list[$i] as $item): $num++;?>
				<?php if ($item['type'] == 1 || $item['type'] == 4){?>
                                <div class="question question_text required" type="<?php echo $item['type']?>" data-type="text" id="question_<?php echo $item['id']?>" data-id="<?php echo $item['id']?>"> <div class="inner"> <div class="title"> <span class="title_index"><span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <p><?php echo $item['question']?><?php if($item['is_nessary']){?><span class="required" title="必答">*</span><?php }?></p></div><span class="tips">  </span> </div><div class="inputs"style="margin-top:10px;"> <input class="survey_form_input" type="text" size="" maxlength="" id="text_<?php echo $item['id']?>" name="answer_<?php echo $item['id']?>" value=""> </div> </div></div>
				<?php } if( $item['type'] == 2){?>
				<div class="question question_radio required" type="<?php echo $item['type']?>" id="question_<?php echo $item['id']?>" data-type="radio" data-id="<?php echo $item['id']?>" style="display: block;"> <div class="inner"> <div class="title"> <span class="title_index"> <span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <?php echo $item['question']?><?php if($item['is_nessary']){?>  <span class="required" title="必答" >*</span><?php }?></div>  <span class="tips">  </span> </div> <div class="description"> <div class="description_text">  </div> </div>   <div class="inputs">  
				<?php foreach ($item['option_list'] as $option_list):?>
				<div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" skip_id="<?php echo $option_list['return_id']?>" name="answer_<?php echo $item['id']?>" data-oid="<?php echo $item['id']?>" data-exclusive="0" id="option_<?php echo $item['id']?>_<?php echo $option_list['number']?>" value="<?php echo $option_list['number']?>"> <label for="option_<?php echo $item['id']?>_<?php echo $option_list['number']?>"> <i class="survey_form_ui"></i> <div class="option_text"><?php echo $option_list['content']?></div> <div class="stat"> <div class="bar"></div> <span class="rate"></span> <span class="count"></span> </div> </label>  </div> 

                                <?php endforeach;?></div> </div> </div>
                                <?php }else if( $item['type'] == 3){?>
					<div class="question question_checkbox required" id="question_<?php echo $item['id']?>" type="<?php echo $item['type']?>" data-type="checkbox" data-id="<?php echo $item['id']?>" style="display: block;"> <div class="inner"> <div class="title"> <span class="title_index"> <span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <p><?php echo $item['question']?><span style="color:#53aaf3;margin-left:3px;">[多选题]<?php if($item['is_nessary']){?>  <span class="required" title="必答" >*</span><?php }?></div> <span class="tips">  </span> </div> <div class="description"> <div class="description_text"> </div> </div>   <div class="inputs">
					<?php foreach ($item['option_list'] as $option_list):?>
					
   <div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="checkbox" name="answer_<?php echo $item['id']?>" data-oid="<?php echo $item['id']?>" data-exclusive="0" id="option_<?php echo $item['id']?>_<?php echo $option_list['number']?>" value="<?php echo $option_list['number']?>" value="<?php echo $option_list['number']?>"> <label for="option_<?php echo $item['id']?>_<?php echo $option_list['number']?>"> <i class="survey_form_ui"></i> <div class="option_text"><?php echo $option_list['content']?></div> <div class="stat"> <div class="bar"></div> <span class="rate"></span> <span class="count"></span> </div> </label>  </div>  
					<?php endforeach;?>
</div> </div> </div>

                                <?php }?>
                        <?php endforeach;?>
			<?php }?>
                        </div>
		<?php }?>
		<div class="survey_suffix" style="display: none;">

                            <div class="inner">

                                <div class="suffix_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_82" style="position: relative;"><p><img data-cke-saved-src="../../assets/image/end.png" src="../../assets/image/end.png"></p><p><br></p><p>问卷到此结束，感谢您的参与！</p></div>

                            </div>

                        </div>
	</div>
	</div>
</div>
</div>
  <!-- content end -->  
<!-- content end -->
</div>

<footer>
  <hr>
</footer>

<!--[if lt IE 9]>
<script src="../../assets/js/jquery1.11.1.min.js"></script>
<script src="../../assets/js/modernizr.js"></script>
<script src="../../assets/js/polyfill/rem.min.js"></script>
<script src="../../assets/js/polyfill/respond.min.js"></script>
<script src="../../assets/js/amazeui.legacy.js"></script>
<![endif]-->

<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="../../assets/js/app.js"></script>
<script src="../../assets/js/jquery.gridly.js"></script>
<script src="../../assets/js/jquery-ui.min.js"></script>
<script src="../../assets/js/survey.js"></script>
<script src="../../assets/js/audiojs/audio.min.js"></script>
<script src="../../assets/js/slides.min.jquery.js"></script>
<script src="../../assets/js/zDrag.js"></script>
<script src="../../assets/js/zDialog.js"></script>
<script src="../../assets/js/jquery.jcoverflip.js"></script>
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=437a0558f1ae01520a7c0ba63fb69ed8"></script>
<script type="text/javascript">
 audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
var survey_id = <?php echo $id?>;
var page_count = <?php echo $pages?>;
var list = eval('<?php echo json_encode($list);?>');
//var answers = eval("("+'<?php echo json_encode($answers);?>'+")");
//var answers = eval("('<?php echo json_encode($answers);?>')");
var home_id = "<?php echo $home_info['id']?>";
$.ajax({
                type: 'POST',
                url: "/main/get_answers",
                data: {home_id:home_id},
                dataType: 'json',
                success: function(data){
			var answers = data;
			for(var i=0;i<answers.length;i++){
 			        var num = answers[i]['number'];
        			var type = $("#question_"+num).attr('type');
        			if(type ==1 ){
                			$("input[name=answer_"+num+"]").val(answers[i]['result']);
        			}else if(type ==2){
                			$("#option_"+answers[i]['number']+"_"+answers[i]['result']).click();
        			}else if(type ==3){
                			var tmp = answers[i]['result'].split(",");
                			for(var j=0;j<tmp.length;j++){
                        			$("#option_"+answers[i]['number']+"_"+tmp[j]).click();
                			}
        			}
				else if(type ==4 ){
					var result = eval("("+answers[i]['result']+")");
					if(result){
                                        $("input[name=answer_"+num+"]").val(result['locationName']);
					}
					$("input[name=answer_"+num+"]").after('<a href="javascript:getAddress('+num+');">地图选址</a>');
                                }
			}
                },
                error: function(){
                        alert('Error loading PHP document');

                }
        });
var page = 1;
scrollIndex = 0;
 $(function() {
	$('#flip').jcoverflip();
$('.pages_preview').click(function(e){
        if(scrollIndex >= 96){
                scrollIndex -= 96;
        }
        $('.pages_wrap').scrollLeft(scrollIndex)
});
$('.pages_next').click(function(e){
        var max = (page_count-8) * 96;
        if(scrollIndex < max){
                scrollIndex += 96;
        }
        $('.pages_wrap').scrollLeft(scrollIndex)
});
$(".survey_form_checkbox").click(function(e){
	skip_id = $(this).attr('skip_id');
	if(skip_id == -1){
		$("#pages_end").click();
	}else if(skip_id != 0){
		return_page = get_return_page(skip_id);
		if(return_page -1  > page){
                        for(var i = parseInt(page) + 1; i < parseInt(return_page); i ++){
                                $("#page_"+i).hide();
                        }
                }
		$("#page_"+return_page).click();
	}
});
$("#header_create").removeClass("current");
$("#header_mine").addClass("current");
$("#header_project").removeClass("current");
	$(".pages_end").click(function(e){
		$(".pages_item").removeClass("current");
		$(".page").removeClass("current").hide();
		$("#questions").hide();
		$(".survey_title").hide();
		$(this).addClass("current");
		$(".survey_suffix").show();
	});
	$(".pages_more").click(function(e){
		page_count = page_count + 1;
		var str= '<li onclick="change_page(this)" class="pages_item" data-pid="'+page_count +'"> <span class="pages_show">第'+ page_count+'页</span> <a class="pages_remove" href="javascript:;" onclick="delete_page(this)">×</a> </li>';
		$("#pages_item").append(str);
		str = '<div class="page" data-pid="'+page_count+'" style="display: block;"> </div>'
		$(".survey_suffix").before(str);
	});
});
var edit_flag = false;
var question_num = <?php echo $number + 1?>;
function get_page(home_id,survey_id,type){
	 $.ajax({
                type: 'POST',
                url: "/main/get_page",
                data: {survey_id:survey_id,home_id:home_id,type:type},
                dataType: 'json',
                success: function(data){
			if(data.id){
				window.location.href="/main/result_page?id="+data.id+"&survey_id="+survey_id;
			}else{
				alert("已经没有符合的页面");
			}

                },
                error: function(){
                        alert('Error loading PHP document');

                }
        });	
}
var diag;
        var type;
        function getAddress(t) {
                 diag = new Dialog();
                type = t;
                diag = new Dialog();
                diag.Height = 500;
                diag.Width = 500;
                diag.Title = "地址选取";
                diag.InnerHtml = "<br><input id='keyWord' style='width:300px;' />&nbsp;&nbsp;<a href='javascript:search()'>搜索</a><br><br><div style='height:500px;width:500px;' id = 'map'></div>";
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
                mapObj.plugin([ "AMap.ToolBar", "AMap.OverView", "AMap.Scale","AMap.Geocoder" ],
                                function() {
                                        toolbar = new AMap.ToolBar();
                                        toolbar.autoPosition = false; //加载工具条
                                        mapObj.addControl(toolbar);
                                        overview = new AMap.OverView(); //加载鹰眼
                                        mapObj.addControl(overview);
                                        scale = new AMap.Scale(); //加载比例尺
                                        mapObj.addControl(scale);
					geocoder = new AMap.Geocoder({
                                		radius: 1000,
                                		extensions: "all"
                        		});
					mapObj.addControl(geocoder);
                                });
                AMap.event.addListener(mapObj,"dblclick",getLngLat1);
        }
	function geocoder_CallBack(data){
                        var resultStr="";
                        //地理编码结果数组

                        resultStr = data.regeocode.formattedAddress;

                        mapObj.setFitView();
                        return resultStr;
        }
	function getLngLat1(e) {
		var lnglatXY = new AMap.LngLat( e.lnglat.lng,e.lnglat.lat);
		geocoder.getAddress(lnglatXY, function(status, result){
                                //取回逆地理编码结果
                                if(status === 'complete' && result.info === 'OK'){
					var address = result.regeocode.formattedAddress;
					$("input[name=answer_"+type+"]").val(address);
					var array = {locationTitle:address,longitude:e.lnglat.lng,locationName:address,latitude:e.lnglat.lat};
					var json = JSON.stringify(array);
					$.ajax({
                				type: 'POST',
                				url: "/survey_result/update_answer",
                				data: {home_id:home_id,result:json,num:type},
                				dataType: 'json',
                				success: function(data){
                				}
        				});
				}
		});
                if (confirm("确定使用此地址么?经度: " + e.lnglat.lng + " 维度:" + e.lnglat.lat)) {
                        diag.close();
                }
        }
</script>
</body>
</html>
