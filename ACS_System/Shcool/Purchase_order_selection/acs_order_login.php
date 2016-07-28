<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head>
<title>ログイン</title>

<!-- スタイルシート -->
<style type="text/css">
body{
background: #ffffff;
}

/*==== センター帯 ====*/
#center{
width: 800px; /*横幅を指定*/
margin: 0px auto; /*左右中央揃え*/
padding: 0px; /*内部余白なし*/
background: #4169e1;
}

/*==== 本文のブロック ====*/
#main{
width: auto;
margin: 8px;
padding: 4px;
}

</style>
</head>

<body link="#000000" vlink="#000000" alink="#000000" >
<font color="ffffff">
<br>
<br>
<br>
<br>
<div id="center">
<br>
<div id="main">
<br>
<br>
<br>
<br>
<br>
<br>
<center><FONT size="7"color="ffffff">ACSシステム</FONT><hr />
<br>
<br>
<FONT size="4" >メールアドレスとパスワードを入力してください。
<br></FONT>
</center>
<br>
<br>
<font size="3">
<form action="acs_order_login_processing.php" method="POST">
<?php
$id = $_REQUEST['id'];
?>
<input type="hidden" name="t_id" value="<?php echo $id?>" />
<center><table>
	<tr><td>メールアドレス :</td><td><input type="text" name="MAIL"></td></tr>
	<tr><td>　　パスワード :</td><td><input type="password" name="PASS"/></td></tr>
	<tr><td><br></td></tr>
	<tr><td></td><td>　　　　　　<input type="submit" value="LOGIN" style="width:60px; height:20px"/></td></tr>
</table></center>
</form>
</font>
<br>
<br>
<br>
<br>
<br>
</div>
</div>
</font>
</body>
</html>