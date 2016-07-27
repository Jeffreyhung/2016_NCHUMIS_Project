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
		$title=null;
		$coloum=null;
		$reason=null;
		if($_GET["title"]){
			$title = $_GET["title"];
		}
		if($_GET["coloum"]){
			$coloum = $_GET["coloum"];
		}
		if($_GET["reason"]){
			$reason = $_GET["reason"];
		}
		
		// CKIP
		require_once "src/CKIPClient.php";
		define("CKIP_SERVER", "140.109.19.104");
		define("CKIP_PORT", 1501);
		define("CKIP_USERNAME", "4102029006");
		define("CKIP_PASSWORD", "22680706");
		$ckip_client_obj = new CKIPClient(
		   CKIP_SERVER,
		   CKIP_PORT,
		   CKIP_USERNAME,
		   CKIP_PASSWORD
		);
		$raw_text = $title . $coloum . $reason;
		$return_text = $ckip_client_obj->send($raw_text);
		$return_sentence = $ckip_client_obj->getSentence();
		$return_term = $ckip_client_obj->getTerm();
		$keyword = "";
		$all = "";
		$i;
		$k = 0;
		$long = sizeof($return_term);
		$array = array();
		for($i=0;$i<$long;$i++){
			if($return_term[$i]['tag'] == "N"){
				$keyword = $keyword . $return_term[$i]['term'] . "，";
				$all = $all  . $return_term[$i]['term'] . " | ";
				$array[$k] = $return_term[$i]['term'];
				$k++;
			}else if($return_term[$i]['tag'] == "Nv"){
				$keyword = $keyword . $return_term[$i]['term']. "，";
				$all = $all  . $return_term[$i]['term'] . " | ";
				$array[$k] = $return_term[$i]['term'];
				$k++;
			}
			else if($return_term[$i]['tag'] == "Na"){
				$keyword = $keyword . $return_term[$i]['term']. "，";
				$all = $all  . $return_term[$i]['term'] . " | ";
				$array[$k] = $return_term[$i]['term'];
				$k++;
			}else{
				$all = $all  . $return_term[$i]['term'] . " | ";
			}
		}
		$permant = array();
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
				<Input type="text" class="form-control" name="title" value=<?php echo $title ?>>	
			</div>
		</div>
		<div class="form-group">
			<label for="coloum" class="col-sm-2 control-label">建議開放的欄位</label>
			<div class="col-sm-10">
				<Input type="text" class="form-control" name="coloum" value= <?php echo $coloum ?>>
			</div>
		</div>
		<div class="form-group">
			<label for="reason" class="col-sm-2 control-label">建議原因</label>
			<div class="col-sm-10">
				<textarea type="text" class="form-control" name="reason" rows="6"><?php echo $reason ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" value="確定" class="btn btn-default"  id="button" />
			</div>
		</div>
	</form>
	<!-- 資料輸入表格 -->
	</div><!--/.container-->
	<!-- 結果顯示 -->
	<div class="container" style="margin-top:0px; ">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title">斷詞結果</h3>
		  </div>
		  <div class="panel-body" id="result">
			<?php echo $all ?>
		  </div>
		  <div class="panel-heading">
			<h3 class="panel-title">關鍵字</h3>
		  </div>
		  <div class="panel-body" id="result">
			<?php echo $keyword ?>
		  </div>
		  <div class="panel-heading">
			<h3 class="panel-title">建議分派機關</h3>
		  </div>
		  <div class="panel-body" id="result">
			<?php 
				$cmdx = 'java -Dfile.encoding=UTF-8 -jar run\for_php.jar ';
				$output = shell_exec($cmdx.urlencode($keyword));
				echo $output;
			?>
		  </div>
		</div>
	</div>
</body>
</html>

