<?php /*a:2:{s:55:"/www/wwwroot/193.112.16.15/app/admin/view/log_index.php";i:1556501306;s:52:"/www/wwwroot/193.112.16.15/app/admin/view/layout.php";i:1557353486;}*/ ?>
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
	<div class="p-3"><div class="card">
    <div class="card-header d-flex justify-content-between">
        会员解析记录
        <a class="btn btn-sm btn-danger ajax-link" data-mode="confirm" href="<?php echo url('admin/log/delete_all'); ?>">清空解析记录</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-hover table-card mb-0">
            <thead>
                <tr>
                    <th scope="col">用户</th>
                    <th scope="col">解析地址</th>
                    <th scope="col">解析时间</th>
                    <th scope="col">消耗次数</th>
                    <th scope="col">状态</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($log_list) || $log_list instanceof \think\Collection || $log_list instanceof \think\Paginator): $i = 0; $__LIST__ = $log_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo htmlentities($log['member']['username']); ?></td>
                        <td><?php echo htmlentities($log['parse_url']); ?></td>
                        <td><?php echo htmlentities($log['create_time']); ?></td>
                        <td><?php echo htmlentities($log['times']); ?></td>
                        <td><?php echo htmlentities($log['status_text']); ?></td>
                        <td>
                            <a class="ajax-link" data-mode="confirm" href="<?php echo url('admin/log/delete',['log_id'=>$log['log_id']]); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($page): ?>
        <div class="card-footer"><?php echo $page; ?></div>
    <?php endif; ?>
</div>
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
