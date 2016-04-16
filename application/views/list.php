<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Amaze后台管理系统模板HTML首页 - 源码之家</title>
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
</head>
<body class="g_wrapper g_wrapper_full page_mine">
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<?php include 'header.php';?>
<div class="am-cf admin-main">
<div class="g_subheader" style="position:absolute">
        <div class="g_content">
            <a id="create_survey" class="btn btn_middle btn_blue" href="/main/create">
                <i class="ico ico_create"></i>创建问卷
            </a>
            <div id="change_view_type" class="change_view_type">
                <a href="/main/indexGrid" class="list_type list_type_grid" data-type="grid">
                    <i class="ico ico_grid"></i>网格视图
                </a>
                <a href="/main/index" class="list_type list_type_table active" data-type="table">
                    <i class="ico ico_table"></i>列表视图
                </a>
            </div>
        </div>
    </div>
    <div id="container" class="g_container" style="margin-top:60px;">
        <div id="empty_tip">
            <img src="../../assets/image/wj/empty_tip.png" alt="您还没有问卷" class="src">
            <h3>您还没有问卷。</h3>
            <a class="btn btn_large btn_blue" href="http://wj.qq.com/guide.html">
                <i class="ico ico_create"></i>现在去创建
            </a>
            <div class="tip_foot">
                <h3>腾讯问卷为您提供专业调研服务。</h3>
                <div class="logo">
                    <i class="ico ico_edit"></i>
                    <h3>设计</h3>
                </div>
                <div class="logo">
                    <i class="ico ico_publish"></i>
                    <h3>投放</h3>
                </div>
                <div class="logo" style="margin-right: 0;">
                    <i class="ico ico_stat"></i>
                    <h3>统计</h3>
                </div>
            </div>
        </div>
        <div id="list_view_container" class="list_view_container table_type">
		<div class="list_table_head">
                <div class="title sort_btn" data-field="title" data-order="1">项目名称<span class="arrow">↓</span></div>
                <div class="status_col sort_btn" data-field="status" data-order="1">状态<span class="arrow">↓</span></div>
                <div class="more_operations">操作</div>
                <div class="recycle sort_btn" style="width:200px;" data-field="recycle" data-order="1">上传数量<span class="arrow">↓</span></div>
                <div class="create_time sort_btn current" data-field="update_time" data-order="1">创建时间<span class="arrow">↓</span></div>
            </div>
            <div id="survey_list" class="survey_list">
		<?php if(!empty($survey_list)){?>
		<?php $num  =0; foreach ($survey_list as $item): $num++;?>
		<span id="survey_<?php echo $item['id']?>" data-id="<?php echo $item['id']?>" class="survey_item"> <img class="thumbnail" src="" alt="<?php echo $item['name']?>"> <div class="title_wrap"> <div class="title" title="<?php echo $item['name']?>"> <a href="/main/survey_detail?id=<?php echo $item['id']?>" class="edit_survey">  <i class="status ico ico_red_circle"></i> (<?php echo $item['id']?>)<?php echo $item['name']?>  </a> </div> </div> <div class="status_col"><a onclick="change_status(<?php echo $item['id']?>,<?php echo $item['status']?>)">  <?php if($item['status'] ==1 ){?><i class="status ico ico_green_circle"></i>已上线<?php }else{?><i class="status ico ico_red_circle"></i>未上线<?php }?> </a> </div> <div class="more_operations"> 
 <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
 <button class="am-btn am-btn-default am-btn-xs am-text-secondary" type="button" onclick="edit_survey(<?php echo $item['id']?>)"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger" type="button" onclick="delete_survey(<?php echo $item['id']?>)"><span class="am-icon-trash-o"></span> 删除</button>
                    <button type="button" class="am-btn am-btn-default" onclick="window.location.href='/statics/download_data?survey_id=<?php echo $item['id']?>'"> 数据导出</button>
                        <button type="button" class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="window.location.href='/statics/question_result?survey_id=<?php echo $item['id']?>'">数据统计</button>
		 <button type="button" class="am-btn am-btn-default " onclick="window.location.href='/survey_result/home_list?survey_id=<?php echo $item['id']?>'">查看结果</button>
		<button type="button" class="am-btn am-btn-default " onclick="copy_survey(<?php echo $item['id']?>)">复制问卷</button>
</div></div>
</div> <div class="recycle"><?php echo $item['all']?></div>   <div class="create_time"><?php echo $item['create_date']?></div></span>
		<?php endforeach;?>
		<?php }?>
		</div>
        </div>
        <div id="survey_detail" class="survey_detail"></div>
  <!-- content start -->
  <div class="admin-content">


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
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/amazeui.min.js"></script>
<!--<![endif]-->
<script src="../../assets/js/app.js"></script>
<script src="../../assets/js/survey.js"></script>
</body>
</html>
