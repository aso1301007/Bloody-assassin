<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="Stylesheet" href="report.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../css.css" />
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
<title>報告書作成</title>
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.75in .7in .75in .7in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
</style>
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
<body link="blue" vlink="purple">
<?php
$id = $_REQUEST["id"];	//Selection.phpから選択した項目の報告書idを受け取る
$sql = 'SELECT *';
$sql .= ' FROM houkoku h';
$sql .= ' INNER JOIN seisaku_kaisha s ON h.h_seisaku_id = s.seisaku_id';
$sql .= ' INNER JOIN user u ON h.user_id = u.user_id';
$sql .= ' INNER JOIN tyuumon_master t ON h.tm_id = t.tm_id';
$sql .= ' WHERE h.tm_id = '. $id;
$result_sql = $pdo->prepare($sql);
$result_sql->execute();
$result = $result_sql->fetch(PDO::FETCH_ASSOC);

//検索したデータを加工
//報告書日付
$now = date('Y/m/d');
$year = date('Y', strtotime($now));
$month = date('m', strtotime($now));
$day = date('d', strtotime($now));
//入力担当者名
$entry_personnel = $result['user_name'];
//入力担当者id
$test = 'select user_id from houkoku where tm_id = '. $id;
$result_tes = $pdo->prepare($test);
$result_tes->execute();
$resulttes = $result_tes->fetch(PDO::FETCH_ASSOC);
$user_id = $resulttes['user_id'];
//製作物ナンバー
$production_number = $result['tm_seisakubutu'];
//制作会社
$company_id = $result['h_seisaku_id'];
$company_name = $result['seisaku_name'];
$sql2 = 'SELECT seisaku_id AS id, seisaku_name AS name';
$sql2 .= ' FROM seisaku_kaisha';
$result_sql2 = $pdo->prepare($sql2);
$result_sql2->execute();
//納品日
$delivery_date = date("Y-m-d",strtotime($result['h_nouki']));
//PBM立場
$pbm_position = $result['h_pbm_position'];
//成功点
$success_points = $result['h_seikou'];
//失敗点
$failure_points = $result['h_sippai'];
//コメント
$comment = $result['h_comment'];
//品名
$sql3 = 'SELECT hin_id AS id, hin_janru AS name';
$sql3 .= ' FROM hinmei';
$result_sql3 = $pdo->prepare($sql3);
$result_sql3->execute();
//部数
$number_of_copies = $result['h_busu'];
//仕様：サイズ
$size = $result['h_size'];
//仕様：ページ数
$number_of_pages = $result['h_page'];
//仕様：色数
$Number_of_colors = $result['h_color'];
//仕様：片面・両面
$surface = $result['h_men'];
//仕様：紙
$paper = $result['h_kami'];
//仕様：折り方
$how_to_fold = $result['h_orikata'];
//最終請求費用
$claim_expense = $result['h_hiyou'];
?>
<form action="Save_success.php" method="post" name = "report">
<table align="center" border="0"  style="border-collapse:collapse;table-layout:fixed;width:522pt">
<col width="24" span="29" style="width:18pt" />
<tr style="height:17.25pt">
	<td width="24" style="height:17.25pt;width:18pt">
	<input type="hidden" name="id" value="<?php echo $id;?>" /><!-- 報告書id -->
	<input type="hidden" name="input_date" value="<?php echo $now;?>" /><!-- 報告書日付 -->
	<input type="hidden" name="user_id" value="<?php echo $user_id;?>" /><!-- ユーザーid -->
	</td>
	<td width="24" style="width:18pt" />
	<?php
	for($i=0;$i<27;$i++){
		echo '<td width="24" style="width:18pt" />';
	}
	?>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl67">　</td>
	<?php
	for($i=0;$i<23;$i++){
		echo '<td class="xl68">　</td>';
	}
	?>
	<td class="xl69">　</td>
</tr>
<tr style="mso-height-source:userset;height:31.5pt">
	<td height="42" colspan="4" style="height:31.5pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<?php
	for($i=0;$i<8;$i++){
		echo '<td />';
	}
	?>
	<td colspan="6" class="xl90">報告書</td>
	<?php
	for($i=0;$i<9;$i++){
		echo '<td />';
	}
	?>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<?php
	for($i=0;$i<16;$i++){
		echo '<td />';
	}
	?>
	<td colspan ="2">
		<input type="text" name="year" size = "1" maxlength = "4" value="<?php echo $year; ?>" readonly="readonly" />
	</td>
	<td>年</td>
	<td>
		<input type="text" name="month" size = "2" maxlength = "2" class = "one" value="<?php echo $month; ?>" readonly="readonly" />
	</td>
	<td>月</td>
	<td>
		<input type="text" name="date" size = "2" maxlength = "2" class = "one" value="<?php echo $day; ?>" readonly="readonly" />
	</td>
	<td>日</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">入力担当者名</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<input type="text" name="user_name" maxlength="15" class = "two" value = "<?php echo $entry_personnel;?>" readonly="readonly" />
	</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">制作物ナンバー</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<input type="text" name="s_number" maxlength="8" class = "two" value = "<?php echo $production_number;?>" readonly="readonly" />
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl65" style="border-top:none">　</td>
	<?php
	for($i=0;$i<4;$i++){
		echo '<td class="xl65" style="border-top:none">　</td>';
	}
	for($i=0;$i<18;$i++){
		echo '<td class="xl66" />';
	}
	?>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">制作会社</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<select name="seisaku_name" class = "three">
	<?php
	echo '<option value="'.$company_id.'" selected >'.$company_name.'</option>';
	while($production_company = $result_sql2->fetch(PDO::FETCH_ASSOC)){
		echo "<option value=". $production_company['id']. ">". $production_company['name']. "</option>";
	}
	?>
	</select>
	</td>
	<td colspan="4" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">納品日</td>
	<td colspan="8" rowspan="2" class="xl81" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<input type="date" name="n_date" value = "<?php echo $delivery_date;?>" />
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">PBM立場</td>
	<td colspan="18" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<textarea name="pbm_p" rows="3" style="wrap:soft; maxlength:255;" class = "one"><?php echo $pbm_position;?></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">成功点</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<textarea name="s_p" rows="3" style="wrap:soft; maxlength:255;" class = "one"><?php echo $success_points;?></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">失敗点</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<textarea name="f_p" rows="3" style="wrap:soft; maxlength:255;" class = "one"><?php echo $failure_points;?></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">コメント</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<textarea name="comment" rows="3" style="wrap:soft; maxlength:255;" class = "one"><?php echo $comment;?></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">品名</td>
	<td colspan="8" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<select name="name_of_product" class = "one">
		<?php
			echo '<option value="" selected >選択してください</option>';
			while($product_name = $result_sql3->fetch(PDO::FETCH_ASSOC)){
				echo '<option value="'.$product_name['name'].'">'.$product_name['name'].'</option>';
			}
		?>
		</select>
	</td>
	<td colspan="4" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">部数</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<input type="text" name="h_busu" maxlength="6" style="border:1px grey solid;" class = "six" value = "<?php echo $number_of_copies;?>" />部
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="4" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">仕様</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">サイズ</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_size" maxlength="2" class = "two" value = "<?php echo $size;?>" />
	</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">ページ数</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_page" maxlength="3" class = "two" value = "<?php echo $number_of_pages;?>" />
	</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">色数</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_color" maxlength="3" class = "two" value = "<?php echo $Number_of_colors;?>" />
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td rowspan="2" class="xl75" style="border-bottom:.5pt solid black;border-top:none">
	<?php
		if($surface == "片面"){
			echo '<input type="radio" name="h_men" value="片面" checked = "checked" />';
		}
		else{
			echo '<input type="radio" name="h_men" value="片面" />';
		}
	?>
	</td>
	<td colspan="2" rowspan="2" class="xl76" style="border-bottom:.5pt solid black">片面</td>
	<td rowspan="2" class="xl76" style="border-bottom:.5pt solid black;border-top:none" >
	<?php
		if($surface == "両面"){
			echo '<input type="radio" name="h_men" value="両面" checked = "checked" />';
		}
		else{
			echo '<input type="radio" name="h_men" value="両面" />';
		}
	?>
	</td>
	<td colspan="2" rowspan="2" class="xl76" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">両面</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		 border-bottom:.5pt solid black">紙</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_kami" maxlength="10" class = "two" value = "<?php echo $paper;?>" />
	</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">折り方</td>
	<td colspan="3" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_orikata" maxlength="10" class = "two" value = "<?php echo $how_to_fold;?>" />
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">最終請求費用</td>
	<td colspan="18" rowspan="2" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<input type="text" name="h_money" maxlength="8" style="border:1px grey solid;" class = "six money" value = "<?php echo $claim_expense;?>" />円
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl70">　</td>

	<td colspan = "9" class="xl71">
		<input type="button" value="保存" class ="eight" onclick="document.report.submit()" />
		<input type="button" value="キャンセル" class ="eight" onclick="location.href='Selection.php'" />
	</td>
	<?php
	for($i=0;$i<14;$i++){
		echo '<td class="xl71">　</td>';
	}
	?>
	<td class="xl72">　</td>
</tr>
<tr style="display:none">
	<?php
	for($i=0;$i<29;$i++){
		echo '<td width="24" style="width:18pt" />';
	}
	?>
</tr>
</table>
</form>
</body>

</html>

