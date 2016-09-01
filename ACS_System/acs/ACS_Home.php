<?php //session_start();?>
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
<style type="text/css">
	table.type1{
border: none;
width:540px;
}
table.type1 tr td {
border-top: none;
padding:3px;
}

table.type1 .odd{
background:#ACDBDA;
text:#000;
}
table.type1 .even{
background:#F0F8FF;
text:#000;
}
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="jquery.floatyHead.min.js"></script>
<script type="text/javascript">
<!--
	$(function() {
	    $('.type1 tr:nth-child(odd)').addClass('odd');
		$('.type1 tr:nth-child(even)').addClass('even');
	});
// -->
</script>

</head>
<body>
	<?php
		//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
		require_once "../DB.php";
	?>
	<?php
		class page{
			//プロパティを定義
			public $True_Flg;
			public $False_Flg;
			public $pdo;


			//メソッドを定義
			function __construct($pdo){
				$this->pdo = $pdo;
			}
			function Count(){
				// MySQL 問い合わせ(件数)
				$sql_count = "SELECT *
								FROM tyuumon_master TM inner join user US on TM.user_id = US.user_id
								WHERE ". $this->True_Flg. " = true and ". $this->False_Flg. " = false
									and TM.tm_sakujo_flg = false";
				if (!($result_count = $this->pdo->prepare($sql_count))) {
					echo "クエリ失敗(count)";
					die;
				}
				//レコード数を調べる
				$result_count->execute();
				$result_set = $result_count->fetchAll();
				$count = count($result_set);

				return $count;
			}

			function Date(){
				//MySQL 問い合わせ(更新降順の注文書)
				$sql_tyuumon = "SELECT TY.t_date, TY.t_naiyou, HI.hin_janru
								FROM ((tyuumon TY inner join hinmei HI on TY.t_hin_name = HI.hin_id)
									inner join tyuumon_master TM on TY.tm_id = TM.tm_id)
									inner join user USER on TM.user_id = USER.user_id
								WHERE ". $this->True_Flg. " = true and ". $this->False_Flg. " = false
									and TM.tm_sakujo_flg = false ORDER BY TY.t_date DESC LIMIT 10";
				if (!($result_tyuumon = $this->pdo->prepare($sql_tyuumon))) {
					echo "クエリ失敗(tyuumon)";
					die;
				}

				$result_tyuumon->execute();
				return $result_tyuumon;
			}
		}
	?>
	<?php
		//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
		require_once "../DB.php";
		include 'acs_header.php';
		?>
		<div id="title">ACSトップページ</div>
<!-- 		<div id="border"></div> -->

	<?php
		//セッションデータ取得
		$user_id = $_SESSION['user_id'];	//ユーザ表.ユーザid
	 	$user_name = $_SESSION['user_name'];//ログイン者名



			//START_折りたたみページ1(発注済み)
				//クラスオブジェクト作成
				$PAGE01 = new page($pdo);

				//プロパティに値を代入
				$PAGE01->True_Flg = "TM.tm_hattyu_flg";
				$PAGE01->False_Flg = "TM.tm_kakunin_flg";

				//メソッドを実行して結果を取得
				$count01 = $PAGE01->Count();	//件数取得
				$tyuumon01 = $PAGE01->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ1
			//START_折りたたみページ2(確認済み)
				//クラスオブジェクト作成
				$PAGE02 = new page($pdo);

				//プロパティに値を代入
				$PAGE02->True_Flg = "TM.tm_kakunin_flg";
				$PAGE02->False_Flg = "TM.tm_mitumorityuu_flg";

				//メソッドを実行して結果を取得
				$count02 = $PAGE02->Count();	//件数取得
				$tyuumon02 = $PAGE02->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ2
			//START_折りたたみページ3(見積もり中)
				//クラスオブジェクト作成
				$PAGE03 = new page($pdo);

				//プロパティに値を代入
				$PAGE03->True_Flg = "TM.tm_mitumorityuu_flg";
				$PAGE03->False_Flg = "TM.tm_mitumorizumi_flg";

				//メソッドを実行して結果を取得
				$count03 = $PAGE03->Count();	//件数取得
				$tyuumon03 = $PAGE03->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ3
			//START_折りたたみページ4(見積もり済み)
				//クラスオブジェクト作成
				$PAGE04 = new page($pdo);

				//プロパティに値を代入
				$PAGE04->True_Flg = "TM.tm_mitumorizumi_flg";
				$PAGE04->False_Flg = "TM.tm_nouhin_flg";

				//メソッドを実行して結果を取得
				$count04 = $PAGE04->Count();	//件数取得
				$tyuumon04 = $PAGE04->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ4
			//START_折りたたみページ5(納品)
				//クラスオブジェクト作成
				$PAGE05 = new page($pdo);

				//プロパティに値を代入
				$PAGE05->True_Flg = "TM.tm_nouhin_flg";
				$PAGE05->False_Flg = "TM.tm_touroku_flg";

				//メソッドを実行して結果を取得
				$count05 = $PAGE05->Count();	//件数取得
				$tyuumon05 = $PAGE05->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ5
			//START_折りたたみページ6(登録済み)
				//クラスオブジェクト作成
				$PAGE06 = new page($pdo);

				//プロパティに値を代入
				$PAGE06->True_Flg = "TM.tm_touroku_flg";
				$PAGE06->False_Flg = "TM.tm_houkokusho_flg";

				//メソッドを実行して結果を取得
				$count06 = $PAGE06->Count();	//件数取得
				$tyuumon06 = $PAGE06->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ6
			//START_折りたたみページ7(報告書入力済み)
				//クラスオブジェクト作成
				$PAGE07 = new page($pdo);

				//プロパティに値を代入
				$PAGE07->True_Flg = "TM.tm_houkokusho_flg";
				$PAGE07->False_Flg = "TM.tm_sakujo_flg";

				//メソッドを実行して結果を取得
				$count07 = $PAGE07->Count();	//件数取得
				$tyuumon07 = $PAGE07->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ6

		?>

	<div id="shounin" style="width:20em; margin:20px auto; align:center;">
		<center><a><?php echo $user_name;?>さんの進捗状況</a></center>
	</div>
<div>
<table width="500" align="center" style="margin-bottom:50px;">
		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ1  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open01').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; text-color:#fff; padding:15px;">▼発注済み：<?php echo "$count01"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open01" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou1=$sql01['t_naiyou'];
						switch($t_naiyou1){
							case 0:
								$naiyou1="見積り";
								break;
							case 1:
								$naiyou1="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql01['t_date'])), "　・　", $sql01['hin_janru'], "　・　", $naiyou1, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ1  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ2  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open02').style; obj.display=(obj.display=='none')?'block':'none';">
				<h style="cursor:pointer;padding:15px;">▼確認済み：<?php echo "$count02"; ?>件</h>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open02" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql02 = $tyuumon02->fetch(PDO::FETCH_ASSOC)){
						echo "<tr><td>";
						$t_naiyou2=$sql02['t_naiyou'];
						switch($t_naiyou2){
							case 0:
								$naiyou2="見積り";
								break;
							case 1:
								$naiyou2="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql02['t_date'])), "　・　", $sql02['hin_janru'], "　・　", $naiyou2, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ2  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ3  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open03').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; padding:5px;">▼見積もり中：<?php echo "$count03"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open03" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql03 = $tyuumon03->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou=$sql03['t_naiyou'];
						switch($t_naiyou){
							case 0:
								$naiyou3="見積り";
								break;
							case 1:
								$naiyou3="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql03['t_date'])), "　・　", $sql03['hin_janru'], "　・　", $naiyou3, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ3  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ4  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open04').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; padding:5px;">▼見積もり済み：<?php echo "$count04"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open04" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql04 = $tyuumon04->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou4=$sql04['t_naiyou'];
						switch($t_naiyou4){
							case 0:
								$naiyou4="見積り";
								break;
							case 1:
								$naiyou4="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql04['t_date'])), "　・　", $sql04['hin_janru'], "　・　", $naiyou4, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ4  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ5  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open05').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; padding:5px;">▼納品：<?php echo "$count05"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open05" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql05 = $tyuumon05->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou5=$sql05['t_naiyou'];
						switch($t_naiyou5){
							case 0:
								$naiyou5="見積り";
								break;
							case 1:
								$naiyou5="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql04['t_date'])), "　・　", $sql05['hin_janru'], "　・　", $naiyou5, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->

		</td></tr><!-- //折りたたみページ5  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ6  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open06').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; padding:5px;">▼登録済み：<?php echo "$count06"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open06" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql06 = $tyuumon06->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou6=$sql06['t_naiyou'];
						switch($t_naiyou6){
							case 0:
								$naiyou6="見積り";
								break;
							case 1:
								$naiyou6="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql06['t_date'])), "　・　", $sql06['hin_janru'], "　・　", $naiyou6, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ6  -->

		<tr><td style="background-color:#6491C7;"><!-- 折りたたみページ7  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open07').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer; padding:5px;">▼報告書入力済み：<?php echo "$count07"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open07" style="display:none;clear:both;">
			<table class="type1" width="500" border="none">
				<?php
					while($sql07 = $tyuumon07->fetch(PDO::FETCH_ASSOC)){
					echo "<tr><td>";
						$t_naiyou7=$sql07['t_naiyou'];
						switch($t_naiyou7){
							case 0:
								$naiyou7="見積り";
								break;
							case 1:
								$naiyou7="発注";
						}
						echo  Date('Y年m月d日', strtotime($sql07['t_date'])), "　・　", $sql07['hin_janru'], "　・　", $naiyou7, "</td></tr>";
					}
				?></table>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ7  -->

		</table>
		</div>
		<?php
     		// MySQL 切断
     		$pdo = null;
    	?>
</body>
</html>