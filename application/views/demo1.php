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
<?php include 'sidebar.php';?>
  <!-- content start -->
<!-- content start -->
  <div class="admin-content">
<div class="survey_options published" style="display: block;margin-top:20px;margin-bottom:-20px;margin-right:20px;">
		 <a id="save_message" class="btn btn_middle btn_white"style="margin-right:300px;display: none;">保存成功</a>
		<a onclick="window.location.reload();" id="preview_survey" class="btn btn_middle btn_white">撤销</a>
                <a onclick="save_survey();" id="publish_survey" class="btn btn_middle btn_blue btn_start"><i></i>保存修改</a>
            </div>
<div class="survey_wrap" style="min-height:500px">
	<div class="survey_title" style="margin-top:-50px;">

                            <div class="inner">

                                <h1 class="title_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_34" style="position: relative;">问卷标题</h1>

                            </div>

                        </div>
	<div class="survey_prefix">

                            <div class="inner">

                                <div class="prefix_content cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" contenteditable="true" tabindex="0" spellcheck="false" role="textbox" aria-label="false" aria-describedby="cke_56" style="position: relative;"><p>为了给您提供更好的服务，希望您能抽出几分钟时间，将您的感受和建议告诉我们，我们非常重视每位用户的宝贵意见，期待您的参与！现在我们就马上开始吧！</p></div>

                            </div>

                        </div>

	<ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list " style="margin-top:10px;">
				       <li onclick = "add_question(2);" style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -17px;width:17px;height:16px; line-height:38px;"></i>单选题</li>
		<li onclick = "add_question(3);"style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -101px;width:16px;height:16px; line-height:38px;"></i>多选题</li>
		<li onclick = "add_question(1);" style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -149px;width:16px;height:14px; line-height:38px;"></i>填空题</li>
		<li onclick = "add_question(4);"style="cursor:pointer;height:38px;line-height:38px;border:1px solid #e0e0e0;background-color:#fff;margin-bottom:3px"><i style=" display:inline-block;*display:inline;*zoom:1;vertical-align:middle;margin:0 10px;background-image:url(../../assets/image/sprites_ico_2x.png);background-size:241px 232px;background-position:-224px -117px;width:17px;height:16px; line-height:38px;"></i>位置题</li>
    	</ul>
	<div class="survey_main">
	<div class="survey_container">
		<div class="page" data-pid="1" style="display: block;">
		<div id='module_list'>
			<div class="modules">
								<div class="question question_radio required" id="question_1" data-type="radio" data-id="1" style="display: block;"> <div class="inner"> <div class="title"> <span class="title_index"> <span class="question_index" data-for="1">1</span>. </span> <div class="title_text"> <p>测试1题</p>
 </div>  <span class="required" title="必答" style="display: none;">*</span>  <span class="tips">  </span> </div>  <div class="inputs">   
									<div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" name="answer_1" data-oid="o-100-ABCD" id="option_1_o-100-ABCD" value="<p></p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p>选项1</p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>
									<div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" name="answer_1" data-oid="o-100-ABCD" id="option_1_o-100-ABCD" value="<p></p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p>选项2</p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>
									<div class="option_item" style="width: 100%;">  <input class="survey_form_checkbox" type="radio" name="answer_1" data-oid="o-100-ABCD" id="option_1_o-100-ABCD" value="<p></p>"> <label for="option_q-39-tpPN_o-100-ABCD" style="font-weight:500"> <i class="survey_form_ui"></i> <div class="option_text"><p>选项3</p></div> <div class="display_tip" data-goto="" data-display="">   </div></label>   </div>
					

				</div> </div> <ul class="control"> <li><b title="编辑" class="edit" onclick="edit(1);"><i></i></b></li> <li><b title="复制" class="copy"><i></i></b></li> <li><b title="设置逻辑" class="logic" onclick="show_logic();"><i></i></b></li> <li><b title="删除" class="delete" onclick="delete_item(1);"><i></i></b></li>  </ul></div>
								</div>
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

<!--[if (gte IE 9)|!(IE)]><!-->
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
 $(function() {
var el = document.getElementById('module_list');
window.x = new Sortable(el, {
				draggable: '.modules',
				handle: '.question',
				onAdd: function (evt){ console.log('onAdd.foo:', evt.item); },
				onUpdate: function (evt){ console.log('onUpdate.foo:', evt.item); },
				onRemove: function (evt){ console.log('onRemove.foo:', evt.item); },
				onStart:function(evt){ console.log('onStart.foo:',evt.item);},
				onEnd: function(evt){ 
					restore();			
				}
  });
$("#header_create").addClass("current");
$("#header_mine").removeClass("current");
});
var edit_flag = false;
var question_num = 1;
</script>
<div id="logic_dialog" tabindex="-1" style="position: absolute; display:none;outline: 0px; left: 304px; top: 0px; z-index: 1000002;" aria-labelledby="title:1445244384163" aria-describedby="content:1445244384163" class="ui-popup ui-popup-modal ui-popup-show ui-popup-focus" role="alertdialog"><div i="dialog" class="ui-dialog logic_setting_dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header"><button i="close" class="ui-dialog-close" title="取消" onclick="close_logic();">×</button><div i="title" class="ui-dialog-title" id="title:1445244384163">逻辑设置</div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1445244384163" style="width: 600px;"><div class="tabs">  <div class="tab current">显示逻辑</div>  <div class="tab ">无条件跳转</div> </div> <div class="panels">  <div class="options_panel panel current"> <div class="left_panel"> <div class="tip">当用户选择本题选项:</div> <ul>  <li class="option current">1.选项1</li>  <li class="option ">2.选项2</li>  <li class="option ">3.选项3</li>  </ul> </div>  <div class="option_panel right_panel current"> <div class="display_logic"> <div class="tip">则显示以下题目:</div>  <div class="page"> <h3>第1页</h3> <ul>  <li data-id="q-1-VYwg" class="question disabled  "> 1.测试1题 </li>  <li data-id="q-2-3VrJ" class="question   "> 2.测试2题 </li>  <li data-id="q-3-jEnm" class="question   "> 3.测试3题 </li>  </ul> </div>  </div> <div class="goto_logic"> 跳转至: <select name="goto"> <option value="">默认</option>    <option value="-1">结束页</option> </select> </div> </div>  <div class="option_panel right_panel "> <div class="display_logic"> <div class="tip">则显示以下题目:</div>  <div class="page"> <h3>第1页</h3> <ul>  <li data-id="q-1-VYwg" class="question disabled  "> 1.1 </li>  <li data-id="q-2-3VrJ" class="question   "> 2.2 </li>  <li data-id="q-3-jEnm" class="question   "> 3.3 </li>  </ul> </div>  </div> <div class="goto_logic"> 跳转至: <select name="goto"> <option value="">默认</option>    <option value="-1">结束页</option> </select> </div> </div>  <div class="option_panel right_panel "> <div class="display_logic"> <div class="tip">则显示以下题目:</div>  <div class="page"> <h3>第1页</h3> <ul>  <li data-id="q-1-VYwg" class="question disabled  "> 1.1 </li>  <li data-id="q-2-3VrJ" class="question   "> 2.2 </li>  <li data-id="q-3-jEnm" class="question   "> 3.3 </li>  </ul> </div>  </div> <div class="goto_logic"> 跳转至: <select name="goto"> <option value="">默认</option>    <option value="-1">结束页</option> </select> </div> </div>  </div>  <div id="question_panel" class="questions_panel panel "> <div class="goto_logic"> 答完本题后跳页至: <select name="goto"> <option value="">默认</option>    <option value="-1">结束页</option> </select> </div> </div> </div> </div></td></tr><tr><td i="footer" class="ui-dialog-footer"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"><button type="button" i-id="cancel" onclick="close_logic();">取消</button><button type="button" i-id="ok" autofocus="" class="ui-dialog-autofocus" onclick="close_logic();">确定</button></div></td></tr></tbody></table></div></div>
</body>
</html>
