<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>

<title>ACS_DB管理</title>
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
include '../acs_header.php';
?>
<div id="title">注文者情報の管理</div>


<table style="margin-bottom:50px; align:center;">

	<tr>
		<td>
			<input type="button" name="add" value="追加" onclick="location.href='t_user_touroku.php'" style="position: relative; left: 11em; top: 8px; width:100px;"/>
		</td>
		<td>
			<input type="button" name="update" value="変更" onclick="location.href='t_user_henkou.php'" style="position: relative; left: 16em; top: 8px; width:100px;"/>
		</td>
		<td>
			<input type="button" name="delete" value="削除" onclick="location.href='t_user_delete.php'" style="position: relative; left: 21em; top: 8px; width:100px;"/>
		</td>
	</tr></table>



</body>
</html>