<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" type="text/css" href="../../css.css"/>
<link rel="stylesheet" type="text/css" href="css.css"/>
<title>注文書選択</title>

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
.list{
	border-collapse: collapse;
}
.list th{
	background-color: #cccccc;
	border-style: solid;
	border-width: 1px;
	font-size: 18px;
}
.list td{
	border-style: solid;
	border-width: 1px;
	font-size: 18px;
}

div.over01{
	font-size: 20px;
	width: 200px;
	height: 40px;
	overflow: auto;
	display:table-cell;
    text-align:center;
    vertical-align:middle;
}

div.over02{
	width: 300px;
	height: 40px;
	overflow: auto;
}
</style>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<script type="text/javascript">
<?php
//項目を配列に格納	配列item[][]
//注文内容を配列に	item[content][注文DBの注文内容] = 0:見積もり or 1:発注;
$content = 'SELECT t_naiyou';
$content .= ' FROM tyuumon';
$content .= ' GROUP BY t_naiyou;';
$result_content = $pdo->prepare($content);
$result_content->execute();
while($CONTENT = $result_content->fetch(PDO::FETCH_ASSOC)){
	switch ($CONTENT['t_naiyou']){
		case 0:
			$item['content'][0] = "見積もり";
			break;
		case 1:
			$item['content'][1] = "発注";
			break;
	}
}
//品名を配列に	item[goods][注文DBの品id] = 品名DBの品名
$goods = 'SELECT t1.t_hin_name AS id, h1.hin_janru AS name';
$goods .= ' FROM tyuumon t1 INNER JOIN hinmei h1 ON t1.t_hin_name = h1.hin_id';
$goods .= ' GROUP BY id;';
$result_goods = $pdo->prepare($goods);
$result_goods->execute();
while($GOODS = $result_goods->fetch(PDO::FETCH_ASSOC)){
	$item['goods'][$GOODS['id']] = $GOODS['name'];
}
//学校名を配列に	item[school][注文DBの学校id] = 学校DBの学校名
$school = 'SELECT t1.school_id AS id, s1.school_name AS name';
$school .= ' FROM tyuumon t1 INNER JOIN school s1 ON t1.school_id = s1.school_id';
$school .= ' GROUP BY id;';
$result_school = $pdo->prepare($school);
$result_school->execute();
while($SCHOOL = $result_school->fetch(PDO::FETCH_ASSOC)){
	$item['school'][$SCHOOL['id']] = $SCHOOL['name'];
}

//日付:年を取得
$year = 'SELECT SUBSTRING(t_date,1,4) AS YEAR';//例：2015-01-01を2015に変換
$year .= ' FROM tyuumon';
$year .= ' GROUP BY YEAR;';
$result_year = $pdo->prepare($year);
$result_year->execute();
while($YEAR = $result_year->fetch(PDO::FETCH_ASSOC)){//注文DBにある注文日付の年
	$month = 'SELECT SUBSTRING(t_date,6,2) AS MONTH';
	$month .= ' FROM tyuumon';
	$month .= ' WHERE SUBSTRING(t_date,1,4) = '.$YEAR['YEAR'];
	$month .= ' GROUP BY MONTH;';
	$result_month = $pdo->prepare($month);
	$result_month->execute();

	//日付：月データを配列に格納する month_date[年][0から順に] = 月
	$c = 0;//配列の添字
	while($MONTH = $result_month->fetch(PDO::FETCH_ASSOC)){
		$month_date[$YEAR['YEAR']][$c] = $MONTH['MONTH'];
		$c++;
	}
}

//検索用のSQL文
$search = 'SELECT t1.tm_id AS ID, t1.t_date AS DATE, t1.t_bikou AS REMARKS,';
$search .= ' t2.tm_seisakubutu AS NUMBER,';
$search .= ' h1.hin_janru AS NAME';
$search .= ' FROM tyuumon t1';
$search .= ' INNER JOIN tyuumon_master t2 ON t1.tm_id = t2.tm_id';
$search .= ' INNER JOIN hinmei h1 ON t1.t_hin_name = h1.hin_id';
$search .= ' ORDER BY DATE DESC;';

//製作物ナンバー検索用の配列	$production[製作物ナンバー][注文id(tm_id)注文日付(t_date)、品名(hin_janru)、備考(t_bikou)] = DB内の値
$result_number = $pdo->prepare($search);
$result_number->execute();
while($while_number = $result_number->fetch(PDO::FETCH_ASSOC)){
	$production[$while_number['NUMBER']]['id'] = $while_number['ID'];//注文id
	$production[$while_number['NUMBER']]['date'] = date('Y年　m月　d日', strtotime($while_number['DATE']));//注文日付
	$production[$while_number['NUMBER']]['remarks'] = $while_number['REMARKS'];//備考
	$production[$while_number['NUMBER']]['name'] = $while_number['NAME'];//品名
}


//日付検索用の配列	$date[年月(例2016年01月23日：2016123)][注文id(tm_id)注文日付(t_date)、品名(hin_janru)、備考(t_bikou)] = DB内の値
$result_date = $pdo->prepare($search);
$result_date->execute();
$c = 0;
while($while_date = $result_date->fetch(PDO::FETCH_ASSOC)){
	$ym = substr($while_date['DATE'],0,4);//注文日付年4桁抽出
	$ym .= substr($while_date['DATE'],5,2);//注文日付月2桁抽出+結合
	$date[$ym][$c]['id'] = $while_date['ID'];//注文id
	$date[$ym][$c]['date'] = date('Y年　m月　d日', strtotime($while_date['DATE']));//注文日付
	$date[$ym][$c]['remarks'] = $while_date['REMARKS'];//備考
	$date[$ym][$c]['name'] = $while_date['NAME'];//品名
	$c++;
}

//注文内容検索用の配列


//javascriptに配列を渡すためにjsonに変換する
$j_item = json_encode($item);				//項目onchange
$j_month_date = json_encode($month_date);	//日付：月onchange
$j_production = json_encode($production);	//製作物ナンバー検索
$j_date = json_encode($date);				//日付検索
?>

//phpから配列を受け取る
var item = JSON.parse('<?php echo  $j_item; ?>');				//項目
var month_date = JSON.parse('<?php echo  $j_month_date; ?>');	//日付：月
var production = JSON.parse('<?php echo  $j_production; ?>');	//製作物ナンバー検索
var date = JSON.parse('<?php echo  $j_date; ?>');				//日付検索

function number_serch(){//製作物ナンバー検索
	var search = document.forms.search_number.production.value;	//input textの値を取得
	var Tbe = document.getElementById("list");//<table>を取得
	while(Tbe.rows[ 1 ] ){//列をヘッダ以外全て削除
		Tbe.deleteRow( 1 );
	}
	if(production[search]){//配列に値が存在するかどうか判定
		//列を追加
		var row = Tbe.insertRow(-1);
		//セルを追加
		//日付
		var col1 = row.insertCell(-1);//インデックス指定、-1で末尾に追加
		col1.innerHTML = "<div class=\"over01\">" + production[search]['date'] + "</div>";
		//品名
		var col2 = row.insertCell(-1);
		col2.innerHTML = "<div class=\"over01\"><a href=\"Production_companies.php?id=" + production[search]['id'] + "\">" + production[search]['name'] + "</div>";//Production_companies.phpに注文idをGET送信
		//備考
		var col3 = row.insertCell(-1);
		col3.innerHTML = "<div class=\"over02\">" + production[search]['remarks'] + "</div>";
	}
	else{
		var row = Tbe.insertRow(-1);
		var col1 = row.insertCell(-1);
		col1.innerHTML = "<div class=\"over01\"></div>";
		var col2 = row.insertCell(-1);
		col2.innerHTML = "<div class=\"over01\">存在しません。</div>";
		var col3 = row.insertCell(-1);
		col3.innerHTML = "<div class=\"over02\"></div>";
	}
	for(i=2; i<=10; i++){//<table>の形式を崩さないために挿入
		var row = Tbe.insertRow(-1);
		var col1 = row.insertCell(-1);
		col1.innerHTML = "<div class=\"over01\"></div>";
		var col2 = row.insertCell(-1);
		col2.innerHTML = "<div class=\"over01\"></div>";
		var col3 = row.insertCell(-1);
		col3.innerHTML = "<div class=\"over02\"></div>";
	}

	//function起動
	putId();
	draw();
}

function things_search(){//項目検索

}
function change_item(){//項目検索：項目onchange
	var select1 = document.forms.sort.item; //項目selectを宣言
	var select2 = document.forms.sort.conditions; //条件selectを宣言
	var pObjLen=select1.options.length;
	select2.options.length = 0; //選択肢の数がそれぞれに異なる場合、これが重要
	sel1_value = select1.options[select1.selectedIndex].value;//項目selectで選ばれた値
	sel2_len = item[sel1_value].length;//条件selectに挿入するデータの数
	var i = 0;
	for(key in item[sel1_value]){
		select2.options[i] = new Option(item[sel1_value][key], key);
		i++;
	}
}
function period_sort(){//日時検索
	var select1 = document.forms.sort_period.year;	//<select>年;
	var select2 = document.forms.sort_period.month;//<select>月
	var serch_year = select1.options[select1.selectedIndex].value;//選択された年値
	var serch_month = select2.options[select2.selectedIndex].value;//選択された月値
	var ym = serch_year + serch_month;//年 + 月 配列検索用
	var Tbe = document.getElementById("list");//<table>を取得
	while(Tbe.rows[ 1 ] ){//列をヘッダ以外全て削除
		Tbe.deleteRow( 1 );
	}
	var length = Object.keys(date[ym]).length;//検索結果の長さ
	var remainder = 10 - (length % 10);//検索結果を10の倍数にするために必要な値
	if(remainder == 10){remainder = 0;}
	for(key in date[ym]){//検索結果を挿入
		//列を追加
		var row = Tbe.insertRow(-1);
		//セルを追加
		//日付
		var col1 = row.insertCell(-1);//インデックス指定、-1で末尾に追加
		col1.innerHTML = "<div class=\"over01\">" + date[ym][key]['date'] + "</div>";
		//品名
		var col2 = row.insertCell(-1);
		col2.innerHTML = "<div class=\"over01\"><a href=\"Production_companies.php?id=" + date[ym][key]['id'] + "\">" + date[ym][key]['name'] + "</div>";//Production_companies.phpに注文idをGET送信
		//備考
		var col3 = row.insertCell(-1);
		col3.innerHTML = "<div class=\"over02\">" + date[ym][key]['remarks'] + "</div>";
	}
	for(i=0; i<remainder; i++){//<table>の形式を崩さないために挿入
		var row = Tbe.insertRow(-1);
		var col1 = row.insertCell(-1);
		col1.innerHTML = "<div class=\"over01\"></div>";
		var col2 = row.insertCell(-1);
		col2.innerHTML = "<div class=\"over01\"></div>";
		var col3 = row.insertCell(-1);
		col3.innerHTML = "<div class=\"over02\"></div>";
	}
	//function起動
	putId();
	draw();
}
function change_year(){//日付検索：年onchange
	var select1 = document.forms.sort_period.year; //学校selectを宣言
	var select2 = document.forms.sort_period.month; //学部selectを宣言
	var pObjLen=select1.options.length;
	select2.options.length = 0; //選択肢の数がそれぞれに異なる場合、これが重要
	sel1_value = select1.options[select1.selectedIndex].value;//年selectで選ばれた値
	sel2_len = month_date[sel1_value].length;//月selectに挿入するデータの数
	for(i=0; sel2_len>i; i++){//月selectに年selectに連動した月を挿入
		var mon = month_date[sel1_value][i];
		select2.options[i] = new Option(mon+"月", mon);
	}
}

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
window.onload=function(){change_year();change_item();putId();draw();}
</script>
</head>
<body>
<div id="title">注文書選択</div>
<?php
//日付(年)を取得
$year = 'SELECT SUBSTRING(t_date,1,4) AS YEAR';//例：2015-01-01を2015に変換
$year .= ' FROM tyuumon';
$year .= ' GROUP BY YEAR;';
$result_year = $pdo->prepare($year);
$result_year->execute();
?>
<div>
<!-------製作物ナンバー検索--------------------------->
<div id="number_search">
	<b>制作物ナンバーを入力してください。</b>
	<form  name="search_number" method="post" style="float:right">
		<p>制作物ナンバー：<input type="text" id="production" style="height:20px; vertical-align: middle;" name="search_text" size="20" maxlength="8" />
		<span style="margin-right: 1em;" />
		<input type="button" onclick="number_serch()" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>

<!-------日時ソート-------------------------------------->
<div id="period_sort">
	<form name="sort_period" method="post">
		<b>年と月を選択してください。</b>
		<p>年：
		<select name = "year" onchange="change_year()">
		<?php
		while($YEAR = $result_year->fetch(PDO::FETCH_ASSOC)){//注文DBにある注文日付の年を挿入
			echo '<option value="'.$YEAR['YEAR'].'">'.$YEAR['YEAR'].'年</option>';
		}
		?>
		</select>
		<span style="margin-right: 1em;" />
		月：
		<select name = "month" />
		<span style="margin-right: 1em;" />
		<input type="button" onclick="period_sort()" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>


<!-- -----ソート項目----------------------------- -->

<div id="things_search" >
	<form name="sort" method="post">
		<b>項目と条件を選択してください。</b>
		<p>項目：
		<select name = "item" onchange="change_item()">
			<option value="content" label="注文内容">注文内容</option>
			<option value="goods" label="品名ジャンル" >品名ジャンル</option>
			<option value="school" label="学校名" 	>学校名</option>
		</select>
		<span style="margin-right: 1em;" />

		<a>条件：</a>
		<select name = "conditions" />
		<span style="margin-right: 1em;"/>
		<input type="button" onclick="things_search()" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>
</div>
<?php $count = 0;?>
<table id="list" class="list" style="width:700px; height:20px; border-style: solid; border-width: 1px; margin-button: 40px; margin-right: 60px; margin-left: 60px; padding:10px;" align="left">
	<tr style="border-style: solid; border-width: 1px;" align="center">
		<th style="width:200px;">作成日</th>
		<th style="width:200px;">品名</th>
		<th style="width:300px;">備考</th>
	</tr>
	<?php

	while($count < 100){//検索結果を表示
		$count++;
		echo "<tr><td><div class=\"over01\" /></td><td><div class=\"over01\" />なし".$count."</td><td><div class=\"over02\"></td></tr>";
	}
	// db切断
	$pdo = null;
	?>
</table>
<br clear="left" />
<div align="left" style="margin-left:40px;" >
	<input id="prev" type="button" onclick="prev()" value="戻る" />
	<input id="next" type="button" onclick="next()" value="次へ" />
	<?php
	$total = 1;
	if(($count / 10) > 1){
		$total = ceil($count / 10);
	 }
	?>
	<span id="page"></span>
	<font>/<?php echo $total;?>ページ</font>
</div>
</body>
</html>