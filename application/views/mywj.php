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
</head>
<body class="g_wrapper g_wrapper_full page_edit g_survey" style="font-weight:400;line-height:1.6;font-size:1.6rem;font-family:'Segoe UI','Lucida Grande',Helvetica,Arial,'Microsoft YaHei',FreeSans,Arimo,'Droid Sans','wenquanyi micro hei','Hiragino Sans GB','Hiragino Sans GB W3',FontAwesome,sans-serif;">
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
<div class="survey_options published" style="display: block;margin-top:20px;margin-bottom:-20px;margin-right:20px;">
		 <a id="save_message" class="btn btn_middle btn_white"style="margin-right:300px;display: none;">保存成功</a>
                <a onclick="save_survey();" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>保存修改</a>
		<a onclick="change_audio_status(<?php echo $id?>);" id="publish_audio" class="btn btn_middle btn_blue btn_start"><?php if($is_audio_open == 0){?>开启录音<?php }else{?>关闭录音<?php }?></a>
		<a onclick="change_status_and_flush(<?php echo $id?>);" id="publish_survey" class="btn btn_middle btn_blue btn_start"><?php if($status == 0){?>发布<?php }else{?>下线<?php }?></a>
            </div>
<div class="survey_wrap" style="min-height:500px">
	
	<div class="survey_title" style="margin-top:-50px;">

                            <div class="inner">

                                <h1 class="title_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_34" style="position: relative;"><input id="survey_name"value ="<?php echo $name?>"></h1>

                            </div>

                        </div>
	<div class="survey_prefix">

                            <div class="inner">

                                <div class="prefix_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_56" style="position: relative;"><input id="survey_description" value="<?php echo $description?>"></div>

                            </div>

                        </div>
	<ul id ="questions" class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list " style="margin-top:10px;">
				       <li onclick = "add_question(2);" style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -17px;width:17px;height:16px; line-height:38px;"></i>单选题</li>
		<li onclick = "add_question(3);"style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -101px;width:16px;height:16px; line-height:38px;"></i>多选题</li>
		<li onclick = "add_question(1);" style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -149px;width:16px;height:14px; line-height:38px;"></i>填空题</li>
		<li onclick = "add_question(4);"style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -117px;width:17px;height:16px; line-height:38px;"></i>位置题</li>
    	</ul>
	<div class="survey_pages_tab ">

                        <a class="pages_preview" href="javascript:;"><i></i></a>

                        <!-- 滚动容器 -->
                        <div class="pages_wrap">

                            <!-- 页码容器 -->
                            <ul id ="pages_item"><li onclick="change_page(this)" class="pages_item current" data-pid="1"> <span class="pages_show">第1页</span> <a class="pages_remove" href="javascript:;" onclick="delete_page(this)">×</a> </li>
				<?php for($i=2;$i<=$pages;$i++){?>
					<li onclick="change_page(this)" class="pages_item" data-pid="<?php echo $i?>"> <span class="pages_show">第<?php echo $i?>页</span> <a class="pages_remove" href="javascript:;" onclick="delete_page(this)">×</a> </li>
				<?php }?>
				</ul>

                            <!-- 结束页码 -->
                            <a class=" pages_end" id="pages_end">
                                <span class="pages_show">结束页</span>
                            </a>

                        </div>

                        <a class="pages_next" href="javascript:;"><i></i></a>
                        <a class="pages_more" href="javascript:;"><i></i></a>

                    </div>
	<div class="survey_main">
	<div class="survey_container">
		<?php for($i=1;$i<=$pages;$i++){?>
			<?php if($i == 1){?>
			<div class="page current" data-pid="<?php echo $i?>" style="display: block;">
			<?php }else{?>
			<div class="page" data-pid="<?php echo $i?>" style="display: none;">
			<?php }?>
			<?php if(isset($question_list[$i])){?>
			<?php $num  =0; foreach ($question_list[$i] as $item): $num++;?>
				<div class='modules'>
                                <?php if ($item['type'] == 1 || $item['type'] == 4){?>
                                <div class="question question_text required" type="<?php echo $item['type']?>" data-type="text" id="question_<?php echo $item['id']?>" data-id="<?php echo $item['id']?>"> <div class="inner"> <div class="title"> <span class="title_index"><span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <p><?php echo $item['question']?><?php if($item['is_nessary']){?><span class="required" title="必答">*</span><?php }?></p></div><span class="tips">  </span> </div><div class="inputs"style="margin-top:10px;"> <input class="survey_form_input" type="text" size="" maxlength="" id="text_<?php echo $item['id']?>" name="answer_<?php echo $item['id']?>" value="<?php echo $item['default_value']?>" placeholder="默认值" readonly="true"> </div> </div> <ul class="control"> <li><b title="编辑" class="edit" onclick="edit(<?php echo $item['id']?>);"><i></i></b></li>  <li><b title="删除" class="delete" onclick="delete_item(<?php echo $item['id']?>);"><i></i></b></li>  </ul></div>
                                <?php }else if( $item['type'] == 2){?>
                                <div class="question question_radio required"  type="<?php echo $item['type']?>" id="question_<?php echo $item['id']?>" data-type="radio" data-id="<?php echo $item['id']?>" style="display: block;"> <div class="inner"> <div class="title"> <span class="title_index"> <span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <p><?php echo $item['question']?><?php if($item['is_nessary']){?><span class="required" title="必答">*</span><?php }?></p> </div>  <span class="tips">  </span> </div>  <div class="inputs">
                                <?php foreach ($item['option_list'] as $option_list):?>
                                        <div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" name="answer_<?php echo $item['id']?>" data-oid="o-100-ABCD" id="option_<?php echo $item['id']?>_o-100-ABCD" value="<p><?php echo $option_list['content']?></p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p><?php echo $option_list['content']?></p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>

                                <?php endforeach;?></div> </div> <ul class="control"> <li><b title="编辑" class="edit" onclick="edit(<?php echo $item['id']?>);"><i></i></b></li>   <li><b title="删除" class="delete" onclick="delete_item(<?php echo $item['id']?>);"><i></i></b></li><li><b title="设置逻辑" class="logic" onclick="show_logic(<?php echo $item['id']?>);"><i></i></b></li>  </ul></div>
                                <?php }else if( $item['type'] == 3){?>
                                         <div class="question question_radio required" type="<?php echo $item['type']?>" id="question_<?php echo $item['id']?>" data-type="radio" data-id="<?php echo $item['id']?>" style="display: block;"> <div class="inner"> <div class="title"> <span class="title_index"> <span class="question_index" data-for="<?php echo $item['id']?>"><?php echo $item['number'];?></span>. </span> <div class="title_text"> <p><?php echo $item['question']?><?php if($item['is_nessary']){?><span class="required" title="必答">*</span><?php }?></p> </div>    <span class="tips">  </span> </div>  <div class="inputs">
                                <?php foreach ($item['option_list'] as $option_list):?>
                                        <div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="checkbox" name="answer_<?php echo $item['id']?>" data-oid="o-100-ABCD" id="option_<?php echo $item['id']?>_o-100-ABCD" value="<p><?php echo $option_list['content']?></p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p><?php echo $option_list['content']?></p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>

                                <?php endforeach;?>
</div> </div> <ul class="control"> <li><b title="编辑" class="edit" onclick="edit(<?php echo $item['id']?>);"><i></i></b></li>  <li><b title="删除" class="delete" onclick="delete_item(<?php echo $item['id']?>);"><i></i></b></li>  </ul></div>

                                <?php }?>
                                </div>
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
<!--
<script src="../../assets/js/jquery.sortable.js"></script>
<script src="../../assets/js/jquery.sortable.min.js"></script>
-->
<script src="../../assets/js/sortable/Sortable.js"></script>
<script src="../../assets/js/sortable/Sortable.min.js"></script>
<script src="../../assets/js/survey.js"></script>
<script type="text/javascript">
var survey_id = <?php echo $id?>;
var page_count = <?php echo $pages?>;
var list = eval('<?php echo json_encode($list);?>');
var page = 1;
var scrollIndex=0;
 $(function() {
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
</script>
</body>
</html>
