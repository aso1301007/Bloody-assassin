<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" type="text/css" href="../../css.css"/>
<link rel="stylesheet" type="text/css" href="css.css"/>
<title>相みつ会社一覧</title>

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
<style type="text/css">/* テーブル内のスタイルを定義 */
.company{
float:left;
width:350px;
height:120px;
border-width: 1px;
margin:20px 5px 5px 20px;
padding:6px;
text-align:left;

background:#B0C4DE;
color:#333;
padding:15px;
border:2px dashed rgba(0,0,0,0.5);
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
box-shadow:0 0 0 5px #B0C4DE,0 2px 3px 5px rgba(0,0,0,5);
-moz-box-shadow:0 0 0 5px #B0C4DE, 0 2px 3px 5px rgba(0,0,0,5);
-webkit-box-shadow:0 0 0 5px #B0C4DE, 0 2px 3px 5px rgba(0,0,0,5);
}
</style>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<script type="text/javascript">
//<div>10件表示
var page = 0;	//ページ数初期値
function putId(){// divにID名を付ける
	page = 0;//現在ページ数を初期化
	var d = document.getElementById("list");
	var Tr = d.getElementsByTagName("div");
	for(i=0; i<Tr.length; i++){
		Tr[i].id='ID'+i;
	}
}
function draw(){//divを10件表示
	//現在ページ数を<span id="page">に挿入
	var elem = document.getElementById("page");
	elem.innerHTML = page + 1;
	//divを隠す
	var d = document.getElementById("list");
	var Tr = d.getElementsByTagName("div");//<div>を取得
	var total = Math.floor(Tr.length / 10);
	var elem2 = document.getElementById("total");
	elem2.innerHTML = total;
	for(i=0; i<Tr.length; i++){//<div>を全て隠す
		document.getElementById("ID"+i).style.display="none";
	}
	//divを10件表示
	var start = page *10;//<div>開始番号
	var end = start +10;//<div>終了番号
	for(start; start<end; start++){
		document.getElementById("ID"+start).style.display = "";
	}
}
function prev(){//前の10件を表示
	if (page > 0) {
		page--;
		draw();
	}
}
function next(){//次の10件を表示
	var d = document.getElementById("list");
	var Tr = d.getElementsByTagName("div");
	var total = Math.floor(Tr.length / 10);
	if (page < total-1) {
		page++;
		draw();
	}
}
/* ページ読み込み完了時に、処理を実行 */
window.onload=function(){putId();draw();}
</script>
</head>
<body>
<?php
$id = $_REQUEST["id"];	//Select.phpから選択した項目の注文idを受け取る
//注文書の選択している制作会社を検索
$company_list = 'SELECT s.seisaku_name AS name, seisaku_tel AS tel, seisaku_mail AS mail';
$company_list .= ' FROM competitive_quotes c';
$company_list .= ' INNER JOIN seisaku_kaisha s ON c.seisaku_id = s.seisaku_id';
$company_list .= ' WHERE tm_id = '. $id;
$result_list = $pdo->prepare($company_list);
$result_list->execute();
//判定用
$re_list = $pdo->prepare($company_list);
$re_list->execute();
//データが存在するか判定
$re_count = $re_list->fetchAll();
$jud = count($re_count);
if($jud <= 0){
	print<<<EOF
	<script type="text/javascript">
	alert("データが存在していません。注文書選択画面に戻ります。");
	window.history.back(-1);
	</script>
EOF;
	exit;
}
?>
<div id="title">相みつ会社一覧</div>
<div align="left" style="margin-left:40px;" >
	<input id="prev" type="button" onclick="prev()" value="戻る" />
	<input id="next" type="button" onclick="next()" value="次へ" />
	<span id="page"></span>
	<font>/</font>
	<span id="total"></span>
	<font>ページ</font>
	<input type="button" name="can" value="注文書選択画面へ" onclick="location.href='Select.php'" />
</div>
<div id="list">
<?php
$len = 0;//制作会社数
while($list = $result_list->fetch(PDO::FETCH_ASSOC)){
	echo '<div class="company">';
		echo '<b>'.$list['name'].'</b>';
		echo '<p>電話番号：<b>'.$list['tel'].'</b></p>';
		echo '<p>メールアドレス：<b>'.$list['mail'].'</b></p>';
	echo '</div>';
	$len++;
}

//<div>の形式を崩さないために挿入する
$remainder = 10 - ($len % 10);//制作会社数を10の倍数にするために必要な値
if($remainder == 10){$remainder = 0;}//余りが10の倍数の場合
for($i=0; $i<$remainder; $i++){
	echo '<div class="company"></div>';
}
?>
</div>
<br clear="left" />
</body>
</html>