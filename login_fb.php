<?php
	//  Facebook login Oauth
	$app_id = "1559037094408811"; 
	$app_secret = "1be8dbbd04d550920f269d8b8cbdebf6"; 
	$redirect_url = "http://localhost/phpmyadmin/Project/login_fb.php"; 
	$code = $_REQUEST["code"];
	session_start();
	if($_SESSION['user'] != ''){
		
	}else{
		if(empty($code)) 
		{
			header( 'Location: http://localhost/phpmyadmin/Project/Opendata.php' ) ;
			exit(0);
		}
		$access_token_details = getAccessTokenDetails($app_id,$app_secret,$redirect_url,$code);
		if($access_token_details == null)
		{
			echo "Unable to get Access Token";
			exit(0);
		}   
		if($_SESSION['state'] == null || ($_SESSION['state'] != $_REQUEST['state'])) 
		{
			die("May be CSRF attack");
		}
		$_SESSION['access_token'] = $access_token_details['access_token']; //save token is session 
		$user = getUserDetails($access_token_details['access_token']);	
		$_SESSION['user']=$user->name;
	}
	function getAccessTokenDetails($app_id,$app_secret,$redirect_url,$code)
		{
			$token_url = "https://graph.facebook.com/oauth/access_token?"
			. "client_id=" . $app_id . "&redirect_uri=" . urlencode($redirect_url)
			. "&client_secret=" . $app_secret . "&code=" . $code;

			$response = file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);
			return $params;
		}
		function getUserDetails($access_token)
		{
			$graph_url = "https://graph.facebook.com/me?access_token=". $access_token;
			$user = json_decode(file_get_contents($graph_url));
			if($user != null && isset($user->name))
				return $user;
		}
	$_SESSION['user'] = $user->name;
	$_SESSION['platform']='fb';
	header("Refresh:0; url=http://localhost/phpmyadmin/Project/Classify.php");
?>
	<!-- end of FB login -->