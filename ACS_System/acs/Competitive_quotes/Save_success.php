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
<div id="title">保存しました</div>
<?php
	$posid = $_POST['check2'];//チェックボックスの値が配列で入っている
	$sql = 'SELECT *';
	$sql .= ' FROM seisaku_kaisha';
	$sql .= ' WHERE seisaku_id IN(' . substr(str_repeat(',?', count($posid)), 1) . ')';
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute($posid);
	while($company = $result_sql->fetch(PDO::FETCH_ASSOC)){
		echo $company['seisaku_name'];
	}
	echo $_POST['id'];
?>

</body>
</html>