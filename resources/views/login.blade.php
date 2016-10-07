<html>
<head>
<title>Next Login Admin Login</title>
<!-- Latest compiled and minified CSS -->
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<style type="text/css">
	body {
		color: #555;
	}
	#loginBox {
		transform: translateY(100px) scale(.5);
		opacity: 0;
		transition: .5s all ease;
	}
	.vertical-offset-100{
	    padding-top:100px;
	}
	#joyPopper {
		position: absolute;
		top: 0;
		left: 0;
	}
	.btn-success {
		background-color: #9E9AC9;
		border-color: #9491BD;
	}
	.btn-success:hover {
		background-color: #9491BD;
		border-color: #8A87B0;
	}
	.btn-success:focus, .btn-success:active, .btn-success:active:focus {
		background-color: #8A87B0;
		border-color: #807DA3;
	}
	.alert {
		padding-top: 5px;
		padding-bottom: 5px;
	}
</style>
</head>
<body>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

<canvas id="joyPopper"></canvas>
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default" id="loginBox">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			  		@if($errors->any())
			  		<div class="alert alert-danger">
			  			<i class="glyphicon glyphicon-exclamation-sign"></i> {{ $errors->first() }}
			  		</div>
			  		@endif
			    	<form accept-charset="UTF-8" role="form" action="{{ url('/login') }}" method="POST">
			    	{{ csrf_field() }}
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox" style="display:none;">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery -->
<script src="{{ asset('/js/vendor/jquery-1.11.2.min.js') }}"></script>
<script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
<script src="https://code.createjs.com/tweenjs-0.6.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#loginBox").css('opacity', 1).css('transform', 'translateY(0)');

		var canvas = $('#joyPopper');
		var width = $('body').outerWidth();
		var height = $('body').outerHeight();
		canvas.attr('width', width);
		canvas.attr('height', height);

		var stage = new createjs.Stage('joyPopper');
		createjs.Ticker.setFPS(60);
		createjs.Ticker.addEventListener('tick', stage);
		var bg = new createjs.Shape();
		bg.graphics.beginLinearGradientFill(
			['#B6B6D8', '#7465AD'],
			[.1, .9],
			0, 0,
			0, height
		);
		bg.graphics.drawRect(0, 0, width, height);
		stage.addChild(bg);

		function addCircle() {
			var x = Math.random() * width;
			var y = Math.random() * height;
			var circle = new createjs.Shape();
			circle.graphics.beginFill('#9E9AC9').drawCircle(0, 0, 1);
			circle.x = x;
			circle.y = y;
			stage.addChild(circle);
			createjs.Tween.get(circle)
			  .to({alpha:0, scaleX:50, scaleY:50}, 6000);
			circle = undefined;
		}

		setInterval(addCircle, 500);
	});
</script>
</body>
</html>