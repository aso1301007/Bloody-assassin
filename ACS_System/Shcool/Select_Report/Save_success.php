<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>報告書保存</title>
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
<?php
	include '../School_header.php';
	require '../../DB.php';			//DB.php呼び出し
?>
<body>
<?php
//入力の必須なDB項目：報告書id,報告書入力日付,ユーザーid,製作会社id,納品日
$id = $_POST['id'];	//報告書id
$date = date('Y-m-d', strtotime($_POST['input_date']));	//報告書入力日付
$user_id = $_POST['user_id'];	//ユーザーid
$company = $_POST['seisaku_name'];	//制作会社id
$n_date = str_replace("-","",strval($_POST['n_date']));	//納品日
//入力が空白でも大丈夫なDB項目
$pbm_position = $_POST['pbm_p'];	//PBM立場
$success_points =  $_POST['s_p'];	//成功点
$failure_points = $_POST['f_p'];	//失敗点
$comment = $_POST['comment'];	//コメント
$product = $_POST['name_of_product'];	//品名
$number_of_copies = $_POST['h_busu'];	//部数
$size = $_POST['h_size'];	//仕様：サイズ
$number_of_pages = $_POST['h_page'];	//仕様：ページ数
$Number_of_colors = $_POST['h_page'];	//仕様：色数
$surface = $_POST['h_men'];	//片面・両面
$paper = $_POST['h_kami'];	//紙
$how_to_fold = $_POST['h_orikata'];	//折り方
$claim_expense = $_POST['h_money'];	//最終請求費用

//DB更新
$sql = "UPDATE houkoku";
$sql .= " SET h_date = '". $date. "',";
$sql .= " user_id = '". $user_id. "',";
$sql .= " h_seisaku_id = '". $company. "',";
$sql .= " h_nouki = '". $n_date. "',";
$sql .= " h_pbm_position = '". $pbm_position. "',";
$sql .= " h_seikou = '". $success_points. "',";
$sql .= " h_sippai = '". $failure_points. "',";
$sql .= " h_comment = '". $comment. "',";
$sql .= " h_hin_janru = '". $product. "',";
$sql .= " h_busu = '". $number_of_copies. "',";
$sql .= " h_size = '". $size. "',";
$sql .= " h_page = '". $number_of_pages. "',";
$sql .= " h_color = '". $Number_of_colors. "',";
$sql .= " h_men = '". $surface. "',";
$sql .= " h_kami = '". $paper. "',";
$sql .= " h_orikata = '". $how_to_fold. "',";
$sql .= " h_hiyou = '". $claim_expense. "'";
$sql .= " WHERE tm_id = ". $id;
$update = $pdo->prepare($sql);
$success_flg = $update->execute();
?>

<div id="title">保存：成功</div>

<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='Selection.php'" />
</div>
</body>
</html>