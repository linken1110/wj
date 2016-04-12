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
    <span class="number"><?php echo $passed?></span>
    <span class="info-name">审核通过</span>
  </li>
  <li class="gd-col-4 gd-grid-block">
    <span class="number"><?php echo $unpassed?></span>
    <span class="info-name">审核不通过</span>
  </li>
  <li class="gd-col-4 gd-grid-block">
    <span class="number"><?php echo $unchecked?></span>
    <span class="info-name">未审核数据</span>
  </li>
</ul>

</div>
  <div class="entry-summary">
  <div class="entry-summary-header clearfix">
    <div class="left-header pull-left">
	<a class="add-entry gd-btn gd-btn-info gd-btn-small" onclick ="delete_items(<?php echo $survey_id?>)" >删除数据</a>
    </div>
    <div class="right-header pull-right">
          <a class="add-entry gd-btn gd-btn-info gd-btn-small" href="/main/add_result?survey_id=<?php echo $survey_id?>" >添加数据</a>
          <a class="add-entry gd-btn gd-btn-info gd-btn-small" href="/survey_result/index?id=<?php echo $survey_id?>" >地图模式</a>
    </div>
  </div>



    </div>
  </div>
<div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form" action="/survey_result/search">
		<input type="hidden" name="survey_id"  value="<?php echo $survey_id?>">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-title">问卷编号</th><th class="table-title">调查员编号</th><th class="table-author">调查日期</th><th class="table-author">问卷时长(分)</th><th class="table-set">质检状态</th>
              </tr>
          </thead>
	<tr>
		<td><span class="input-group-btn">
      <button class="search-submit btn btn-default" style="height:30px;background-color:#479de6">
          <i class="fa fa-search"></i>
          <span class="sr-only">Search</span>
      </button>
    </span></td>
		 <td><input type="text" style="font-size:11px;"name="search_id" placeholder="问卷编号"/></td>
		 <td><input type="text" style="font-size:11px;" name="user_name"  placeholder="调查员编号"/></td>
		 <td><input type="text"  name="search_date" class="am-form-field am-input-sm" onfocus="WdatePicker({startDate:'%y-%M-01 ',dateFmt:'yyyy-MM-dd',alwaysUseStartDate:false,firstDayOfWeek:1})"/></td>
	 <td><input type="text" style="font-size:11px;" name="search_time"  placeholder="调查时长"/></td>
	 <td><select name="search_status" style="font-size:11px;"> <option value ="0">未审核</option> <option value ="1">审核通过</option><option value ="2">审核不通过</option><<option value ="3">全部</option>/select></td>
</tr>
	<?php $num  =0; foreach ($list as $item): $num++;?>
	<tr class="row<?php echo $num?>">
		<td><input type="checkbox" name="checkbox" value="<?php echo $item['id']?>"/></td>
		<td><a href="/main/result_page?id=<?php echo $item['id']?>&survey_id=<?php echo $item['survey_id']?>"><?php echo $item['identifier']?></a></td>
		<td><?php echo $item['user_id']?></td>
		<td><?php echo $item['create_date']?></td>
		<td><?php echo $item['survey_time']?></td>
		<td><?php if ($item['status']==1){?>审核通过<?php }else if ($item['status']==2){?>审核不通过<?php }else{?>未审核<?php }?></td>
	</tr>
	<?php endforeach;?>
</table>
 <div class="am-cf">
  共 <?php echo $count?> 条记录
  <div class="am-fr">
    <ul class="am-pagination">
	<li class = "page" id="first"><a onclick="goToPage(1)">第一页</a></li>
      <li class = "page" id="front"><a onclick="goToBeforePage()">«</a></li>
      <li class="page am-active" id="page1"><a onclick="goToPage(1)">1</a></li>
      <li class="page" id="next"><a onclick="goToNextPage()">»</a></li>
	<li class="page" id="last"><a onclick="goToLastPage()">最后页</a></li>
    </ul>
  </div>
</div>
</div></div>
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
var totalRecordNum = <?php echo $count?>;//总记录条数(从java程序中获取)
var currentPageNumber = 1;//当前页号
if(totalRecordNum==0)
{
 currentPageNumber = 0;
}
var perPageRecordNum = 50;//每页记录条数(js中设置)
//计算总页数
var totalPageNumber = Math.ceil(totalRecordNum/perPageRecordNum);
if(totalPageNumber >1){
	for(i =2;i<=totalPageNumber;i++){
		if(i >= 5){
			$("#next").before("<li class='page' id='page"+i+"'><a >...</a></li>");
			break;
		}
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
function delete_items(survey_id){
	if(!confirm("确定要删除吗？")){
                return;
                }
	var str="";
	$("input[name='checkbox']:checkbox").each(function(){ 
                if($(this).is(':checked')){
                    str += $(this).val()+","
                }
            })
	if(!str){
		return;
	}
                $.ajax({
                type: 'POST',
                url: "/survey_result/delete_items",
                data: {ids:str,survey_id:survey_id},
                dataType: 'json',
                success: function(result){
                        if(result['result']){
				window.location.reload();
                        }
                },
                error: function(){
                        alert('Error loading PHP document');

                }
                });
}
goToPage(1);
</script>
</body>
</html>
