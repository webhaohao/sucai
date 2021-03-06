<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content="always" name="referrer">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>用户注册-{$_G['setting']['site_name']}</title>
	<base href="{$_G['site_url']}">
	<script src="static/js/jquery-3.3.1.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/common.css">
	<link rel="stylesheet" type="text/css" href="static/css/signin.css">
	<style>
		html,body{ width: 100%; height: 100%; background: rgba(0, 255, 255, 0.3); }
		html{-webkit-tap-highlight-color: rgba(0, 0, 0, 0);}
		canvas{display:block;vertical-align:bottom;}
		#particles{ width: 100%; height: 100%; background-color: rgba(0, 0, 255, 0.6);position: absolute; left: 0; top: 0;right: 0;bottom: 0; z-index:-1;}
	</style>
</head>
<body class="text-center">
	<div id="particles"></div>
	{if !$_G['setting']['allow_register']}
		<div class="form-signin">
			<div class="card">
			    <div class="card-header">阿哦~注册通道已关闭</div>
			    <div class="card-body">
			    	<p>抱歉，目前暂时关闭自助注册通道。</p>
			    	{if $_G['setting']['qq']}
			    		<p>需要开户请联系QQ：<span class="badge badge-success">{$_G['setting']['qq']}</span></p>
			    	{/if}
			    </div>
			</div>
		</div>
	{else}
		<form class="form-signin" autocomplete="off">
			<h2 class="mb-3 font-weight-normal text-light">用户注册</h2>
			<input type="text" class="form-control" name="username" placeholder="账号名称" required autofocus style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-bottom: 0;">
			<input type="password" class="form-control" name="password" placeholder="登录密码" required style="border-bottom: 0;border-top-right-radius: 0;border-bottom-left-radius: 0;border-bottom-right-radius: 0;">
			<input type="password" class="form-control" name="password_confirm" placeholder="重复密码" required style="border-top-left-radius: 0;border-top-right-radius: 0;">
			<button class="btn btn-lg btn-danger btn-block btn-submit ajax-post mt-3" type="submit">注 册</button>
			<div class="d-flex justify-content-between mt-3">
				<a class="text-light" href="{:url('index/account/login')}"><<返回登录</a>
				<a class="text-light" href="{:url('index/account/get_password')}">找回密码</a>
			</div>
			<div class="mt-3 text-light">&copy; 2019-2099</div>
		</form>
	{/if}
	<script type="text/javascript" src="static/js/common.js"></script>
	<script type="text/javascript" src="static/js/particles.min.js"></script>
	<script type="text/javascript">
		$(function(){
			particlesJS('particles',
			  {
			    "particles": {
			      "number": {
			        "value": 80,
			        "density": {
			          "enable": true,
			          "value_area": 800
			        }
			      },
			      "color": {
			        "value": "#ffffff"
			      },
			      "shape": {
			        "type": "circle",
			        "stroke": {
			          "width": 0,
			          "color": "#000000"
			        },
			        "polygon": {
			          "nb_sides": 5
			        },
			        "image": {
			          "src": "img/github.svg",
			          "width": 100,
			          "height": 100
			        }
			      },
			      "opacity": {
			        "value": 0.5,
			        "random": false,
			        "anim": {
			          "enable": false,
			          "speed": 1,
			          "opacity_min": 0.1,
			          "sync": false
			        }
			      },
			      "size": {
			        "value": 5,
			        "random": true,
			        "anim": {
			          "enable": false,
			          "speed": 40,
			          "size_min": 0.1,
			          "sync": false
			        }
			      },
			      "line_linked": {
			        "enable": true,
			        "distance": 150,
			        "color": "#ffffff",
			        "opacity": 0.4,
			        "width": 1
			      },
			      "move": {
			        "enable": true,
			        "speed": 6,
			        "direction": "none",
			        "random": false,
			        "straight": false,
			        "out_mode": "out",
			        "attract": {
			          "enable": false,
			          "rotateX": 600,
			          "rotateY": 1200
			        }
			      }
			    },
			    "interactivity": {
			      "detect_on": "canvas",
			      "events": {
			        "onhover": {
			          "enable": false,
			          "mode": "repulse"
			        },
			        "onclick": {
			          "enable": true,
			          "mode": "push"
			        },
			        "resize": true
			      },
			      "modes": {
			        "grab": {
			          "distance": 400,
			          "line_linked": {
			            "opacity": 1
			          }
			        },
			        "bubble": {
			          "distance": 400,
			          "size": 40,
			          "duration": 2,
			          "opacity": 8,
			          "speed": 3
			        },
			        "repulse": {
			          "distance": 200
			        },
			        "push": {
			          "particles_nb": 4
			        },
			        "remove": {
			          "particles_nb": 2
			        }
			      }
			    },
			    "retina_detect": true,
			    "config_demo": {
			      "hide_card": false,
			      "background_color": "#b61924",
			      "background_image": "",
			      "background_position": "50% 50%",
			      "background_repeat": "no-repeat",
			      "background_size": "cover"
			    }
			  }

			);
		})
	</script>
</body>
</html>
