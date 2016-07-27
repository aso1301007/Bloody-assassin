<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head>
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
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

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>承認申請確認</title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../School_header.php') ?>
<?php

	$err_message = "";
	$html_content = "";

	require_once(dirname(__FILE__) .'/bin/DB_Manager.php');
	require_once(dirname(__FILE__) .'/bin/common.php');

	$db = new DB_Manager();
if($_SESSION['select_action'] == "last_shounin"){
	$html_content = <<<HTML
		<h3>最終承認してもよろしいですか？</h3>
HTML;
}
else{
	if(isset($_SESSION['destination_id'])){
		$result = $db->select_tyuumonsha_by_id($_SESSION['destination_id']);

		$name = $result['user_name'];
		$comment = h($_SESSION['comment'], true);

		$html_content = <<<HTML
		<h3>送信先は間違いありませんか？</h3>
		<table style="margin: 10px;">
			<tr>
				<td>送信先：</td><td>$name</td>
			</tr>
			<tr>
				<td>コメント：</td><td>$comment</td>
			</tr>
		</table>
HTML;
	}
	else{
		$err_message = "不正なアクセスで呼び出された可能性があります";
		session_destroy();
	}
}
?>
<div style="margin: 50px">
<?php
	if($err_message != ""){
		print "<p>". $err_message ."</p>";
	}

	else{
		print <<<HTML
	<form action="shounin_kanryou.php" method="post" accept-charset="utf-8">
		<input type="hidden" name="mode" value="check" />

		$html_content

		<input type="submit" name="return" value="元に戻る">
		<input type="submit" name="regist" value="登録する">
		<input type="hidden" name="mode" value="registComplete">
	</form>

HTML;
	}
?>
</div>
</body>
</html>