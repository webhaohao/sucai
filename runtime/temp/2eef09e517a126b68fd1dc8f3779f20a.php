<?php /*a:2:{s:64:"/www/wwwroot/193.112.16.15/app/admin/view/common_showmessage.php";i:1556501192;s:52:"/www/wwwroot/193.112.16.15/app/admin/view/layout.php";i:1557353486;}*/ ?>
<!DOCTYPE html>
<html style="background: #f2f2f2;">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content="always" name="referrer">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>管理中心</title>
	<base href="<?php echo htmlentities($_G['site_url']); ?>">
	<script src="static/js/jquery-3.3.1.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/common.css">
</head>
<body>
<nav class="d-flex justify-content-between fixed-top admin-top bg-white">
	<div class="d-flex justify-content-start pl-3">
		<a class="px-3" href="<?php echo htmlentities($_G['site_url']); ?>" target="_blank">前台首页</a>
		<a class="px-3 text-danger upgrade-cms d-none" href="<?php echo url('admin/tools/check_version'); ?>">更新程序</a>
	</div>
	<div class="d-flex justify-content-end pr-3">
		<a class="px-3" href="javascript:;">欢迎您，<?php echo htmlentities($_G['member']['username']); ?></a>
		<a class="px-3" href="<?php echo url('admin/account/logout'); ?>">退出</a>
	</div>
</nav>
<div class="left-bar">
	<h5>管理中心</h5>
	<div class="left-nav">
		<a class="<?php if(app('request')->controller() == 'Index'): ?>active<?php endif; ?>" href="<?php echo url('admin/index/index'); ?>">控 制 台</a>
		<a class="<?php if(app('request')->controller() == 'Setting' && app('request')->action() == 'index'): ?>active<?php endif; ?>" href="<?php echo url('admin/setting/index'); ?>">系统设置</a>
		<a class="<?php if(app('request')->controller() == 'Setting' && app('request')->action() == 'email'): ?>active<?php endif; ?>" href="<?php echo url('admin/setting/email'); ?>">邮件设置</a>
		<a class="<?php if(app('request')->controller() == 'Setting' && app('request')->action() == 'proxy'): ?>active<?php endif; ?>" href="<?php echo url('admin/setting/proxy'); ?>">代理设置</a>
		<a class="<?php if(app('request')->controller() == 'Site'): ?>active<?php endif; ?>" href="<?php echo url('admin/site/index'); ?>">站点配置</a>
		<a class="<?php if(app('request')->controller() == 'User'): ?>active<?php endif; ?>" href="<?php echo url('admin/user/index'); ?>">会员数据</a>
		<a class="<?php if(app('request')->controller() == 'Data'): ?>active<?php endif; ?>" href="<?php echo url('admin/data/index'); ?>">附件管理</a>
		<a class="<?php if(app('request')->controller() == 'Log'): ?>active<?php endif; ?>" href="<?php echo url('admin/log/index'); ?>">解析记录</a>
		<a class="<?php if(app('request')->controller() == 'Card'): ?>active<?php endif; ?>" href="<?php echo url('admin/card/index'); ?>">充值卡密</a>
		<a class="<?php if(app('request')->controller() == 'Queue'): ?>active<?php endif; ?>" href="<?php echo url('admin/queue/index'); ?>">计划任务</a>
		<a class="<?php if(app('request')->controller() == 'Tools'): ?>active<?php endif; ?>" href="<?php echo url('admin/tools/index'); ?>">更新缓存</a>
	</div>
</div>
<div class="admin-content">
	<div class="p-3"><?php
switch ($code) {
    case -1:
        $show_class = 'error';
        break;
    case 2:
        $show_class = 'loading';
        break;
    case 1:
        $show_class = 'right';
        break;
    default:
        $show_class = 'info';
}
?>
<style type="text/css">
/*Jump*/
.system-jump-box {
    border: 0.25rem solid #c6e9ff;
    margin: 1rem 0;
}

.system-jump-message>h5>.system-jump-icon {
    font-size: 1.25rem;
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
}

.system-jump-right {
    background: #e2ffea;
}

.system-jump-right>h5 {
    color: #59ba74;
}

.system-jump-info {
    background: #F2F9FD;
}

.system-jump-info>h5 {
    color: #888888;
}

.system-jump-error {
    background: #fff0f0;
}

.system-jump-error>h5 {
    color: #d70000;
}

.system-jump-loading {
    background: #e8ecff;
}

.system-jump-loading>h5 {
    color: #36befa;
}
</style>

<div class="system-jump-box">
    <div class="system-jump-message system-jump-<?php echo htmlentities($show_class); ?> p-3">
        <h5>
            <?php switch($code): case "-1": ?><i class="adt-icon system-jump-icon icon-show-error"></i><?php break; case "2": ?><i class="adt-icon system-jump-icon icon-show-loading"></i><?php break; case "1": ?><i class="adt-icon system-jump-icon icon-show-right"></i><?php break; default: ?><i class="adt-icon system-jump-icon icon-show-info"></i>
            <?php endswitch; ?>
            <?php echo strip_tags($msg); ?>
        </h5>
        <?php if($code === 2): ?>
            <div class="progress mb-2">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-100"></div>
            </div>
        <?php endif; ?>
        <div class="system-jump form-text text-muted">
            页面将在<b id="system-jump-wait"><?php echo htmlentities($wait); ?></b>秒后跳转，<a id="system-jump-href" href="<?php echo htmlentities($url); ?>">点击这里快速跳转</a>
        </div>
    </div>
</div>
<script>
    $(function(){
        var wait = <?php echo htmlentities($wait); ?>,
            href = $('#system-jump-href').attr('href');
        if(parseInt(wait) <= 0){
            location.href = href;
        }else{
            var interval = setInterval(function(){
                wait--;
                $('#system-jump-wait').html(wait);
                if(wait <= 0) {
                    clearInterval(interval);
                    location.href = href;
                };
            }, 1000);
        }
    })
</script>
</div>
</div>
<script type="text/javascript" src="static/js/common.js"></script>
<script type="text/javascript">
	$(function(){
		$.ajax({
			url:'<?php echo url('admin/index/check'); ?>',
			dataType:'json',
			success:function(s){
				if(s.has_new == 1){
					if($('.version').length>0){
						$('.version').after('<a class="pl-3 text-success" href="<?php echo url('admin/tools/check_version'); ?>">发现新版本：'+s.version+'，点击更新程序</a>');
					}
					if($('.upgrade-log').length>0){
						$('.upgrade-log').removeClass('d-none').html(s.upgrade_log);
					}
					$('.upgrade-cms').removeClass('d-none').html('发现新版本：'+s.version+'，点击更新程序');
				}
			}
		})
	})
</script>
</body>
</html>
