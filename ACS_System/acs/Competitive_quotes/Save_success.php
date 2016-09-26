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
	//チェックボックスで指定した制作会社名を検索
	$sql = 'SELECT *';
	$sql .= ' FROM seisaku_kaisha';
	$sql .= ' WHERE seisaku_id IN(' . substr(str_repeat(',?', count($posid)), 1) . ')';
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute($posid);

	//competitive_quotesDB内のtm_idが同じデータを削除
	//delet文を変数に格納
	$delete_sql = 'DELETE FROM competitive_quotes';
	$delete_sql .= ' WHERE tm_id = :del_id';
	//削除する値は空のまま、sql実行の準備をする
	$del_stmt = $pdo->prepare($delete_sql);
	//削除実行
	$del_stmt->execute(array(':del_id' => $_POST['id']));

	//指定した制作会社をcompetitive_quotesDBに挿入
	//insert文を変数に格納
	$insert_sql = 'INSERT IGNORE INTO competitive_quotes (tm_id, seisaku_id, seisaku_name)';
	$insert_sql .= ' VALUES (:tm_id, :s_id, :name)';
	//挿入する値は空のまま、sql実行の準備をする
	$ins_stmt = $pdo->prepare($insert_sql);
	//挿入する値を連想配列に格納する
	$cq = array();
	while($company = $result_sql->fetch(PDO::FETCH_ASSOC)){
		$cq = array_merge($cq, array($company['seisaku_name']=>$company['seisaku_id']));
	}
	//foreachで挿入する値を1つずつループ処理
	foreach ($cq as $key => $val){
		$ins_stmt->execute(array(':tm_id' =>$_POST['id'], ':s_id' => $val, ':name' => $key));
	}
?>
<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='Select.php'" />
</div>
</body>
</html>