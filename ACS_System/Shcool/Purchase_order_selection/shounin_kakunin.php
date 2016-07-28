<?php
	session_start();

	$err_message = "";
	$html_content = "";

	if(isset($_SESSION['destination_id'])){
		require_once(dirname(__FILE__) .'/bin/DB_Manager.php');
		require_once(dirname(__FILE__) .'/bin/common.php');

		$db = new DB_Manager();
		$result = $db->select_tyuumonsha_by_id($_SESSION['destination_id']);

		$name = $result['user_name'];
		$comment = h($_SESSION['comment'], true);
	}
	else{
		$err_message = "不正なアクセスで呼び出された可能性があります";
		session_destroy();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title></title>
</head>
<body>

<?php
	if($err_message != ""){
		print "<p>". $err_message ."</p>";
	}

	else{
		print <<<HTML
	<form action="shounin_kanryou.php" method="post" accept-charset="utf-8">
		<input type="hidden" name="mode" value="check" />

		<h3>送信先は間違いありませんか？</h3>
		<p>送信先：<br />$name</p>
		<p>コメント：<br />$comment</p>

		<input type="submit" name="return" value="元に戻る">
		<input type="submit" name="regist" value="登録する">
		<input type="hidden" name="mode" value="registComplete">
	</form>

HTML;
	}
?>

</body>
</html>