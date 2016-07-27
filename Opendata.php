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
	<link href="css/bootstrap.css" rel="stylesheet">
	<!--Tooltip func -->
	<script> 
		$(function() {
			$('[data-tooltip="true"]').tooltip();
		});
			// popover
		$(document).ready(function(){
			$('[data-toggle="popover"]').popover();   
		});
	</script>
	<!-- end of tooltip func -->

	<!-- Database -->
	<?php
		$conn = mysql_connect("localhost", "dante", "");
		mysql_select_db("opendata") or die("無法連接資料庫時顯示的訊息");
		mysql_query(" set names UTF8");  	
		mysql_query(" SET CHARACTER SET  'UTF8'; ");
		mysql_query('SET CHARACTER_SET_CLIENT=UTF8; ');  
		mysql_query('SET CHARACTER_SET_RESULTS=UTF8; ');
		$data=mysql_query("select * from catch where number = '1' ");
		$rs =mysql_fetch_row($data);
		
		$sql = "select max(times) from organization"; 
		$rs0 = mysql_query($sql); 
		$max = mysql_fetch_array($rs0);
		$data3=mysql_query("select * from organization where times = '$max[0]' ");
		$rs3=mysql_fetch_row($data3);
		
		$sql1 = "select max(avetime) from organization"; 
		$rs4 = mysql_query($sql1); 
		$max2 = mysql_fetch_array($rs4);
		$data4=mysql_query("select * from organization where avetime = '$max2[0]' ");
		$rs5=mysql_fetch_row($data4);
		
		$sql2 = "select min(avetime) from organization"; 
		$rs6 = mysql_query($sql2); 
		$max3 = mysql_fetch_array($rs6);
		$data5=mysql_query("select * from organization where avetime = '$max3[0]' ");
		$rs7=mysql_fetch_row($data5);
	?>
	<!--Database -->
</head>
	
<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">
	<div class="page-container">
	<!-- header -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	<div class="navbar-header "  >
           <a class="navbar-brand">Open Data</a>
    	</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href=" ">   </a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">Try it</a></li>
		</ul>
    </nav>
	<!-- end of header -->
    
    <div class="container" style="margin-top:0px; ">

        <!-- sidebar -->
        <nav class="col-md-2 " id="sidebar" role="navigation" >
            <ul class="nav  nav-pills nav-stacked " data-spy="affix" >
			<div class="table-responsive">
              <tr><li class="active"><a href="#home"><img src="materials\image\00.png" width="18%"  ></a></li></tr>
              <tr><li><a href="#static "><img src="materials\image\01.png" width="18%" ></a></li></tr>
              <tr><li><a href="#compare"><img src="materials\image\02.png" width="18%" ></a></li></tr>
              <tr><li><a href="#about"><img src="materials\image\03.png" width="18%" ></a></li></tr>
			</div>
			</ul>
			
        </nav>
		<!-- end of sidebar -->
        <!-- main area -->
		<div class="col-md-10" >
			<span class="anchor" id="home"></span>
			<div class="panel panel-primary"  >
			<div class="panel-body">
				<h1>"我還想要..."平台<br></h1> 
				<h3>由台灣政府所提供的<a href="http://data.gov.tw/suggest_page">"我還想要..."</a>平台提供民眾向政府提出要求，<br>
				讓政府所提供的Open Data更符合人們的需求。<br>
				另外也開放民眾察看他人所提出之要求，讓資料公開透明，符合Open Data的本質。
				這個網頁針對"我還想要..."平台做了一些基本的分析<br>
				讓大家可以了解依些關於"我還想要..."平台上的一些資訊
				</h3>
			</div></div><!-- /.panel -->
			
			<span class="anchor" id="static"></span>
			<div class="panel panel-primary" >
			<div class="panel-heading"><h3>統計資料</h3></div>
			<div class="panel-body"><h3>
				<div class="alert alert-success" role="alert">總統計</div>
				資料總數共有<?php echo $rs[1] ?>筆<br><br>
				有<?php echo $rs[2] ?>筆資料已經有正式回應
				<a data-toggle="popover" title="正式回應-僅統計已由負責回覆之資料" data-content="因為政府資料開放平台在收到資料請求後，會先由平台工作人員回應告知已分派至對應機關，日後再由待對應機關正式回應。所以此項目只針對對應機關已經回覆的資料作統計。"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
				，佔 <?php $percent= 100*$rs[2]/$rs[1]; echo round($percent,2) ?>%
				<br><br>
				有<?php echo $rs[3] ?>筆資料尚未回應，佔 <?php $percent2= 100*$rs[3]/$rs[1]; echo round($percent2,2) ?>%<br><br>
				平均回應時間為<?php echo $rs[4] ?>天<br><br>
				回應時間統計圖表：<br>
				<div id="chart0" style="height: 300px; width: 100%;"></div>
				<br>
				<div class="alert alert-success" role="alert" >平台回應統計 <a data-toggle="popover" title="平台回應" data-content="針對政府資料開放平台處理與分派需求的狀況分析。"><span class="glyphicon glyphicon-question-sign" style="color:green"" aria-hidden="true"></span></a></div>
				<div>
					<br>
					有  <?php echo $rs[5] ?> 筆資料尚未回覆<br><br>
					最久 <?php echo $rs[6] ?> 天未回覆<br><br>
					最久未回覆的資料為  "<?php echo $rs[7] ?>"
					<br><br>
				</div><!-- collapse -->
			</h3></div></div><!-- /.panel -->
			
			<span class="anchor" id="compare"></span>
			<div class="panel panel-primary" >
			<div class="panel-heading"><h3>比較資料</h3></div>
			<div class="panel-body"><h3>
				<div class="alert alert-warning" role="alert" data-target="#org-count">各機關問題統計</div>
				<div id="org-count" >
					最多資料："<?php echo $rs3[1] ?>"，共 <?php echo $rs3[2] ?>筆資料。<br><br>
					資料數量統計圖：<br>
					<center><div id="chart1" style="height: 400px; width: 100%;"></div></center>
				</div>
				<br><br>
				<div class="alert alert-warning" role="alert"  data-target="#org-reply-time">各機關回覆速度統計</div>
				<div id="org-reply-time" >
					回覆速度最快："<?php echo $rs7[1] ?>"，平均 <?php echo round($rs7[4],2) ?>天。<br>
					回覆速度最慢："<?php echo $rs5[1] ?>"，平均 <?php echo round($rs5[4],2) ?>天。<br><br>
					回應時間統計圖：<br>
					<center><div id="chart2" style="height: 400px; width: 100%;"></div></center>
				</div>
			</h3></div></div><!-- /.panel -->
			
			<span class="anchor" id="about"></span>
			<div class="panel panel-primary" >
			<div class="panel-heading"><h4>關於我們</h4></div>
			<div class="panel-body"><h4>
				Develope By Jeffrey Hung, NCHU MIS<br>
				Contect Us,  Email : jeffreyhung@hotmail.com.tw  <a href="mailto:jeffreyhung@hotmail.com.tw"><span class="glyphicon glyphicon-envelope"></span></a>
				<br><br>
				Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>             is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a>
				<br>
				Icon provided by <a href="http://glyphicons.com/" title="Glyphicons">Glyphicons</a>
				<br>
				Charts support by <a href="http://canvasjs.com/" title="Canvasjs">CanvasJS.com</a>
			</h4></div></div>
			<!-- /.panel -->
		</div>
		
		<!-- end of main area -->
		

	</div><!--/.container-->
  
</div>	<!--/.page-container-->
</body> 
</html>