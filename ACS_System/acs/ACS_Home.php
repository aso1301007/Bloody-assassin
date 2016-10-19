<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css.css"></link>

<title>ACSホームページ</title>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script src="../js/jquery.focused.min.js"></script>
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
	require_once "../DB.php";
	require_once "acs_header.php";
?>
<?php
function quantity($true, $false, $pdo){//件数取得
	$count_sql = 'SELECT *';
	$count_sql .= ' FROM tyuumon_master';
	$count_sql .= ' WHERE '. $true. ' = true and '. $false. ' = false and tm_sakujo_flg = false';

	if (!($result_count = $pdo->prepare($count_sql))) {
		echo "クエリ失敗(count)";
		die;
	}
	else{
		//レコード数を調べる
		$result_count->execute();
		$result_set = $result_count->fetchAll();
		$count = count($result_set);
	}

	return $count;
}

function order($true, $false, $pdo){//内容10件取得
	$order_sql = 'SELECT t1.t_date AS date, t1.t_naiyou AS content, h.hin_janru AS name';
	$order_sql .= ' FROM tyuumon t1';
	$order_sql .= ' INNER JOIN tyuumon_master t2 ON t1.tm_id = t2.tm_id';
	$order_sql .= ' INNER JOIN hinmei h ON t1.t_hin_name = h.hin_id';
	$order_sql .= ' WHERE t2.'. $true. ' = true and t2.'. $false. ' = false and t2.tm_sakujo_flg = false';
	$order_sql .= ' ORDER BY t1.t_date DESC LIMIT 10';

	if (!($result_older = $pdo->prepare($order_sql))) {
		echo "クエリ失敗(tyuumon)";
		die;
	}
	else{
		$result_older->execute();
	}

	return $result_older;
}
?>
<div id="title">ACSトップページ</div>
<table class="home_table">
	<tr><th>進捗状況(最新10件)</th></tr>
	<?php
	$title = array('発注済み：', '確認済み：', '見積もり中：', '見積もり済み：', '納品：', '登録済み：', '報告書作成済み：');
	$flag = array('tm_hattyu_flg', 'tm_kakunin_flg', 'tm_mitumorityuu_flg', 'tm_mitumorizumi_flg', 'tm_nouhin_flg', 'tm_touroku_flg', 'tm_houkokusho_flg', 'tm_sakujo_flg');

	$c1 = 0;
	$c2 = 1;
	while($c1 < 7){
		echo '<tr><td>';
		echo '<div onclick="obj=document.getElementById(\'open'.$c1.'\').style; obj.display=(obj.display==\'none\')?\'block\':\'none\';">';
		echo '<a style="cursor:pointer;">'.$title[$c1].quantity($flag[$c1], $flag[$c2], $pdo).'件</a></div>';

		echo '<div id="open'.$c1.'" style="display:none;clear:both;">';
		echo '<ul>';
		$order = order($flag[$c1], $flag[$c2], $pdo);
		while($sql = $order->fetch(PDO::FETCH_ASSOC)){
			switch($sql['content']){
				case 0:
					$content = '見積もり';
					break;
				case 1:
					$content = '発注';
					break;
			}
			echo '<li>'.Date('Y年m月d日', strtotime($sql['date'])). '　・　'. $sql['name']. '　・　'. $content. '</li>';
		}
		echo '</ul></div>';
		echo '</td></tr>';
		$c1++;
		$c2++;
	}
	?>
</table>
</body>
</html>