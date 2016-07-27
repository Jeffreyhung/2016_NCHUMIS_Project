<?php
	require_once 'src/Google_Client.php';
	require_once 'src/contrib/Google_Oauth2Service.php';
	session_start();
	//建立apiClient
	$client = new Google_Client();
	//建立Oauth2 Service
	$oauth2 = new Google_Oauth2Service($client);
	//處理回傳的code
	if (isset($_GET['code'])) {
		$client->authenticate();
		$_SESSION['token'] = $client->getAccessToken();
		$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	}
	//設定Token
	if (isset($_SESSION['token'])) {
		$client->setAccessToken($_SESSION['token']);
	}
	//取消Session
	if (isset($_REQUEST['logout'])) {
		unset($_SESSION['token']);
		$client->revokeToken();
	}
	if ($client->getAccessToken()) {
		if($client->isAccessTokenExpired()) {
			$authUrl = $client->createAuthUrl();
			header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
			}
		$user = $oauth2->userinfo->get();
		//再取得一次Token
		$_SESSION['token'] = $client->getAccessToken();
	} 
	else{
	  $authUrl = $client->createAuthUrl();
	}
	$_SESSION['user']=$user['name'];
	$_SESSION['platform']='google';
	header("Refresh:0; url=http://localhost/phpmyadmin/Project/Classify.php");
?>