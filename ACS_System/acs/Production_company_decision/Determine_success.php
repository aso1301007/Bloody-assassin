<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>保存成功</title>
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
</script>
</head>
<body>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<?php
$sql = 'UPDATE tyuumon_master';
$sql .= ' SET seisaku_id = :s_id';
$sql .= ' WHERE tm_id = :id';
$stmt = $pdo->prepare($sql);
$params = array(':s_id' => $_POST['com'], ':id' => $_POST['id']);
$stmt->execute($params);
?>
<div id="title">保存しました。</div>
<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='Select.php'" />
</div>
</body>
</html>