<?php /*a:4:{s:57:"/www/wwwroot/193.112.16.15/app/index/view/index_index.php";i:1557797189;s:52:"/www/wwwroot/193.112.16.15/app/index/view/layout.php";i:1557736568;s:59:"/www/wwwroot/193.112.16.15/app/index/view/public_header.php";i:1556520768;s:59:"/www/wwwroot/193.112.16.15/app/index/view/public_footer.php";i:1556521458;}*/ ?>
<!DOCTYPE html>
<html style="background: #f2f2f2;">
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content="always" name="referrer">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo htmlentities($_G['setting']['site_name']); ?></title>
	<base href="<?php echo htmlentities($_G['site_url']); ?>">
	<script src="static/js/jquery-3.3.1.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/common.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-index bg-info">
	<div class="container">
	<a class="navbar-brand" href="<?php echo htmlentities($_G['site_url']); ?>"><?php echo htmlentities($_G['setting']['logo_name']); ?></a>
	<div class="collapse navbar-collapse">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php if(app('request')->controller() == 'Index' && app('request')->action() == 'index'): ?>active<?php endif; ?>">
				<a class="nav-link" href="<?php echo url('index/index/index'); ?>">资源解析</a>
			</li>
			<li class="nav-item <?php if(app('request')->controller() == 'Index' && app('request')->action() == 'demo'): ?>active<?php endif; ?>">
				<a class="nav-link" href="<?php echo url('index/index/demo'); ?>">解析示例</a>
			</li>
		</ul>
		<div class="navbar-nav">

			<?php if($_G['uid']): ?>
				<li class="nav-item <?php if(app('request')->controller() == 'User'): ?>active<?php endif; ?>">
					<a class="nav-link" href="<?php echo url('index/user/index'); ?>">
						<?php echo htmlentities($_G['member']['username']); if($_G['member']['type'] == 'system'): ?>
							(管理员)
						<?php else: if($_G['member']['out_time'] == 0): ?>
								(永久有效)
							<?php elseif($_G['member']['out_time'] > 0 && $_G['member']['out_time'] <= request()->time()): ?>
								(已过期)
							<?php else: ?>
								(<?php echo date('Y-m-d H:i',$_G['member']['out_time']); ?>)
							<?php endif; ?>
						<?php endif; ?>
					</a>
				</li>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('index/account/logout'); ?>">安全退出</a></li>
			<?php else: ?>
				<li class="nav-item"><a class="nav-link" href="<?php echo url('index/account/login'); ?>">登录</a></li>
				<?php if($_G['setting']['allow_register']): ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo url('index/account/register'); ?>">注册</a></li>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	</div>
</nav>
<div class="container">
	<?php if($_G['member']['out_time'] > 0 && $_G['member']['out_time'] <= request()->time()): ?>
		<div class="alert alert-primary" role="alert">您的账户已过期，无法解析资源，请联系管理员增加时间或获取新账号！</div>
	<?php endif; ?>
	<div class="url-box">
	<input type="text" class="url-text" placeholder="需要解析的链接地址" spellcheck="false">
	<div class="submit parse-btn <?php if(!empty($between_time)): ?>parse-disabled<?php endif; ?>"><?php if(!empty($between_time)): ?><span><?php echo htmlentities($between_time); ?></span> 秒<?php else: ?>解 析<?php endif; ?></div>
</div>
<div class="download-url-box text-center d-none mb-5"></div>
<div class="card user-power mb-5">
	<div class="card-header">支持的素材（资源）网站</div>
	<div class="card-body">
		<div class="site-list">
			<?php foreach($site_list as $site): ?>
				<span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="官网：<?php echo htmlentities($site['url']); ?>"><?php echo htmlentities($site['title']); ?></span>
			<?php endforeach; ?>
		</div>
		<p style="margin-top: 10px;">部分资源为独立收费资源，目前暂不支持该部分资源的解析！</p>
	</div>
</div>
<script>
	var updateTime,timeout = <?php echo isset($between_time) ? htmlentities($between_time) : 0; ?>;
	$(function(){
		$(document)
			.on('click','.submit',function(){
				if(!$('.download-url-box').data('showing')){
					$('.download-url-box').html('<p>正在努力解析中...</p>');
				}
				var link = $.trim($('.url-text').val());
				if(!link){
					$('.url-text').focus();
					return dialog.msg('请输入需要解析的网址');
				}
				parse_link(link);
			})
	})
	function parse_link(link,verify_code){
		$('.submit').addClass('disabled').html('解析中...');
		$.ajax({
			url:'<?php echo url('index/index/parse'); ?>',
			data:{link:link,verify:verify_code},
			dataType:'json',
			type:'POST',
			timeout:60000,
			success:function(s){
				if(s.code == 'verify'){
					var op = {
						type: 1,
						title: s.title,
						closeBtn: false,
						area: s.area,
						shade: 0.3,
						id: 'LAY_layuipro',
						resize: false,
						btn: ['确定提交', '取消输入'],
						btnAlign: 'c',
						moveType: 1,
						content: s.content,
						yes: function(){
							dialog.closeAll();
							var verify_code = $('#verify_code').val();
							parse_link(link,verify_code);
						},
						btn2: function(){
							dialog.closeAll();
						}
					};
					if(s.no_button == 1){
						op.btn = false;
					}
					dialog.open(op);
					$('.verify-img-box img').off('click').on('click',function(){
						var verify_code = $(this).data('key');
						dialog.closeAll();
						parse_link(link,verify_code);
					})
					return false;
				}
				if(s.code == 1){
					var urllist = '';
					$.each(s.data,function(name,url){
						urllist += '<a class="btn btn-danger '+(urllist != '' ? 'ml-3' : '')+'" href="'+url+'" target="_blank">'+name+'</a>';
					})
					timeout = <?php echo isset($_G['setting']['parse_between_time']) ? htmlentities($_G['setting']['parse_between_time']) : 0; ?>;
					if(timeout > 0){
						parse_time();
					}
					$('.download-url-box').data('showing',true);
				}else{
					urllist = s.msg;
					$('.download-url-box').data('showing',false);
				}
				$('.download-url-box').removeClass('d-none').html(urllist).show();
                dialog.msg(s.msg);
			},
            complete:function(request, status){
                $('.submit').removeClass('disabled').html('解 析');
                if(status == 'error'){
                    dialog.msg('页面错误，请联系管理员！');
                }else if(status == 'timeout'){
                    dialog.msg('数据提交超时，请重试！');
                }
            }
		})
	}
	function parse_time(){
		timeout--;
		clearTimeout(updateTime);
		if(timeout <= 0){
			$('.parse-btn').html('解 析');
			return true;
		}
		$('.parse-btn').html(timeout+' 秒');
		updateTime = setTimeout(function(){
			parse_time();
		},1000)
	}
	<?php if(!empty($between_time)): ?>parse_time();<?php endif; ?>
</script>

</div>
<?php if(!empty($_G['setting']['footer'])): ?>
	<?php echo $_G['setting']['footer']; else: ?>
	<footer>
		<div class="container text-center">
			<p>© 2019 <?php if($_G['setting']['qq']): ?>QQ：<?php echo htmlentities($_G['setting']['qq']); ?><?php endif; ?></p>
			<p>
				<span><a href="<?php echo url('index/index/index'); ?>">素材解析</a></span>
				<span><a href="<?php echo url('index/index/index'); ?>">网站首页</a></span>
			</p>
			<p>本站内容完全来自于互联网，并不对其进行任何编辑或修改。本站用户不能侵犯包括他人的著作权在内的知识产权以及其他权利</p>
		</div>
	</footer>
<?php endif; ?>
<script type="text/javascript" src="static/js/common.js"></script>
</body>
</html>

