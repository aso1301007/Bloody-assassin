<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>新規製作会社登録</title>


<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){


	$("#menu li").hover(function() {
	$(this).children('ul').show();
}, function() {
	$(this).children('ul').hide();
});


});

//window.alert('キャンセルされました');
</script>
</head>
<body>

<?php
require "../DB.php";
include '../acs_header.php';
?>
<div id="title">製作会社追加</div>
<?php
$sql ="SELECT * FROM school";

?>
 		<h3 style="color:#ff0000; text-align:center;">※全項目をご記入ください</h3>
<form action="kaisha_touroku_kakunin.php" method="post" enctype="multipart/form-data">
 <table align="center">
<tr>
	<td align="right">会社名</td>
  	<td><input type="text" name="name" size="33" maxlength="15"></td>
</tr>

<tr>
   <td align="right">メールアドレス</td>
    <td><input type="text" name="mail" size="33" maxlength="255"></td>
</tr>

<tr>
    <td align="right">電話番号</td>
    <td><input type="text" name="tel" size="33" maxlength="11"></td>
</tr>
</table>
  <div style="margin:10px 0px 10px 0px; float:left; position: relative; left: 470px; top: 5px;"/>
  	<input type="submit" value="入力内容を確認"/>
  </div>
  </form>
  	<div style="margin-bottom:10px;">
    	<input type="button" value="戻る" onclick="location.href='function_selection.php'" style="width:5em; position:relative; left:22em; top:2px;"/>
    </div>
</body>
</html>
