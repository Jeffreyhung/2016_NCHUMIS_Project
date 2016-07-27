<?php
	header('Content-Type: application/json');
	$con =  mysql_connect("localhost", "dante", "");
	mysql_select_db("opendata") or die("無法連接資料庫時顯示的訊息");
	mysql_query(" set names 'UTF8'");  	
	mysql_query(" SET CHARACTER SET  'UTF8'; ");
	mysql_query('SET CHARACTER_SET_CLIENT=UTF8; ');  
	mysql_query('SET CHARACTER_SET_RESULTS=UTF8; ');
	$data_points = array();
	$result = mysql_query("select * from organization");
	while($row = mysql_fetch_array($result))
	{        
		$point = array("y" => round($row['avetime']) , "indexLabel" => $row['orgname'] );
		array_push($data_points, $point); 
	}
	echo json_encode($data_points, JSON_NUMERIC_CHECK);
	mysql_close($con);		
?>