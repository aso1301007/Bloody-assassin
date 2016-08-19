<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_新規注文者登録</title>


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
require "../../DB.php";
include '../acs_header.php';
?>
<div id="title">注文者追加</div>
<?php
$sql ="SELECT * FROM school";

?>
		<h4 style="margin-top:50px; text-align:center;">新しく登録したい注文者の内容を<br/>それぞれの項目に入力してください。</h4>
 		<h3 style="color:#ff0000; text-align:center;">※全項目をご記入ください</h3>
<form action="t_user_touroku_kakunin.php" method="post" enctype="multipart/form-data">
 <table align="center">
<tr>
	<td align="right">氏名</td>
  	<td><input type="text" name="name" value="<?php if(isset($name)){ echo $name; } ?>" size="33" maxlength="15"></td>
</tr>
<tr>
	<td align="right">学校</td>
    <td><from>
    	<select name="school">
<?php
		$school = "SELECT * FROM school";
		$yes_school =  $pdo->prepare($school);
		$yes_school->execute();
		while($res = $yes_school->fetch(PDO::FETCH_ASSOC)){
			echo "<option value=". $res['school_id']. ">". $res['school_name']. "</option>";
	}
?>
    	</select>
    </from></td>
</tr>
<tr>
    <td align="right">部署</td>
    <td><input type="text" name="busho" size="33" maxlength="20"></td>
</tr>
<tr>
   <td align="right">メールアドレス</td>
    <td><input type="text" name="mail" size="33" maxlength="255"></td>
<tr>
    <td align="right">パスワード</td>
    <td><input type="password" name="pass" size="34" maxlength="20"></td>
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
