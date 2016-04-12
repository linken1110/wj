<style type="text/css"> 
.nav{position:absolute;top:12px;left:350px}
.nav ul{padding:0;margin:0}
.nav li{display:inline-block;text-align:center;padding:0 20px}
.nav li.current a{color:#2f8cdb;border-bottom:2px solid #479de6}
.nav a{line-height:1;font-size:16px;padding:0 2px 7px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
</style>
<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
	<img src="../../assets/image/logo.png?v=1.6.9"  alt="同济问卷">
  </div>
<div class="nav" >
                <ul>
		<?php if($user['uid'] == 1 ){?>
         		<li id= "header_project"><a href="/project/project_list"> 客户管理</a></li>
		<?php }?>
                    <li id="header_create"><a href="/main/create">创建项目</a></li>
                    <li id="header_mine" class="current"><a href="/main">我的项目</a></li>
                </ul>
            </div>
  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;" style="cursor:default">
          <span class="am-icon-users"></span> 
	<?php if($user['position'] == 0){?>
		超级管理员
	<?php }else if($user['position'] == 1){?>
		管理员 
	<?php }else {?>
		调查员
	 <?php }?>
		</span>
        </a>
      </li>
	<li><a href="/user/logout"><span class="am-icon-power-off"></span>注销</a></li>
    </ul>

  </div>
</header>
