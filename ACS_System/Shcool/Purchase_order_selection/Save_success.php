<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>保存</title>
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
<body>
<?php
	require '../../DB.php';			//DB.php呼び出し
?>
<div id="header">
	<div id="top">
		<input type="button" name="top" value="TOP" onclick="location.href='/acs_system/Shcool/School_Home.php'" />
	</div>
	<div id="login_name"><?php echo $_SESSION['user_name'];?>さん</div>
</div>
<div id="select_menu" style="clear:left;">
	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../Login/Logout.php">ログアウト</a></li>
			</ul>
		</li>
		<li>注文機能
			<ul style="list-style:none;">
				<li><a href="#">新規注文書</a></li>
				<li><a href="#">注文書選択</a></li>
			</ul>
		</li>
		<li>書類
			<ul style="list-style:none;">
				<li><a href="Document_Browsing/Image_selection.php">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="progress/Purchase_order_selection.php">進捗管理</a></li>
			</ul>
		</li>
	</ul>
</div>
<div id="main">
	<div id="border"></div>
	<div id="title">保存：成功</div>
<?php
	$Flg = True;										//未入力項目を探すときに使う
	$id = $_POST['id'];									//注文id
	$date = $_POST['date'];								//日付
	if(empty($date) or $date === ""){
		$Flg = False;
	}
	$t_naiyou = $_POST['t_naiyou'];						//見積もり・発注
	$school_id = $_POST['school_id'];					//学校名
	$name = $_POST['name'];								//部署名
	$user_name = $_POST['user_name'];					//担当者名
	if(empty($user_name) or $user_name === ""){
		$Flg = False;
	}
	$user_tel = $_POST['user_tel'];						//電話番号
	if(empty($user_tel) or $user_tel === ""){
		$Flg = False;
	}
	$hin_id = $_POST['hin_id'];							//品名
	$t_bikou = $_POST['t_bikou'];						//備考
	$gakubu_id = $_POST['gakubu_id'];					//利用する学部系
	$t_mokuteki = $_POST['t_mokuteki'];					//利用目的
	if(empty($t_mokuteki) or $t_mokuteki === ""){
		$Flg = False;
	}
	$t_size = $_POST['t_size'];							//仕様：サイズ
	$t_page = $_POST['t_page'];							//仕様：ページ
	$t_color = $_POST['t_color'];						//仕様：色数
	$t_men = $_POST['t_men'];							//仕様：片面・両面
	$t_kami = $_POST['t_kami'];							//仕様：紙
	$t_orikata = $_POST['t_orikata'];					//仕様：折り方
	$t_busu = $_POST['t_busu'];							//部数
	$t_kiboubi = $_POST['t_kiboubi'];					//納品希望日
	$t_basho = $_POST['t_basho'];						//希望納品場所
	$t_money = $_POST['t_money'];						//希望金額
	$t_youbou = $_POST['t_youbou'];						//仕様の要望
	$t_sakunen_jisseki = $_POST['t_sakunen_jisseki'];	//昨年制作物の有無
	$t_sakunen_money = $_POST['t_sakunen_money'];		//昨年実績費用
	$t_zei_hantei = $_POST['t_zei_hantei'];				//税込・税抜き
	$t_sakunen_busu = $_POST['t_sakunen_busu'];			//昨年：部数
	$t_sakunen_size = $_POST['t_sakunen_size'];			//昨年：サイズ
	$t_sakunen_page = $_POST['t_sakunen_page'];			//昨年：ページ
	$t_sakunen_color = $_POST['t_sakunen_color'];		//昨年：色数
	$t_sakunen_men = $_POST['t_sakunen_men'];			//昨年：片面・両面
	$t_sakunen_kami = $_POST['t_sakunen_kami'];			//昨年：紙
	$t_sakunen_orikata = $_POST['t_sakunen_orikata'];	//昨年：折り方
	$t_sakunen_basho = $_POST['t_sakunen_basho'];		//昨年：発注先
	$t_sakunen_tantou = $_POST['t_sakunen_tantou'];		//昨年：担当者
	if($t_naiyou === 'est'){//ラジオボタンが見積もりを選んだのかを判定
		$t_naiyou = 0;
	}
	else{
		$t_naiyou = 1;
	}
	if($t_men ==='kata'){//ラジオボタンが片面を選んだのかを判定
		$t_men = "片面";
	}
	else{
		$t_men = "両面";
	}
	if($t_sakunen_jisseki ==='yes'){//ラジオボタンが昨年実績があるを選んだのかを判定
		$t_sakunen_jisseki = True;
	}
	else{
		$t_sakunen_jisseki = False;
	}
	if($t_zei_hantei === 'komi'){//ラジオボタンが税込を選んだのかを判定
		$t_zei_hantei = True;
	}
	else{
		$t_zei_hantei = False;
	}
	if($t_sakunen_men === 'kata'){//ラジオボタンが片面を選んだのかを判定
			$t_sakunen_men = "片面";
	}
	else{
		$t_sakunen_men = "両面";
	}
//	if($Flg){//未入力項目がなければ、update文を実行
		$sql = "UPDATE tyuumon
				SET t_date = :date, t_naiyou = :naiyou, school_id = :school, t_busho = :busho,
					t_gakubu = :gakubu, t_tantousha = :tantou, t_tel = :tel, t_hin_name = :hin,
					t_bikou = :bikou, t_mokuteki = :mokuteki, t_size = :size, t_page = :page,
					t_color = :color, t_men = :men, t_kami = :kami, t_orikata = :orikata,
					t_busu = :busu, t_kiboubi = :kiboubi, t_basho = :basho, t_money = :money,
					t_youbou = :youbou, t_sakunen_jisseki = :s_jisseki,
					t_sakunen_hiyou = :s_hiyou, t_zei_hantei = :zei, t_sakunen_busu = :s_busu,
					t_sakunen_size = :s_size, t_sakunen_page = :s_page, t_sakunen_color = :s_color,
					t_sakunen_men = :s_men, t_sakunen_kami = :s_kami, t_sakunen_orikata = :s_orikata,
					t_sakunen_basho = :s_basho, t_sakunen_tantou = :s_tantou
				WHERE tm_id = :id";
		$update = $pdo->prepare($sql);
		$params = array(':date' => $date, ':naiyou' => $t_naiyou, ':school' => $school_id, ':busho' => $name,
						':gakubu' =>$gakubu_id, ':tantou' => $user_name, ':tel' => $user_tel, ':hin' => $hin_id,
						':bikou' => $t_bikou, ':mokuteki' => $t_mokuteki, ':size' => $t_size, ':page' => $t_page,
						':color' => $t_color, ':men' => $t_men, ':kami' => $t_kami, ':orikata' => $t_orikata,
						':busu' => $t_busu, ':kiboubi' => $t_kiboubi, ':basho' => $t_basho, ':money' => $t_money,
						':youbou' => $t_youbou, ':s_jisseki' => $t_sakunen_jisseki,
						':s_hiyou' => $t_sakunen_money, ':zei' => $t_zei_hantei, ':s_busu' => $t_sakunen_busu,
						':s_size' => $t_sakunen_size, ':s_page' => $t_sakunen_page, ':s_color' => $t_sakunen_color,
						':s_men' => $t_sakunen_men, ':s_kami' => $t_sakunen_kami, ':s_orikata' => $t_sakunen_orikata,
						':s_basho' => $t_sakunen_basho, ':s_tantou' => $t_sakunen_tantou, ':id' => $id);
		$success_flg = $update->execute($params);

		if(!$success_flg) var_dump($update->errorInfo());
//	}
//	else{
//		header("Location: ".$_SERVER['HTTP_REFERER']. "&message_error=1");
//	}
?>
<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='Selection.php'" />
</div>
</div>
</body>
</html>