<!DOCTYPE html>
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
	<script src="js/CKIP_Client.js"></script><!-- CKIP -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<?php 
		session_start();
	?>
</head>
<body>
<div class="page-container">
	<!-- header -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	<div class="navbar-header "  >
           <a class="navbar-brand">Open Data</a>
    	</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">登出</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="">Hi~ <?php  echo $_SESSION['user'];  ?></a></li>
		</ul>
    </nav>
	<!-- end of Header -->
	
	<!-- body  -->
	<div class="container" style="margin-top:0px; ">
	<h1><center><b>分類套件 測試系統</b></center></h1>
	<center>
	<h4>
		這是一個政府開放資料平台 "我還想要"專區 模擬網頁<br>
		以"我還想要"專區內的資料為基礎，透過比對關鍵字與每筆資料的分派機關<br>
		我們找出了關鍵字與分派機關的關聯性，並將之運用於還未分類的資料上<br>
		在這個網頁上，你可以透過手動輸入資料，來尋找該資料應該對應到的分派機關
    </h4>
	</center>
	</div><!--/.container-->
	<!-- 資料輸入表格 -->
	<div class="container" style="margin-top:0px; ">
	<form class="form-horizontal" role="form" id="test-data" method="link" action="Classify_result.php">
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">建議資料集名稱：</label>
			<div class="col-sm-10">
				<Input type="text" class="form-control" name="title" placeholder="資料集名稱">	
			</div>
		</div>
		<div class="form-group">
			<label for="coloum" class="col-sm-2 control-label">建議開放的欄位</label>
			<div class="col-sm-10">
				<Input type="text" class="form-control" name="coloum" placeholder="開放的欄位">
			</div>
		</div>
		<div class="form-group">
			<label for="reason" class="col-sm-2 control-label">建議原因</label>
			<div class="col-sm-10">
				<textarea type="text" class="form-control" name="reason" rows="6"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="確定" class="btn btn-default" id="btn_func" />
			</div>
		</div>
	</form>
	<!-- 資料輸入表格 -->
	</div><!--/.container-->
</body>
</html>

