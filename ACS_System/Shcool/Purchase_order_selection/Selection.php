<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>注文書選択</title>
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
<style type="text/css">/* テーブル内のスタイルを定義 */
.list{
	border-collapse: collapse;
}
.list th{
	background-color: #cccccc;
	border-style: solid;
	border-width: 1px;
	font-size: 18px;
}
.list td{
	border-style: solid;
	border-width: 1px;
	font-size: 18px;
}

div.over01{
	font-size: 20px;
	width: 200px;
	height: 40px;
	overflow: auto;
	display:table-cell;
    text-align:center;
    vertical-align:middle;
}

div.over02{
	width: 300px;
	height: 40px;
	overflow: auto;
}
</style>
</head>
<body>
<?php
	require '../../DB.php';			//DB.php呼び出し
?>
<div id="header">
	<div id="top">
		<input type="button" name="top" value="TOP" onclick="location.href='/acs_system/Shcool/School_Home.php'" />
	</div>
	<div id="login_name"><?php echo $_SESSION['user_name'];?>さん</div>
</div>
<div id="select_menu" style="clear:left;">
	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../Login/Logout.php">ログアウト</a></li>
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
				<li><a href="Document_Browsing/Image_selection.php">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="progress/Purchase_order_selection.php">進捗管理</a></li>
			</ul>
		</li>
	</ul>
</div>
<?php
	$user_id = $_SESSION['user_id'];	//ログイン中の人のユーザID
	//注文ID, 日付, 品名, 備考を検索
	$sql = "SELECT t1.tm_id, t1.t_date, h1.hin_janru, t1.t_bikou
			FROM (tyuumon t1 inner join tyuumon_master t2 on t1.tm_id = t2.tm_id)
				inner join hinmei h1 on t1.t_hin_name = h1.hin_id
			WHERE t2.tm_hattyu_flg = false and t2.tm_sakujo_flg = false and t2.user_id = ".$user_id
			. " ORDER BY t1.t_date DESC";
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute();
	//案件数を検索
	$result_count = $pdo->prepare($sql);
	$result_count->execute();
	$result_count01 = $result_count->fetchAll();
  	$count = count($result_count01);
?>
<div id="main">
	<div id="border"></div>
	<div id="title">注文書選択</div>

	<div style="width:250px; height:25px; border-style: solid; border-width: 1px; margin-top: 20px; margin-right: 860px; margin-left:60px; padding:10px;" align="center">
		<font size="5">保存中の注文書一覧</font>
	</div>
	<table id="purchase_list" class="list" style="width:700px; height:20px; border-style: solid; border-width: 1px; margin-button: 40px; margin-right: 60px; margin-left: 60px; padding:10px;" align="left">
		<tr style="border-style: solid; border-width: 1px;" align="center">
			<th style="width:200px;">作成日</th>
			<th style="width:200px;">品名</th>
			<th style="width:300px;">備考</th>
		</tr>
		<?php
			while($SQL = $result_sql->fetch(PDO::FETCH_ASSOC)){//検索結果を表示
				echo "<tr><td><div class=\"over01\">" .date('Y年　m月　d日', strtotime($SQL['t_date'])) ."</div></td>";
				echo "<td><div class=\"over01\"><a href=\"Confirmation_success.php?id=" .$SQL['tm_id'] ."\">" .$SQL['hin_janru'] ."</div></td>";
				echo "<td><div class=\"over02\">" .$SQL['t_bikou'] ."</div></td></tr>";
			}
			if($count < 10){//案件が10件以下の場合、10件までリスト挿入
				while($count < 10){
					echo "<tr><td><div class=\"over01\" /></td><td><div class=\"over01\" />なし</td><td><div class=\"over02\"></td></tr>";
					$count++;
				}
			}
			// db切断
			$pdo = null;

			?>
	</table>
</div>
</body>
</html>