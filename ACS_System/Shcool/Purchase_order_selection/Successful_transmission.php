<?php session_start()?>
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
</head>
<body>
<div id="header">
	<input type="button" name="top" value="TOP" onclick="location.href='School_Home.php'"/>
	<div id="login_name"><?php $_SESSION['user_name'];?>さん</div>
</div>
<div id="select_menu" style="clear:left;">
	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../Login/Logout.php">ログアウト</a></li>
			</ul>
		</li>
		<li>注文書
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
<div id="main">
	<div id="border"></div>
	<div id="title">送信結果</div>
<?php
	require '../../DB.php';			//DB.php呼び出し
?>
<?php
$id = $_REQUEST['id'];//注文ID
$sql = "SELECT t1.t_tantousha, t2.tm_seisakubutu
			FROM tyuumon t1 inner join tyuumon_master t2 on t1.tm_id = t2.tm_id
			WHERE t1.tm_id = ". $id;
$result_sql = $pdo->prepare($sql);
$result_sql->execute();
$SQL = $result_sql->fetch(PDO::FETCH_ASSOC);
//ACS社員2人のアドレス検索
$sql02 = "SELECT *
			FROM user
			WHERE user_kubun = 'ACS社員'";
$result_sql02 = $pdo->prepare($sql02);
$result_sql02->execute();

// 1.言語、文字コードを指定
mb_language("Ja");
mb_internal_encoding("UTF-8");

// 件名、本文を変数に格納
$subject = "[ACS_System]注文書が送信されました。";
$host_name = gethostname();
$content = "この注文書の製作物ナンバーは、". $SQL['tm_seisakubutu']. "です。\n http://".$host_name ."/acs_system/Shcool/Purchase_order_selection/acs_order_login.php?id=". $id;
// 2.差出人を日本語表示
$T_name = $SQL['t_tantousha'];
$mailfrom="From:" .mb_encode_mimeheader($T_name);

while($SQL02 = $result_sql02->fetch(PDO::FETCH_ASSOC)){
	$mailto = $SQL02['user_mail'];
	$Aname = $SQL02['user_name'];
	// 3.上記(送信先、件名、本文、差出人)を日本語でメール送信実行
	if(mb_send_mail($mailto, $subject, $content, $mailfrom)){
		echo "<div align=\"center\"><font size=\"5\">". $Aname. "さんに送信しました。</font></div>";
	}
	else{
		echo "<div align=\"center\"><font size=\"5\">". $Aname. "さんに送信失敗しました。<br />初めからやり直してください。</font><br />";
	}

}
$update = "UPDATE tyuumon_master
			SET tm_hattyu_flg = True
			WHERE tm_id = ". $id;
$update_sql = $pdo->prepare($update);
$update_sql->execute();
?>
<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='Selection.php'" />
</div>
</div>
</body>
</html>