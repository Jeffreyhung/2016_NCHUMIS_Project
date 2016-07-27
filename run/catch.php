<?php
	ignore_user_abort();
	set_time_limit(0);
	
	$conn = mysql_connect("localhost", "dante", "");
	mysql_select_db("opendata") or die("無法連接資料庫時顯示的訊息");
	mysql_query(" set names 'UTF8'");  	
	mysql_query(" SET CHARACTER SET  'UTF8'; ");
	mysql_query('SET CHARACTER_SET_CLIENT=UTF8; ');  
	mysql_query('SET CHARACTER_SET_RESULTS=UTF8; ');
	$data=mysql_query("select * from catch where number = '1' ");
	$rs=mysql_fetch_row($data);
	
	$url = "http://data.gov.tw/suggest_page/json";// dataset_sug.json
	$json = file_get_contents($url);
	$json = removeBOM($json);
	file_put_contents("data/opendata.json",$json);
	$json=json_decode($json , true);
	function removeBOM($str = '')
	{
		if (substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf))
			$str = substr($str, 3);
		return $str;
	}
	$length = count($json);

	// Static
	$formal_reply =0;
	$non_reply = 0;
	$ave_reply = 0;
	$plat_nonreply = 0;
	$plat_maxreply = 0;
	$gap = 0;
	$plat_maxreply_title = 0;
	$today = strftime("%Y-%m-%d");
	$one=0;
	$three=0;
	$seven=0;
	$thirty=0;
	$sixmonth=0;
	$oneyear=0;
	$longtime=0;
	for($i=0; $i<$length; $i++)
	{
		if($json[$i]['suggestReplyCount']>1)
		{
			$formal_reply++;
			$gap = strtotime($json[$i]['suggestLastReplyTime']) - strtotime($json[$i]['suggestDate']);
		}
		else if($json[$i]['suggestReplyCount']==1)
		{
			$non_reply++;
			$gap = strtotime($today) - strtotime($json[$i]['suggestDate']);
		}
		else if($json[$i]['suggestReplyCount']==0)
		{
			
			$plat_nonreply++;
			$gap = strtotime($today) - strtotime($json[$i]['suggestDate']);
			if($gap > $plat_maxreply)
			{
				$plat_maxreply = $gap;
				$plat_maxreply_title = $json[$i]['suggestTitle'];
			}
			
		}
		$ave_reply+=$gap;
		$daygap = $gap /86400;
		if( $daygap <=1)
			$one++;
		else if($daygap >1 && $daygap <=3)
			$three++;
		else if($daygap >3 && $daygap <=7)
			$seven++;
		else if($daygap >7 && $daygap <=30)
			$thirty++;
		else if($daygap >30 && $daygap <=180)
			$sixmonth++;
		else if($daygap >180 && $daygap <=365)
			$oneyear++;
		else
			$longtime++;
	}
	$ave_reply = $ave_reply / 86400;
	$ave_reply = $ave_reply / $length;
	$plat_maxreply = $plat_maxreply / 86400;
	$str = "UPDATE catch SET length = '$length', formalreply = '$formal_reply', nonreply = '$non_reply', avereply ='$ave_reply', platnonreply = '$plat_nonreply', platmaxreply = '$plat_maxreply', platmaxreplytitle = '$plat_maxreply_title' where number = 1";
	mysql_query($str);
	$bla0 = "UPDATE time SET times = '$one' where no = 0 ";
	$bla1 = "UPDATE time SET times = '$three' where no = 1 ";
	$bla2 = "UPDATE time SET times = '$seven' where no = 2 ";
	$bla3 = "UPDATE time SET times = '$thirty' where no = 3 ";
	$bla4 = "UPDATE time SET times = '$sixmonth' where no = 4 ";
	$bla5 = "UPDATE time SET times = '$oneyear' where no = 5 ";
	$bla6 = "UPDATE time SET times = '$longtime' where no = 6 ";
	mysql_query($bla0);
	mysql_query($bla1);
	mysql_query($bla2);
	mysql_query($bla3);
	mysql_query($bla4);
	mysql_query($bla5);
	mysql_query($bla6);

	//compare
	$str0 = "DELETE FROM `organization` WHERE 1";
	mysql_query($str0);

	$level=0;
	$update =0;
	$gap2 =0;
	$avegap =0;
	for($i=0; $i<$length; $i++)
	{
		$data3 = mysql_query("select * from organization");
		$row=mysql_num_rows($data3);
		$level=0;
		if($json[$i]['suggestReplyCount']>1)
		{
			$name = $json[$i]['deliverOrg'];
			$gap2 = strtotime($json[$i]['suggestLastReplyTime']) - strtotime($json[$i]['suggestDate']);
			$gap2= $gap2/86400;
			for($j=0; $j<$row; $j++)
			{
				$data4=mysql_query("select * from organization where ID = '$j' ");
				$rs4=mysql_fetch_row($data4);
				if( $rs4[1] == $json[$i]['deliverOrg'])
				{
					$update = $rs4[2] + 1;
					$level = 1;
					$gap2 += $rs4[3];
					$avegap = $gap2 / $update;
					$str4 = "UPDATE organization SET times = '$update', orgavereply = '$gap2', avetime = '$avegap' where orgname = '$name'";
					mysql_query($str4);
					break;
				}
			}
			if( $level == 0)
			{
				mysql_query("INSERT INTO  organization (ID,orgname,times,orgavereply,avetime)VALUES ('$j','$name', '1','$gap2','$gap2'); ");
			}
		}
	}
?>
