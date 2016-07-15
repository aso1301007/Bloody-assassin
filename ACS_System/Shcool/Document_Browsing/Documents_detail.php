<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=../../css.css>



<title>書類閲覧</title>


<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($){

	$("#menu li").hover(function() {
		$(this).children('ul').show();
		//window.alert('キャンセルされました');
	}, function() {
		$(this).children('ul').hide();
		//window.alert('キャンセルされました');
	});

});


</script>


</head>

<body>

<?php

session_start();

require_once '../../DB.php';



/*//-----前ページで指定された注文書のID受け取り-----
*/
//$_SESSION['eturan_tm_id']=$_POST['eturan_tm_id'];
//$tm_id=$_SESSION['eturan_tm_id'];
//---------------------------------------
$tm_id=1;


//------ユーザ名取得---------
$user_name=$_SESSION['user_name'];
//$user_name="高塚";

//-----------------------------


//-----------日付と注文書名の取得---------------------
$sql = "SELECT *FROM ((((tyuumon TY INNER JOIN hinmei HI ON TY.hin_id = HI.hin_id)
				INNER JOIN gazou G ON TY.tm_id = G.tm_id)
				INNER JOIN houkoku HK ON TY.tm_id = HK.tm_id)
				INNER JOIN gakubu GK ON GK.gakubu_id=TY.gakubu_id)
				WHERE TM.tm_id =?";
$data = $pdo->prepare($sql);
$data ->execute(array($tm_id));//要らないかも？
//print $sql1;


//SELECTでとってきた値を格納
while($row = $data -> fetch(PDO::FETCH_ASSOC)){
//	print "a";
//	print_r($row1);
		$t_date = $row['t_date'];
		$t_naiyou = $row['t_naiyou'];
		$hin_janru = $row['hin_janru'];

}






echo <<<EOT

<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name">$user_name さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../../Login/Logout.php">ログアウト</a></li>
			</ul>
		</li>
		<li>注文機能
			<ul style="list-style:none;">
				<li><a href="#">新規注文書</a></li>
				<li><a href="#">注文書選択</a></li>
			</ul>
		</li>
		<li>書類
			<ul style="list-style:none;">
				<li><a href="#">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="#">進捗管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<div id="main">
<div id="border"></div>

<div id="title"><a>書類閲覧</a></div>


<div id="syorui">
EOT;
//注文書名を出力
echo $t_date."  ・  " .$t_naiyou."  ・  " .$hin_janru;

echo <<<EOT
</div>


<div id="img1">
EOT;
//進捗を判定して画像貼り付け

?>

</div>




	<table>
		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ1  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open01').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼注文書</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open01" style="display:none;clear:both;">
				<?php
					while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
						echo $sql01['t_date'], "　・　", $sql01['hin_janru'], "　・　", $sql01['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ1  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ1  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open01').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼画像</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open01" style="display:none;clear:both;">
				<?php
					while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
						$img=$sql01['gazou_path'];
						echo "<img border='0' src=',$img,' width='140px' height='120px' alt='画像'>";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ1  -->

	</table>
</div>
</body>
</html>