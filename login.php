<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/canvasjs.min.js"></script>
    <script src="js/bootstrap.min.js"></script><!-- bootstrap -->
	<script src="js/chart.js"></script><!--Pie chart -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- login Oauth -->
	<?php
		session_start();
		if ($_SESSION['user'] != "")
		{
			if($_SESSION['platform']=='fb'){
				header("Refresh:0; url=http://localhost/phpmyadmin/Project/Classify.php");
			}
			else if($_SESSION['platform']=='google'){
				header("Refresh:0; url=http://localhost/phpmyadmin/Project/Classify_goo.php");
			}
					
		}else{
		$_SESSION['user']="";
		$_SESSION['platform']="";
		}
		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
		$app_id_FB = "1559037094408811";
		$redirect_url_fb = "http://localhost/phpmyadmin/Project/login_fb.php";
		$FB_login_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id_FB .
					"&redirect_uri=" . urlencode($redirect_url_fb) . 
					"&state=" . $_SESSION['state'] . 
					"&scope=email";
	
	// end of FB login
	// Google login Oauth

		$app_id_goo = "824524650794-h8fk0bqdvcg1fv4ni216f55r93dvj4l3.apps.googleusercontent.com";
		$redirect_url_goo = "http://localhost/phpmyadmin/Project/login_goo.php";
		$Goo_login_url = "https://accounts.google.com/o/oauth2/auth?response_type=token&client_id=" . $app_id_goo .
					"&redirect_uri=" . urlencode($redirect_url_goo) . 
					"&scope=https://www.googleapis.com/auth/userinfo.profile"
	
	?>
	
	<!-- end of  login -->
	
</head>
<body>
<div class="page-container">
	<!-- header -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	<div class="navbar-header "  >
           <a class="navbar-brand">Open Data</a>
    	</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="Opendata.php">Home</a></li>
		</ul>

    </nav>
	<div class="container" >
	<center>
	<div class="alert alert-danger">
		<strong>請先登入</strong>
		<br>
		請先登入以取得更多功能
		<br><br>
		<a href="<?php echo $FB_login_url;?>" class="btn btn-default" role="button">Facebook Login</a></li>
		</button>
		<br><br>
		<a href="<?php echo $Goo_login_url;?>" class="btn btn-default" role="button">Google Login</a></li>
	</div>
	</center>
	</div>
</body>
</html>