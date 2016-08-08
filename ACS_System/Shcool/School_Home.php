<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css.css"></link>

<title>学校トップページ</title>
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
include 'School_header.php';
require '../DB.php';
$user_id=$_SESSION['user_id'];
?>
<div id="title">学校トップページ</div>
<?php
	class page{
			//プロパティを定義
			public $True_Flg;
			public $False_Flg;
			public $User_Id;
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
									and TM.tm_sakujo_flg = false and TM.user_id =".$this->User_Id;
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
									and TM.tm_sakujo_flg = false and TM.user_id =".$this->User_Id
									." ORDER BY TY.t_date DESC LIMIT 10";
				if (!($result_tyuumon = $this->pdo->prepare($sql_tyuumon))) {
					echo "クエリ失敗(tyuumon)";
					die;

				}

				$result_tyuumon->execute();
				return $result_tyuumon;
			}
		}
	?>

<table border="1" width="500" align="center" style="margin-bottom:50px;">
	<tr><th><?php echo $user_name;?>さんの進捗状況</th></tr>
	<?php
		$c1 = 0;
		$c2 = 1;
		$array_flg = array("TM.tm_hattyu_flg", "TM.tm_kakunin_flg", "TM.tm_mitumorityuu_flg", "TM.tm_mitumorizumi_flg", "TM.tm_nouhin_flg", "TM.tm_touroku_flg", "TM.tm_houkokusho_flg", "TM.tm_sakujo_flg");
		$array = array("発注済み：", "確認済み：", "見積もり中：", "見積もり済み：", "納品：", "登録済み：", "報告書作成済み：");
		//折りたたみページ
		//折りたたみ展開ポインタ
		while($c1 < 7){
			//クラスオブジェクト作成
			$PAGE = new page($pdo);

			if($c1 < 7){
			//プロパティに値を代入
			$PAGE->True_Flg = $array_flg[$c1];
			$PAGE->False_Flg = $array_flg[$c2];
			$PAGE->User_Id = $user_id;
			}

			//メソッドを実行して結果を取得
			$count = $PAGE->Count();	//件数取得
			$tyuumon = $PAGE->Date();	//案件を更新日時降順10件取得

			echo "<tr><td style=\"background-color:#FFCACA;\">";
			echo "<div onclick=\"obj=document.getElementById('open".$c1."').style; obj.display=(obj.display=='none')?'block':'none';\">";
			echo "<a style=\"cursor:pointer;\">▼".$array[$c1].$count."件</a>";
			echo "</div>";
			//折り畳まれ部分
			echo "<div id=\"open".$c1."\" style=\"display:none;clear:both;\">";
			while($sql = $tyuumon->fetch(PDO::FETCH_ASSOC)){
				$t_naiyou=$sql['t_naiyou'];
				switch($t_naiyou){
					case 0:
						$naiyou="見積り";
						break;
					case 1:
						$naiyou="発注";
				}
				echo  Date('Y年m月d日', strtotime($sql['t_date'])), "　・　", $sql['hin_janru'], "　・　", $naiyou, "<br />";
			}
			echo "</div>";
			$c1++;
			$c2++;
		}
		?>

		</table>
		<?php
     		// MySQL 切断
     		$pdo = null;
    ?>
</body>
</html>