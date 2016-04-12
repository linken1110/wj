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
	<div class="admin-content">

  <div class="am-cf am-padding">
    <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">配置项目题目</strong> </div>
  </div>

  <div class="am-tabs am-margin" data-am-tabs>
    <ul class="am-tabs-nav am-nav am-nav-tabs">
      <li class="am-active"><a href="#tab1">基本信息</a></li>
    </ul>

    <div class="am-tabs-bd">
      <div class="am-tab-panel am-fade am-in am-active" id="tab1">
        <form class="am-form" action="/project/update_category" id="my_form" method="post">
		<input type="hidden" value="<?php echo $info['id']?>" name="id" />
		<input type="hidden" name="category_list" value="1111" id="category">
                <div class="am-g am-margin-top">
            <div class="am-u-sm-2 am-text-right">
              项目名称
            </div>
            <div class="am-u-sm-4" style="float:left">
              <input type="text" name ="name" class="am-input-sm" value="<?php echo $info['name']?>" disabled="true">
            </div>
          </div>
		<div class="am-g am-margin-top">
          <div class="am-u-sm-2 am-text-right">省份</div>
          <div class="am-u-sm-10">
            <select name = "province" id= "province" disabled="true">
		<option value="北京">北京</option>
                <option value="天津">天津</option>
                <option value="上海">上海</option>
                <option value="重庆">重庆</option>
                <option value="黑龙江">黑龙江</option>
                <option value="吉林">吉林</option>
                <option value="辽宁">辽宁</option>
                <option value="河北">河北</option>
                <option value="河南">河南</option>
                <option value="山东">山东</option>
                <option value="山西">山西</option>
                <option value="陕西">陕西</option>
                <option value="宁夏">宁夏</option>
                <option value="甘肃">甘肃</option>
                <option value="青海">青海</option>
                <option value="新疆">新疆</option>
                <option value="四川">四川</option>
                <option value="贵州">贵州</option>
                <option value="云南">云南</option>
                <option value="西藏">西藏</option>
                <option value="湖北">湖北</option>
                <option value="湖南">湖南</option>
                <option value="广西">广西</option>
                <option value="广东">广东</option>
                <option value="海南">海南</option>
                <option value="安徽">安徽</option>
                <option value="江西">江西</option>
                <option value="江苏">江苏</option>
                <option value="浙江">浙江</option>
                <option value="福建">福建</option>
                <option value="内蒙古">内蒙古</option>
            </select>
          </div>
        </div>
		<div class="am-g am-margin-top">
          <div class="am-u-sm-2 am-text-right">题目类型</div>
          <div class="am-u-sm-10">
        	<div class="am-btn-group" data-am-button="">
              <label class="am-btn am-btn-default am-btn-xs " id ="category1" onclick="change(0);">
                 住户基本特征情况
              </label>
              <label class="am-btn am-btn-default am-btn-xs " id ="category2" onclick="change(1);">
                 个人基本特征情况
              </label>
              <label class="am-btn am-btn-default am-btn-xs " id ="category3" onclick="change(2);">
                 个人意愿调查
              </label>
              <label class="am-btn am-btn-default am-btn-xs" id ="category4" onclick="change(3);">
                 行链调查
              </label>
            </div>   
	 </div>
          </div>
        </div>

</form>
      </div>



  </div>

  <div class="am-margin">
    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="submit();">提交保存</button>
    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="location.reload(false);">放弃保存</button>
  </div>
</div>
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
<script src="../../assets/js/jquery-1.9.1.min.js"></script>
<script src="../../assets/js/amazeui.min.js"></script>
<!--<![endif]-->
</body>
<script type="text/javascript">
var arr = new Array('0','0','0','0');
        <?php foreach ($list as $item):?>
                arr[<?php echo $item -1?>] = '1';       
        <?php endforeach;?>
function submit(){
	var a = arr[0] + arr[1]+arr[2] +arr[3];
	$("#category").val(a);
	$("#my_form").submit();
}
function change(i){
	arr[i] = (arr[i] == 1)? '0':'1';
}
$(function(){
	var chkData = "<?php echo $info['province']?>";
      	$('#province option').each(function(){
		var self = $(this);
        	var selfVal = self.val();
        	if(selfVal == chkData) 
		{
			self.attr('selected' , 'true');
		}
    	});
	if(arr[0] ==1){
		$("#category1").addClass("am-active");
	}if(arr[1] ==1){
                $("#category2").addClass("am-active");
        }if(arr[2] ==1){
                $("#category3").addClass("am-active");
        }if(arr[3] ==1){
                $("#category4").addClass("am-active");
        }
});
</script>
</html>
