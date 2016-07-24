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
<?php
//	require '../../DB.php';			//DB.php呼び出し
//	require '../../user_name.php';	//セッションユーザー呼び出し
?>
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
	<div id="title">送信結果：成功</div>
<?php
	require '../../DB.php';			//DB.php呼び出し
?>
<?php
$id = $_REQUEST['id'];//注文ID
$sql = "SELECT t_tantousha
			FROM tyuumon
			WHERE tm_id = ". $id;
$result_sql = $pdo->prepare($sql);
$result_sql->execute();
$SQL = $result_sql->fetch(PDO::FETCH_ASSOC);

// 1.言語、文字コードを指定
mb_language("Ja");
mb_internal_encoding("UTF-8");

// 送信先、件名、本文を変数に格納
$mailto = "1301007@st.asojuku.ac.jp";
$subject = "[ACS_System]注文書が送信されました。";
$content = "http://".gethostname() ."/acs_system/Shcool/Purchase_order_selection/Confirmation_success.php?id=". $id;

// 2.差出人を日本語表示
$mailfrom="From:" .mb_encode_mimeheader($SQL['t_tantousha']);

// 3.上記(送信先、件名、本文、差出人)を日本語でメール送信実行
if(mb_send_mail($mailto, $subject, $content, $mailfrom)){
	echo "<div align=\"center\"><font size=\"5\">送信しました。</font></div>";
}
else{
	echo "<div align=\"center\"><font size=\"5\">送信に失敗しました。<br />初めからやり直してください。</font><br />";
	echo "<input type=\"button\"  value=\"戻る\" onclick=\"location.href='Selection.php'\" /></div>";
}
?>
 <?php
// echo "http://localhost". $_SERVER["REQUEST_URI"]. "<br />";
// $id = $_REQUEST['id'];
// $addres = "http://localhost/acs_system/Shcool/Purchase_order_selection/Confirmation_success.php?id=". $id;
// //mail("送信先アドレス", "件名", "本文", "送信元アドレス")
// if(mb_send_mail("1301007@st.asojuku.ac.jp", "卒研テストメール", $addres, "hellsing.10@ezweb.ne.jp")){
// 	echo "成功";
// }
// else{
// 	echo "失敗";
// }
?>
</div>
</body>
</html>