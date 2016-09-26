<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>相みつ会社決定確認</title>
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
<script type="text/javascript">
//<table>10件表示
var page = 0;	//ページ数初期値
function putId(){// テーブルの行にID名を付ける
	page = 0;//現在ページ数を初期化
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	for(i=0; i<Tr.length; i++){
		Tr[i].id='trID'+i;
	}
}
function draw(){//trを10件表示
	//現在ページ数を<span id="page">に挿入
	var elem = document.getElementById("page");
	elem.innerHTML = page + 1;
	//trを隠す
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	var total = Math.floor(Tr.length / 10);
	var elem2 = document.getElementById("total");
	elem2.innerHTML = total;
	for(i=1; i<=Tr.length-1; i++){//<tr>を全て隠す
		document.getElementById("trID"+i).style.display="none";
	}
	//trを10件表示
	var start = (page +1) *10 -9;//<tr>開始番号
	var end = start +10;//<tr>終了番号
	for(start; start<end; start++){
		document.getElementById("trID"+start).style.display = "";
	}
}
function prev(){//前の10件を表示
	if (page > 0) {
		page--;
		draw();
	}
}
function next(){//次の10件を表示
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	var max = Tr.length - 1;//<th>分を引く
	if (page < max / 10 - 1) {
		page++;
		draw();
	}
}
/* ページ読み込み完了時に、処理を実行 */
window.onload=function(){putId();draw();}
</script>
<style type="text/css">/* テーブル内のスタイルを定義 */
.check{
	width:20px;
	height:20px;
	text-align: right;
}
table.type07 {
	border-collapse: collapse;
	text-align: left;
	line-height: 1.5;
	border: 1px solid #ccc;
}
table.type07 thead {
	border-right: 1px solid #ccc;
	border-left: 1px solid #ccc;
	background: #04162e;
}
table.type07 thead th {
	padding: 20px;
	font-weight: bold;
	vertical-align: top;
	color: #fff;
}
table.type07 tbody th {
	width: 20px;
	padding: 10px;
	font-weight: bold;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
	background: #efefef;
	text-align:center;
}
table.type07 td {
	width: 350px;
	padding: 10px;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
}

</style>
</head>
<body>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<div id="title">以下の制作会社を相みつ候補にしますか？</div>
<?php
	if(empty($_POST['check1'])){
		echo '<script language=javascript>alert("値が選択されていません。");</script>';
		$url = $_SERVER['HTTP_REFERER'];
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit;
	}
	$posid = $_POST['check1'];//チェックボックスの値が配列で入っている
	$sql = 'SELECT *';
	$sql .= ' FROM seisaku_kaisha';
	$sql .= ' WHERE seisaku_id IN(' . substr(str_repeat(',?', count($posid)), 1) . ')';
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute($posid);
?>
<form name="comtitive" action="Save_success.php" method="post">
<?php //選択した値をform送信するために配置している
echo "<input type='hidden' name='id' value=". $_POST['tm_id'] .">";	//注文書id

foreach( $posid as $val ) {//checkboxの値
	echo "<input type='hidden' name='check2[]' value=". $val .">";
}
?>
<div align="center" style="margin:20px;">
	<input type="button" value="いいえ" style="width:64px;height:32px;" onclick="history.back()" />
	<input type="submit" name="yes" style="width:64px;height:32px;margin-left:20px;" value="はい" />
</div>
<table id="list" class="type07" align="center">
<thead>
	<tr>
		<th></th>
		<th>制作会社</th>
	</tr>
</thead>
<tbody>
	<?php
		$count = 0;
		while($company = $result_sql->fetch(PDO::FETCH_ASSOC)){
			echo '<tr><th><input type="checkbox" name="check_num[]" class="check" value="'.$company['seisaku_id'].'" disabled="disabled" checked="checked" /></th>';
			echo '<td>'.$company['seisaku_name'].'</td></tr>';
			$count++;
		}
		$null = $count % 10;
		while($null < 10){
			echo '<tr><th>　</th><td>　</td></tr>';
			$null++;
		}
	?>
</tbody>
</table>
<div align="left" style="margin-left:200px;" >
	<input type="button" onclick="prev()" value="戻る" />
	<input type="button" onclick="next()" value="次へ" />
	<span id="page"></span>
	<font>/</font>
	<span id="total"></span>
	<font>ページ</font>
</div>
</form>
</body>
</html>