<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="这是一个 table 页面">
  <meta name="keywords" content="table">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="../../assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="../../assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="../../assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <link rel="stylesheet" href="../../assets/css/wj/editor.css">
  <link rel="stylesheet" href="../../assets/css/js_demo.css">
  <link rel="stylesheet" href="../../assets/css/wj/style.css">
  <link rel="stylesheet" href="../../assets/css/wj/main.min.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<?php include 'header.php';?>

<div class="container">
  

<div class="form-overview">
  <ul class="data-info clearfix gd-row">
  <li class="gd-col-4 gd-grid-block">
    <span class="number">
      <a href="/forms/ABpnhg/entries"><?php echo $all?></a>
    </span>
    <span class="info-name">表单总数据</span>
  </li>
  <li class="gd-col-4 gd-grid-block">
    <span class="number today-number">
      <a href="/forms/ABpnhg/entries"><?php echo $today?></a>
    </span>
    <span class="info-name">今日提交</span>
  </li>
  <li class="gd-col-4 gd-grid-block">
    <span class="number"><?php echo $checked?></span>
    <span class="info-name">表单已经审核数据</span>
  </li>
  <li class="gd-col-4 gd-grid-block">
    <span class="number"><?php echo $unchecked?></span>
    <span class="info-name">表单未审核数据</span>
  </li>
</ul>

</div>
  <div class="entry-summary">
  <div class="entry-summary-header clearfix">
    <div class="left-header pull-left">

    </div>
    <div class="right-header pull-right">
          <a class="add-entry gd-btn gd-btn-info gd-btn-small" href="/main/add_result?survey_id=<?php echo $survey_id?>" >添加数据</a>
	  <a class="add-entry gd-btn gd-btn-info gd-btn-small" href="/survey_result/home_list?survey_id=<?php echo $survey_id?>" >列表模式</a>
          <i class="gd-icon-list"></i>
        </a>
    </div>
  </div>



    </div>
  </div>
<div class="iframe_wrapper"><iframe id="js_iframe" src="/main/map?id=<?php echo $survey_id?>" scrolling="no"></iframe></div>
</div>

<footer>
  <hr>
</footer>

<!--[if lt IE 9]>
<script src="assets/js/jquery1.11.1.min.js"></script>
<script src="assets/js/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/amazeui.min.js"></script>
<script src="../../assets/js/My97DatePicker/WdatePicker.js"></script>
<!--<![endif]-->
<script src="../../assets/js/app.js"></script>
<script type="text/javascript">

	function go_to_question(){
		window.location.href="/main/add_quest";
	}
	function delete_home_info(id){
		if(!confirm("确定要删除吗？")){
                return;
        	}
        	$.ajax({
                type: 'POST',
                url: "/home_info/delete",
                data: {id:id},
                dataType: 'json',
                success: function(result){
                        if(result['result']){
				$("#item"+result['id']).remove();
                        }
                },
                error: function(){
                        alert('Error loading PHP document');

                }
        	});
	}
var totalRecordNum = 50;//总记录条数(从java程序中获取)
var currentPageNumber = 1;//当前页号
if(totalRecordNum==0)
{
 currentPageNumber = 0;
}
var perPageRecordNum = 20;//每页记录条数(js中设置)
//计算总页数
var totalPageNumber = Math.ceil(totalRecordNum/perPageRecordNum);
if(totalPageNumber >1){
	for(i =2;i<=totalPageNumber;i++){
		$("#next").before("<li class='page' id='page"+i+"'><a onclick='goToPage("+i+")'>"+i+"</a></li>");
	}
}
var startShowPage ;//开始显示页记录号数
var endShowPage ;//结束显示页记录号数
//回车键和点击"GO"图片的效果一样
//跳到指定页
function goToPage(pageNo)
{
  //跳转到指定页
   startShowPage = (pageNo-1)*perPageRecordNum;
   endShowPage  = pageNo*perPageRecordNum;
   exeShowPage();
   currentPageNumber = pageNo;
   update_show();
}
//跳转到第一页
function goToFirstPage()
{
   if(totalRecordNum != 0)
   {
  startShowPage = 0*perPageRecordNum;
  endShowPage  = 1*perPageRecordNum;
  currentPageNumber = 1;
  exeShowPage();
  update_show();
 }
}
function goToLastPage()
{
   if(totalRecordNum != 0)
   {
  if(totalRecordNum%perPageRecordNum==0)//除尽
  {
   var tempVal = totalRecordNum/perPageRecordNum;
     startShowPage = (tempVal-1)*perPageRecordNum;
    endShowPage  = tempVal*perPageRecordNum;
  }
  else
  { 
     var tempVal = totalRecordNum%perPageRecordNum;//得到余数,就是最后一页要显示的记录条数
     startShowPage = totalRecordNum-tempVal;
      endShowPage  = totalRecordNum;
  }
  currentPageNumber=totalPageNumber;
  exeShowPage(); 
  update_show();
 }
}
function goToNextPage()
{
   if(totalRecordNum != 0)
   {
    if(currentPageNumber< totalPageNumber)
    {
   currentPageNumber = Number(currentPageNumber)+1;   
   startShowPage = (currentPageNumber-1)*perPageRecordNum;
   endShowPage  = currentPageNumber*perPageRecordNum;
   exeShowPage();
   update_show();
  }
  else
  {
   alert("当前页已经是最后一页了!");
  } 
 }
}
function goToBeforePage()
{
   if(totalRecordNum != 0)
   {
     if(currentPageNumber>1)
     {
   currentPageNumber = currentPageNumber-1;
   startShowPage = (currentPageNumber-1)*perPageRecordNum;
   endShowPage  = currentPageNumber*perPageRecordNum;
   exeShowPage(); 
   update_show();
  }
  else
  {
   alert("当前页已经是第一页了!");
  } 
 }
}
function exeShowPage()
{   
  for(var i = 0; i<totalRecordNum;i++)
  {
      if ((i>=startShowPage)&&(i<endShowPage))
     {
	$(".row"+i).show();
     }
     else
     {
		$(".row"+i).hide();
   }
  }
}
function update_show(){
	$(".page").removeClass("am-active");
        $("#page"+currentPageNumber).addClass("am-active");
} 
goToPage(1);
</script>
</body>
</html>
