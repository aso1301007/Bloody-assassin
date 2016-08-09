<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>学校_進捗管理</title>


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

//window.alert('キャンセルされました');
</script>



<?php require "../../DB.php";?>

<script type="text/javascript">
function functionName()
{
	var select1 = document.forms.sort.selectName1; //変数select1を宣言
	var select2 = document.forms.sort.selectName2; //変数select2を宣言

	select2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要

	<?php


	$pull_hin_janru = $pdo->prepare("SELECT * FROM hinmei");
	$pull_hin_janru->execute();
	$pull_school_name = $pdo->prepare("SELECT * FROM school");
	$pull_school_name ->execute();
	$count_h=0;
	$count_s=0;
	if (!$pull_hin_janru) {
		exit('データを登録できませんでした。');
	}
	if (!$pull_school_name) {
		exit('データを登録できませんでした。');
	}
	?>
	if (select1.options[select1.selectedIndex].value == "99")
	{
	select2.options[0] = new Option("項目を選択してください","");
	<?php if(!isset($_POST['selectName2'])){$_POST['selectName2']=null;?>select2.options[0].selected = true;<?php }?>
	}

	if (select1.options[select1.selectedIndex].value == "t_naiyou")
	{
	select2.options[0] = new Option("見積もり","0");
	<?php if($_POST['selectName2']=="0"){?>select2.options[0].selected = true;<?php }?>
	select2.options[1] = new Option("発注","1");
	<?php if($_POST['selectName2']=="1"){?>select2.options[1].selected = true;<?php }?>
	}


	else if (select1.options[select1.selectedIndex].value == "hin_janru")
	{
	<?php while ($pull_h = $pull_hin_janru -> fetch(PDO::FETCH_ASSOC))  { ?>

	select2.options[<?php echo($count_h); ?>] = new Option("<?php echo($pull_h['hin_janru']); ?>","<?php echo($pull_h['hin_id']);?>");
	<?php if($_POST['selectName2']==$pull_h['hin_id']){?>select2.options[<?php echo($count_h); ?>].selected = true;<?php }?>

	<?php $count_h++; } ?>

	}
	else if (select1.options[select1.selectedIndex].value == "school_name")
	{
	<?php while ($pull_s = $pull_school_name -> fetch(PDO::FETCH_ASSOC))  { ?>

	select2.options[<?php echo($count_s); ?>] = new Option("<?php echo($pull_s['school_name']); ?>","<?php echo($pull_s['school_id']);?>");
	<?php if($_POST['selectName2']==$pull_s['school_id']){?>select2.options[<?php echo($count_s); ?>].selected = true;<?php }?>

	<?php $count_s++; }?>

	}
	}
	</script>

	</head>


	<body onload="functionName()">

	<?php
include '../acs_header.php';
?>
<div id="title">進捗管理</div>
<?php

$non_oblect=0;
$result = $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
				INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
				INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
				INNER JOIN school SC ON TY.school_id=SC.school_id)
				LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
				ORDER BY TY.t_date DESC LIMIT 10");

$result->execute();

	if (!$result) {
		exit('データを登録できませんでした。');
	}



	//制作ナンバー検索
	if(isset($_POST['search_text'])){
	$search_word = $_POST['search_text'];
		$search_result=$pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
				INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
				INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
				INNER JOIN school SC ON TY.school_id=SC.school_id)
				LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
				WHERE TM.tm_seisakubutu LIKE ?
				ORDER BY TY.t_date DESC LIMIT 10");
/* 				from tyuumon,tyuumon_master,hinmei,gazou,school
				where tyuumon.tm_id=tyuumon_master.tm_id
				and tyuumon.t_hin_name=hinmei.hin_id
				and gazou.tm_id=tyuumon.tm_id
				and school.school_id=tyuumon.school_id
				and tyuumon_master.tm_seisakubutu LIKE ?");
*/
 $keyword = $search_word;
		$result=$search_result;
		$result->execute(array("%".$_POST['search_text']."%"));

	}


	//ソート
	if(isset($_POST['selectName1'])){
		$koumoku = $_POST['selectName1'];
		$zyouken = $_POST['selectName2'];

		//見積もりor発注
		if($koumoku=='t_naiyou'){
			$select_Name1="t_naiyou";
//			echo "内容".$zyouken;
			$sort_result= $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
										INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
										INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
										INNER JOIN school SC ON TY.school_id=SC.school_id)
										LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
										WHERE TY.t_naiyou = :zyouken
										ORDER BY TY.t_date DESC LIMIT 10");
			$sort_result->bindValue(":zyouken",$zyouken);
			$result=$sort_result;
			$result->execute();
		}

		//品名ジャンル
		if($koumoku=='hin_janru'){
			$select_Name1="hin_janru";
//			echo "品名zyouken:".$zyouken;
			$sort_result= $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
										INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
										INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
										INNER JOIN school SC ON TY.school_id=SC.school_id)
										LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
										WHERE HI.hin_id=:zyouken
										ORDER BY TY.t_date DESC LIMIT 10");
			$sort_result->bindValue(":zyouken",$zyouken);
			$result=$sort_result;
			$result->execute();
		}

		//学校名
		if($koumoku=='school_name'){
			$select_Name1="school_name";
//			echo "学校zyouken".$zyouken;
			$sort_result= $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
										INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
										INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
										INNER JOIN school SC ON TY.school_id=SC.school_id)
										LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
										WHERE SC.school_id = :zyouken
										ORDER BY TY.t_date DESC LIMIT 10");
			$sort_result->bindValue(":zyouken", $zyouken);
			$result=$sort_result;
			$result->execute();
			}
			// 【案件がない場合】
/* 		$resultSet = $sort_result->fetchAll();
		$resultNum = count($resultSet);

		if (0 == $resultNum) {
			$non_oblect=1;
		} */
	}

//日付検索
		if(isset($_POST['select_year'])){
			$s_year = $_POST['select_year'];
			$s_month = $_POST['select_month'];

		$date_result= $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru,G.gazou_path,TM.tm_seisakubutu,SC.school_name,TY.t_naiyou FROM ((((tyuumon TY
										INNER JOIN hinmei HI ON TY.t_hin_name = HI.hin_id)
										INNER JOIN tyuumon_master TM ON TM.tm_id=TY.tm_id)
										INNER JOIN school SC ON TY.school_id=SC.school_id)
										LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
										WHERE TY.t_date	LIKE ?
										ORDER BY TY.t_date DESC LIMIT 10");
		$keyword = $s_year."-".$s_month;//yearとmonthを結合して検索
//		$date_result->bindValue(":keyword", $keyword);
		$result=$date_result;
		$result->execute(array($keyword."%"));
		}

//日付プルダウンに挿入する西暦の取得
$date_pull= $pdo->prepare("SELECT DISTINCT SUBSTR(t_date,1,4)AS t_date FROM tyuumon");
$date_pull->execute();
if (!$date_pull) {
	exit('データを登録できませんでした。日付検索');
}
?>



<div>
<!-------製作物ナンバー検索--------------------------->
<div id="number_search"><b>制作物ナンバーを入力してください。</b>
	<form  method="post" action=""style="float:right">
		<p>制作物ナンバー：<input type="text"value="<?php if(isset($_POST['search_text'])){echo($_POST['search_text']);}?>" style="height:20px; vertical-align: middle;" name="search_text" size="20" maxlength="8" />
		<span style="margin-right: 1em;"></span>
		<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>


<!-------日時ソート-------------------------------------->
<div id="period_sort"><form name="sort_period" method="post"action="">
		<b>年と月を選択してください。</b>
		<p>年：
		<select name = "select_year" >
		<?php while ($date_row = $date_pull -> fetch(PDO::FETCH_ASSOC)){ ?>

			<option value="<?php echo($date_row['t_date']);?>"<?php if(isset($_POST['select_month'])){if($_POST['select_year'] == $date_row['t_date']) { print 'selected';}} ?>><?php echo($date_row['t_date']);?></option>

		<?php }?>
			<option value="99" <?php if(!isset($_POST['select_year'])) { print 'selected';} ?>>選択してください</option>
		</select><span style="margin-right: 1em;"></span>
		月：
		<select name = "select_month" >
			<option value="01" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "01") { print 'selected';}} ?>>1月</option>
			<option value="02" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "02") { print 'selected';}} ?>>2月</option>
			<option value="03" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "03") { print 'selected';}} ?>>3月</option>
			<option value="04" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "04") { print 'selected';}} ?>>4月</option>
			<option value="05" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "05") { print 'selected';}} ?>>5月</option>
			<option value="06" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "06") { print 'selected';}} ?>>6月</option>
			<option value="07" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "07") { print 'selected';}} ?>>7月</option>
			<option value="08" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "08") { print 'selected';}} ?>>8月</option>
			<option value="09" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "09") { print 'selected';}} ?>>9月</option>
			<option value="10" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "10") { print 'selected';}} ?>>10月</option>
			<option value="11" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "11") { print 'selected';}} ?>>11月</option>
			<option value="12" <?php if(isset($_POST['select_month'])){if($_POST['select_month'] == "12") { print 'selected';}} ?>>12月</option>
			<option value="99" <?php if(!isset($_POST['select_month'])) { print 'selected';} ?>>選択してください</option>
		</select><span style="margin-right: 1em;"></span>
		<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>


<!-- -----ソート項目----------------------------- -->

<div id="things_search" >
<form name="sort" method="post"action="">
		<b>項目と条件を選択してください。</b>
		<p>項目：
		<select name = "selectName1" onchange="functionName()">
			<option value="t_naiyou" label="注文内容" 	<?php if(isset($select_Name1)){if($select_Name1 == "t_naiyou") { print 'selected';}} ?>>注文内容</option>
			<option value="hin_janru" label="品名ジャンル" 	<?php if(isset($select_Name1)){if($select_Name1 == "hin_janru") { print 'selected';}} ?>>品名ジャンル</option>
			<option value="school_name" label="学校名" 	<?php if(isset($select_Name1)){if($select_Name1 == "school_name") { print 'selected';}} ?>>学校名</option>
 			<option value="99" <?php if(!isset($select_Name1)) { print 'selected';} ?>>選択してください</option>
		</select><span style="margin-right: 1em;"></span>

		<a>条件：</a>
		<select name = "selectName2">
		</select>
		<span style="margin-right: 1em;"/>
	<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
	</form>
</div>

</div>



<div id="syoruiitiran" style="clear:right;clear:left; margin-top:15em;">


	<?php
		$count=0;
		$kensuu=0;
		while ($row = $result -> fetch(PDO::FETCH_ASSOC))  {
			$t_naiyou=$row['t_naiyou'];
			$img_path=$row['gazou_path'];

		switch ($t_naiyou){  //発注or見積り
			case '0':
				$naiyou = "見積もり";
				break;
			case '1':
				$naiyou = "発注";
				break;
		}

			if($img_path==null){   //画像がないときNoImage.png
				$img_path="img/NoImage.jpg";
			}
			$tm_id =$row['tm_id'];
			if($count%2==0){
				echo"<br clear='left'>";
			}
//			text-align:center;
	//書類情報
echo <<<EOT
	<div id="kensaku">
			<input type="image" src="$img_path" alt="画像" width="140px" height="120px" onclick="location.href='Progress_situation.php?select_id=$tm_id'"/></br>
<div style="float:left;">
EOT;
								echo "製作物ナンバー：",$row['tm_seisakubutu'],"<br/>製作日：",$row['t_date'],"<br />注文内容：",$naiyou,"<br />品名：",$row['hin_janru'],"<br/>学校名：",$row['school_name'];
								echo "<br/></div>";
								$count++;
								$kensuu++;
echo "</div>";
		}
//		echo "object:",$non_oblect;
if ($kensuu==0){
  		echo "<div style='text-align:center; font-size:1.6em; padding:50px 0px 50px 0px;'><a>検索条件に一致する案件はありません。</a></div>";
 // 		unset($non_oblect);
 	 }
//echo "取得件数は".$kensuu."件です。";
?>

</div>

</div>
<?php
     		// MySQL 切断
     		$pdo = null;
    	?>

</body>
</html>
