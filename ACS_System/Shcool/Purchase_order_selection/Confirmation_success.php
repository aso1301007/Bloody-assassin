<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
<title>注文書選択</title>
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
<script>
    //未記入項目があったかを判定
    function OnButtonClick(Flg, id){//送信ボタンを押したらURLにget送信
		if(Flg){
        	location.href = "Successful_transmission.php?id=" + id;
        	return false;
		}
		else{
			alert("未記入項目があります。「編集」ボタンを押して未記入項目に入力してください。");
		}
    }
</script>
<style>
<!--
table
{mso-displayed-decimal-separator:"\.";
mso-displayed-thousand-separator:"\,";}
@page
{margin:.75in .7in .75in .7in;
mso-header-margin:.3in;
mso-footer-margin:.3in;}
-->
</style>
</head>
<body>
<?php
include '../School_header.php';
	require '../../DB.php';			//DB.php呼び出し
?>
<div id="title">注文書選択</div>
<?php
	class is_null{
		//プロパティを定義
		public $variable;
		public $Flg;

		function null_jud(){//項目が未記入を判定
			$var = $this->variable;
			if(empty($var)){//null判定
				$return = "未記入";
				return $return;
			}
			else{
				return $var;
			}

		}
		function Flg(){//未記入項目があるとフラグを変える
			$var = $this->variable;
			$Flg = $this->Flg;
			if(empty($var)){//null判定
				$return = False;
				return $return;
			}
			if($Flg){
				return $Flg;
			}
			else{
				return $Flg;
			}
		}
	}
?>
<!-- <div id="header">
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
</div> -->

<!--  佐藤追加分  -->
<?php
	$err_message = "";

	// submit されたら遷移  
	if (isset($_POST['mode']) && $_POST['mode'] == "check") {
		if(isset($_POST['tyuumonsha']) && isset($_POST['comment'])){
			$_SESSION['destination_id'] = $_POST['tyuumonsha'];
			$_SESSION['comment'] = $_POST['comment'];
		}
		header("Location: ./shounin_kakunin.php");
		exit();
	}

	//  GETでIDを受け取り必要なデータを用意する
	if(isset($_GET['id'])){
		require_once(dirname(__FILE__). "/bin/DB_Manager.php");
		require_once(dirname(__FILE__) .'/bin/common.php');
		
		$tm_id = $_SESSION['tm_id'] = $_GET['id'];
		$user_id = $_SESSION['user_id'];  // ログインしているユーザのID
		$send_available_flg = false;

		$db = new DB_Manager();
		$arr_tyumon = $db->select_tyuumon_by_id($tm_id);
		$tyuumon_creater_flg = $db->check_created_tyuumon_by_id($tm_id, $user_id);

		$db->set_shounin_arr($tm_id);  // 承認表関係の取得関数を使うための準備
		$arr_my_shounin = $db->get_my_shounin_by_id($user_id);  // ログイン者の承認がなければfalse
		$finished_shounin_flg = $db->check_finished_shounin();  // 最終承認がなされているか
		$created_shounin_flg = $db->check_created_shounin_by_id($user_id);  // 承認フローがログイン者によって作られているか

		// 承認が終わっていて、かつログインしている人が申請者だった場合
		if($created_shounin_flg && $finished_shounin_flg){
			// todo:ACSに送信するボタンを挿入する
			$send_available_flg = true;
		}
		else{
			$select_content = "";

			// 承認フローがある場合
			if($arr_my_shounin){
			// if(true){
				// 申請者の場合のセレクターを用意
				if($created_shounin_flg){
				// if(false){
					$select_content = <<<HTML
						<select name="select_action" id="select_action">
							<option value="">選択してください</option>
							<option value="shounin_sinsei">承認申請</option>
						</select>
HTML;
				}
				// 承認者の場合のセレクターを用意
				else{
					$select_content = <<<HTML
						<select name="select_action" id="select_action">
							<option value="">選択してください</option>
							<option value="shounin">承認</option>
							<option value="sasimodosi">差し戻し</option>
							<option value="last_shounin">最終承認</option>
						</select>
HTML;
				}

			}
			// 承認フローがまだない場合
			else{
				// todo: 注文書を作った人かどうかの判定も必要？
				if($db->check_empty_shounin_master()){
					$select_content = <<<HTML
						<select name="select_action" id="select_action">
							<option value="">選択してください</option>
							<option value="shounin_sinsei">承認申請</option>
						</select>
HTML;
				}
				else{
					$select_content = <<<HTML
						<p>この注文書は承認待中です</p>
HTML;
				}
			}
				//返してきたデータを表示
				$select_content .= <<<HTML
					<div id='result'></div>	
HTML;
		}
	}
	// GETでidがなければエラーにする
	else{
		$err_message = "不正なURLでアクセスされました";
	}


?>

<!-- 追加分ここまで -->
<div id="main">
<?php	//DBから発注書の内容を検索


	//DBから発注書の内容を検索
	$id = $_REQUEST["id"];	//Selection.phpから選択した項目の注文idを受け取る
	$sql = "SELECT *
			FROM tyuumon t1 inner join tyuumon_master t2 on t1.tm_id = t2.tm_id
				inner join school s1 on t1.school_id = s1.school_id
				inner join hinmei h1 on t1.t_hin_name = h1.hin_id
				inner join gakubu g1 on t1.t_gakubu = g1.gakubu_id
			WHERE t1.tm_id = ". $id;
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute();
	if(!$result_sql) var_dump($result_sql->errorInfo());
	$SQL = $result_sql->fetch(PDO::FETCH_ASSOC);
?>

<?php //検索したデータを加工
	$Flg = True;	//未記入項目があるのかどうかを判定する変数	//年、月、日に変換
	$year = date('Y', strtotime($SQL['t_date']));
	$month = date('m', strtotime($SQL['t_date']));
	$day = date('d', strtotime($SQL['t_date']));
	//年のnull判定
	$jud_year = new is_null();
	$jud_year->variable = $year;
	$jud_year->Flg = $Flg;
	$year = $jud_year->null_jud();
	$Flg = $jud_year->Flg();
	//月のnull判定
	$jud_month = new is_null();
	$jud_month->variable = $month;
	$jud_month->Flg = $Flg;
	$month = $jud_month->null_jud();
	$Flg = $jud_month->Flg();
	//日のnull判定
	$jud_day = new is_null();
	$jud_day->variable = $day;
	$jud_day->Flg = $Flg;
	$day = $jud_day->null_jud();
	$Flg = $jud_day->Flg();

	//見積もり・発注
	$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" disabled />見積もり</td>";
	$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" disabled />発注</td>";
	switch($SQL['t_naiyou']){
		case 0:
			$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" checked disabled />見積もり</td>";
			break;

		case 1:
		$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" checked disabled />発注</td>";
		break;
	}
	//学校名
	$school_id = $SQL['school_id'];
	$school_name = $SQL['school_name'];
	//学校名のnull判定
	$jud_school_name = new is_null();
	$jud_school_name->variable = $school_name;
	$jud_school_name->Flg = $Flg;
	$school_name = $jud_school_name->null_jud();
	$Flg = $jud_school_name->Flg();

	//部署名
	$department_name = $SQL['t_busho'];
	//部署名のnull判定
	$jud_department_name = new is_null();
	$jud_department_name->variable = $department_name;
	$jud_department_name->Flg = $Flg;
	$department_name = $jud_department_name->null_jud();
	$Flg = $jud_department_name->Flg();

	//担当者名
	$responsible_party = $SQL['t_tantousha'];
	//担当者名のnull判定
	$jud_responsible_party = new is_null();
	$jud_responsible_party->variable = $responsible_party;
	$jud_responsible_party->Flg = $Flg;
	$responsible_party = $jud_responsible_party->null_jud();
	$Flg = $jud_responsible_party->Flg();

	//電話番号
	$phone_number = $SQL['t_tel'];
	//電話番号のnull判定
	$jud_phone_number = new is_null();
	$jud_phone_number->variable = $phone_number;
	$jud_phone_number->Flg = $Flg;
	$phone_number = $jud_phone_number->null_jud();
	$Flg = $jud_phone_number->Flg();

	//品名
	$product_id = $SQL['hin_id'];
	$product_name = $SQL['hin_janru'];
	//品名のnull判定
	$jud_product_name = new is_null();
	$jud_product_name->variable = $product_name;
	$jud_product_name->Flg = $Flg;
	$product_name = $jud_product_name->null_jud();
	$Flg = $jud_product_name->Flg();

	//備考
	$remarks = $SQL['t_bikou'];


	//利用する学部系
	$undergraduate_id = $SQL['gakubu_id'];
	$undergraduate = $SQL['gakubu_name'];
	//学部系のnull判定
	$jud_undergraduate = new is_null();
	$jud_undergraduate->variable = $undergraduate;
	$jud_undergraduate->Flg = $Flg;
	$undergraduate = $jud_undergraduate->null_jud();
	$Flg = $jud_undergraduate->Flg();

	//利用目的
	$purpose = $SQL['t_mokuteki'];
	//利用目的のnull判定
	$jud_purpose = new is_null();
	$jud_purpose->variable = $purpose;
	$jud_purpose->Flg = $Flg;
	$purpose = $jud_purpose->null_jud();
	$Flg = $jud_purpose->Flg();

	//仕様
	//サイズ
	$specification_size =  $SQL['t_size'];
	//サイズのnull判定
	$jud_specification_size = new is_null();
	$jud_specification_size->variable = $specification_size;
	$jud_specification_size->Flg = $Flg;
	$specification_size = $jud_specification_size->null_jud();
	$Flg = $jud_specification_size->Flg();
	//ページ数
	$specification_page =  $SQL['t_page'];
	//ページのnull判定
	$jud_specification_page = new is_null();
	$jud_specification_page->variable = $specification_page;
	$jud_specification_page->Flg = $Flg;
	$specification_page = $jud_specification_page->null_jud();
	$Flg = $jud_specification_page->Flg();
	//色数
	$specification_color =  $SQL['t_color'];
	//色数のnull判定
	$jud_specification_color = new is_null();
	$jud_specification_color->variable = $specification_color;
	$jud_specification_color->Flg = $Flg;
	$specification_color = $jud_specification_color->null_jud();
	$Flg = $jud_specification_color->Flg();
	//紙
	$specification_kami =  $SQL['t_kami'];
	//紙のnull判定
	$jud_specification_kami = new is_null();
	$jud_specification_kami->variable = $specification_kami;
	$jud_specification_kami->Flg = $Flg;
	$specification_kami = $jud_specification_kami->null_jud();
	$Flg = $jud_specification_kami->Flg();
	//折り方
	$specification_orikata =  $SQL['t_orikata'];
	//折り方のnull判定
	$jud_specification_orikata = new is_null();
	$jud_specification_orikata->variable = $specification_orikata;
	$jud_specification_orikata->Flg = $Flg;
	$specification_orikata = $jud_specification_orikata->null_jud();
	$Flg = $jud_specification_orikata->Flg();
	//仕様(ラジオボタン)
	$k_men = "<input type=\"radio\" name=\"t_men\" value=\"kata\" disabled />片面</td>";
	$r_men = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" disabled />両面</td>";
	switch($SQL['t_men']){
		case '片面':
			$k_men = "<input type=\"radio\" name=\"t_men\" value=\"kata\" checked disabled />片面</td>";
			break;

		case '両面':
			$r_men = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" checked disabled />両面</td>";
			break;
	}

	//部数
	$copies_number = $SQL['t_busu'];
	//部数のnull判定
	$jud_copies_number = new is_null();
	$jud_copies_number->variable = $copies_number;
	$jud_copies_number->Flg = $Flg;
	$copies_number = $jud_copies_number->null_jud();
	$Flg = $jud_copies_number->Flg();

	//納品希望日
	$pefeeferred_date = $SQL['t_kiboubi'];
	//納品希望日のnull判定
	$jud_pefeeferred_date = new is_null();
	$jud_pefeeferred_date->variable = $pefeeferred_date;
	$jud_pefeeferred_date->Flg = $Flg;
	$pefeeferred_date = $jud_pefeeferred_date->null_jud();
	$Flg = $jud_pefeeferred_date->Flg();


	//希望納品場所
	$dsired_locat = $SQL['t_basho'];
	//希望納品場所のnull判定
	$jud_dsired_locat = new is_null();
	$jud_dsired_locat->variable = $dsired_locat;
	$jud_dsired_locat->Flg = $Flg;
	$dsired_locat = $jud_dsired_locat->null_jud();
	$Flg = $jud_dsired_locat->Flg();

	//希望金額
	$hope_amount_of_money = $SQL['t_money'];
	//希望金額のnull判定
	$jud_hope_amount_of_money = new is_null();
	$jud_hope_amount_of_money->variable = $hope_amount_of_money;
	$jud_hope_amount_of_money->Flg = $Flg;
	$hope_amount_of_money = $jud_hope_amount_of_money->null_jud();
	$Flg = $jud_hope_amount_of_money->Flg();

	//仕様の要望
	$demand_of_specification = $SQL['t_youbou'];
	//仕様の要望のnull判定
	$jud_demand_of_specification = new is_null();
	$jud_demand_of_specification->variable = $demand_of_specification;
	$jud_demand_of_specification->Flg = $Flg;
	$demand_of_specification = $jud_demand_of_specification->null_jud();
	$Flg = $jud_demand_of_specification->Flg();

	//昨年製作実績の有無
	$last_year_T = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" disabled />あり</td>";
	$last_year_F = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" disabled />なし</td>";
	if($SQL['t_sakunen_jisseki']){//実績あり
		$last_year_T = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" checked disabled />あり</td>";
		//昨年実績
		//昨年費用
		$last_year_actual_expenses = $SQL['t_sakunen_hiyou'];
		//昨年費用のnull判定
		$jud_last_year_actual_expenses = new is_null();
		$jud_last_year_actual_expenses->variable = $last_year_actual_expenses;
		$jud_last_year_actual_expenses->Flg = $Flg;
		$last_year_actual_expenses = $jud_last_year_actual_expenses->null_jud();
		$Flg = $jud_last_year_actual_expenses->Flg();
		//税込
		$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" disabled />(税込み)</td>";
		//税抜
		$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" disabled />(税抜き)</td>";
		if($SQL['t_zei_hantei']){
			$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" checked disabled />(税込み)</td>";
		}
		else{
			$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" checked disabled />(税抜き)</td>";
		}
		//昨年部数
		$last_year_copies_number = $SQL['t_sakunen_busu'];
		//昨年部数のnull判定
		$jud_last_year_copies_number = new is_null();
		$jud_last_year_copies_number->variable = $last_year_copies_number;
		$jud_last_year_copies_number->Flg = $Flg;
		$last_year_copies_number = $jud_last_year_copies_number->null_jud();
		$Flg = $jud_last_year_copies_number->Flg();
		//昨年仕様(サイズ)
		$last_year_specification_size = $SQL['t_sakunen_size'];
		//昨年サイズのnull判定
		$jud_last_year_specification_size = new is_null();
		$jud_last_year_specification_size->variable = $last_year_specification_size;
		$jud_last_year_specification_size->Flg = $Flg;
		$last_year_specification_size = $jud_last_year_specification_size->null_jud();
		$Flg = $jud_last_year_specification_size->Flg();
		//昨年仕様(ページ数)
		$last_year_specification_page = $SQL['t_sakunen_page'];
		//昨年ページのnull判定
		$jud_last_year_specification_page = new is_null();
		$jud_last_year_specification_page->variable = $last_year_specification_page;
		$jud_last_year_specification_page->Flg = $Flg;
		$last_year_specification_page = $jud_last_year_specification_page->null_jud();
		$Flg = $jud_last_year_specification_page->Flg();
		//昨年仕様(色数)
		$last_year_specification_color = $SQL['t_sakunen_color'];
		//昨年色数のnull判定
		$jud_last_year_specification_color = new is_null();
		$jud_last_year_specification_color->variable = $last_year_specification_color;
		$jud_last_year_specification_color->Flg = $Flg;
		$last_year_specification_color = $jud_last_year_specification_color->null_jud();
		$Flg = $jud_last_year_specification_color->Flg();
		//昨年仕様(紙)
		$last_year_specification_kami = $SQL['t_sakunen_kami'];
		//昨年紙のnull判定
		$jud_last_year_specification_kami = new is_null();
		$jud_last_year_specification_kami->variable = $last_year_specification_kami;
		$jud_last_year_specification_kami->Flg = $Flg;
		$last_year_specification_kami = $jud_last_year_specification_kami->null_jud();
		$Flg = $jud_last_year_specification_kami->Flg();
		//昨年仕様(折り方)
		$last_year_specification_orikata = $SQL['t_sakunen_orikata'];
		//昨年紙のnull判定
		$jud_last_year_specification_orikata = new is_null();
		$jud_last_year_specification_orikata->variable = $last_year_specification_orikata;
		$jud_last_year_specification_orikata->Flg = $Flg;
		$last_year_specification_orikata = $jud_last_year_specification_orikata->null_jud();
		$Flg = $jud_last_year_specification_orikata->Flg();
		//仕様(ラジオボタン)
		$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" disabled />片面</td>";
		$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" disabled />両面</td>";
		switch($SQL['t_sakunen_men']){
			case '片面':
				$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" checked disabled />片面</td>";
				break;

			case '両面':
				$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" checked disabled />両面</td>";
				break;
		}
		//昨年発注先
		$last_year_ordering_destination = $SQL['t_sakunen_basho'];
		//昨年発注先のnull判定
		$jud_last_year_ordering_destination = new is_null();
		$jud_last_year_ordering_destination->variable = $last_year_ordering_destination;
		$jud_last_year_ordering_destination->Flg = $Flg;
		$last_year_ordering_destination = $jud_last_year_ordering_destination->null_jud();
		$Flg = $jud_last_year_ordering_destination->Flg();
		//昨年担当者
		$the_person_in_charge = $SQL['t_sakunen_tantou'];
		//昨年担当者のnull判定
		$jud_the_person_in_charge = new is_null();
		$jud_the_person_in_charge->variable = $the_person_in_charge;
		$jud_the_person_in_charge->Flg = $Flg;
		$the_person_in_charge = $jud_the_person_in_charge->null_jud();
		$Flg = $jud_the_person_in_charge->Flg();
	}
	else{
		$last_year_F = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" checked disabled />なし</td>";
		//昨年実績
		$last_year_actual_expenses = "";		//費用
		$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" disabled />(税込み)</td>";	//税込
		$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" disabled />(税抜き)</td>";	//税抜
		$last_year_copies_number = "";			//部数
		$last_year_specification_size = "";		//仕様(サイズ)
		$last_year_specification_page = "";		//仕様(ページ数)
		$last_year_specification_color = "";	//仕様(色数)
		$last_year_specification_kami = "";		//仕様(紙)
		$last_year_specification_orikata = "";	//仕様(折り方)
		$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" disabled />片面</td>";	//仕様(ラジオボタン)
		$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" disabled />両面</td>";	//仕様(ラジオボタン)
		$last_year_ordering_destination = "";	//発注先
		$the_person_in_charge = "";				//担当者
	}



	//注文書承認
//	$order_approval = "";

?>
<input type="hidden" name="id" value="<?php echo $school_id;?>" />
<input type="hidden" name="gakubu_id" value="<?php echo $undergraduate_id;?>" />
<input type="hidden" name="hin_id" value="<?php echo $product_id;?>" />
<table border="0px" width="713px" style='border-collapse: collapse;table-layout:fixed;width:529pt' align = "center">
<col width="31px" span="23px" style='width: 23pt;' />
<tr style='height: 27.0pt;'>
<td height="36px" width="31px" style='height:27.0pt;width:23pt;' />
<?php
$c = 0;
while($c < 12){
	echo "<td width=\"31px\" style='width:23pt' />";
	$c++;
}
?></tr>

<tr style='mso-height-source:userset;height:27.0pt;'>
<td height="36px" style='height:27.0pt' />
<td class="xl65">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td class=\"xl66\">　</td>";
	$c++;
}
?>
<td class="xl67">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}
echo "<td colspan=\"4\" class=\"xl115\">注文書</td>";//題名
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 4){
	echo "<td />";
	$c++;
}
echo "<td class=\"xl70\" />";
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}?>
<td colspan ="2">
<input type="text" name="year" size = "1" maxlength = "4" value="<?php echo $year; ?>" disabled="disabled" /></td>
<td>年</td>
<td><input type="text" name="month" size = "2" maxlength = "2" class = "two" value="<?php echo $month; ?>" disabled="disabled" /></td>
<td>月</td>
<td><input type="text" name="date" size = "2" maxlength = "2" class = "two" value="<?php echo $day; ?>" disabled="disabled" /></td>
<td>日</td>
<td class="xl69" />
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>注文内容</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<?php
echo "<td class=\"xl71\" colspan=\"3\" style='mso-ignore:colspan'>";
echo $estimate;
$c = 0;
while($c < 4){
	echo "<td class=\"xl71\">　</td>";
	$c++;
}
echo "<td class=\"xl71\" colspan=\"2\" style='mso-ignore:colspan'>";
echo $order;
$c = 0;
while($c < 4){
	echo "<td class=\"xl71\">　</td>";
	$c++;
}
?>
<td class="xl72">　</td>
<td class="xl69">　</td>
</tr>

<tr>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>学校名</td>
<td colspan="8" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="school_name" maxlength="25" class = "one" value = "<?php echo $school_name;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>部署名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="name" maxlength="15" class = "one" value = "<?php echo $department_name;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr  style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>ご担当者名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_name" maxlength="15" class = "one" value = "<?php echo $responsible_party;?>" disabled="disabled" /></td>
<td colspan="4"class="xl89" style='border-right:.5pt solid black;border-left:none'>お電話番号</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_tel" maxlength="11" class = "one" value = "<?php echo $phone_number;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl114" style='border-right:.5pt solid black'>品名</td>
<td colspan="6">
<input type="text" name="product_name" class = "one" value = "<?php echo $product_name;?>" disabled="disabled" /></td>
<td colspan="3" class="xl114" style='border-right:.5pt solid black'>備考</td>
<td colspan="7" class="xl114" style='border-right:.5pt solid black;border-bottom:border-left:none'>
<textarea name="t_bikou" rows="2" wrap="soft" maxlength = "255" class = "one" disabled="disabled"><?php echo $remarks;?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>利用する学部系</td>
<td colspan="6" class="xl89" style='border-left:none'>
<input type="text" name="gakubu_name" maxlength="20" class = "one" value = "<?php echo $undergraduate;?>" disabled="disabled" /></td>
<td colspan="3" class="xl111" style='border-right:.5pt solid black'>利用目的</td>
<td colspan="7" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<textarea name="t_mokuteki" rows="2" wrap="soft" maxlength = "255" class = "one" disabled="disabled"><?php echo $purpose;?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>仕様</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>サイズ</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_size" maxlength="2" class = "three" value = "<?php echo $specification_size;?>" disabled="disabled" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_page" maxlength="3" class = "three" value = "<?php echo $specification_page;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_color" maxlength="3" class = "three" value = "<?php echo $specification_color;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
echo "<td colspan=\"3\" class=\"xl90\">";
echo $k_men;
echo "<td colspan=\"3\" class=\"xl90\" style='border-right:.5pt solid black'>";
echo $r_men;
?>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kami" maxlength="10" class = "one" value = "<?php echo $specification_kami;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_orikata" maxlength="10" class = "one" value = "<?php echo $specification_orikata;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>部数</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_busu" maxlength="7" class = "five" value = "<?php echo $copies_number;?>" disabled="disabled" />部</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kiboubi" maxlength="20" class = "one" value = "<?php echo $pefeeferred_date;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望納品場所</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_basho" maxlength="60" class = "one" value = "<?php echo $dsired_locat;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>
<tr>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望金額</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_money" maxlength="8" class = "six money" value = "<?php echo $hope_amount_of_money;?>" disabled="disabled" />円</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>仕様の要望</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_youbou" class = "one" value = "<?php echo $demand_of_specification;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl108" style='border-right:.5pt solid black'>昨年制作実績の有無</td>
<td class="xl73" style='border-top:none;border-left:none'>　</td>
<td class="xl71" style='border-top:none'>　</td>
<?php
echo "<td colspan=\"5\" class=\"xl90\">";
echo $last_year_T;
?>
<td class="xl71" style='border-top:none'>　</td>
<?php
echo "<td colspan=\"5\" class=\"xl90\">";
echo $last_year_F;
?>
<td class="xl71" style='border-top:none'>　</td>
<td class="xl71" style='border-top:none'>　</td>
<td class="xl72" style='border-top:none'>　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<?php
$c = 0;
while($c < 16){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-bottom:.5pt solid black'>昨年実績費用</td>
<td colspan="8" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="text" name="t_sakunen_money" maxlength="8" class = "six money" value = "<?php echo $last_year_actual_expenses;?>" disabled="disabled" />円</td>
<td rowspan="2" class="xl94" style='border-bottom:.5pt solid black'>　</td>
<?php
echo "<td colspan=\"3\" rowspan=\"2\" class=\"xl95\" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>";
echo $tax_included;
?>
<td rowspan="2" class="xl95" style='border-bottom:.5pt solid black'>　</td>
<?php
echo "<td colspan=\"3\" rowspan=\"2\" class=\"xl95\" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>";
echo $tax_excluded;
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>昨年部数</td>
<td colspan="10" rowspan="2" class="xl100" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="text" name="t_sakunen_busu" class = "four" value = "<?php echo $last_year_copies_number;?>" disabled="disabled" />部</td>
<td colspan="6" rowspan="2" class="xl102" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>※↑必ずどちらか解る様にしてください。</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black;border-bottom:.5pt solid black'>昨年仕様</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>サイズ</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_size" maxlength="2" class = "three" value = "<?php echo $last_year_specification_size;?>" disabled="disabled" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_page" maxlength="3" class = "three" value = "<?php echo $last_year_specification_page;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_color" maxlength="3" class = "three" value = "<?php echo $last_year_specification_color;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
echo "<td colspan=\"3\" class=\"xl90\">";
echo $last_year_k_men;
echo "<td colspan=\"3\" class=\"xl90\" style='border-right:.5pt solid black'>";
echo $last_year_r_men;
?>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_kami" maxlength="10" class = "one" value = "<?php echo $last_year_specification_kami;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_orikata" maxlength="10" class = "one" value = "<?php echo $last_year_specification_orikata;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>昨年発注先</td>
<td colspan="8" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_basho" maxlength = "60" class = "one" value = "<?php echo $last_year_ordering_destination;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>担当者</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one" value = "<?php echo $the_person_in_charge;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>





<!--
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl74\" />";
	$c++;
}
?>
<td colspan="6" class="xl93">注文書承認</td>
<td class="xl74" />
<?php
$c = 0;
while($c < 7){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl75" />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl76\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>最終責任者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="saisyu" value="1" disabled="disabled" /></td>
<td class="xl76" />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79"></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl76\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>役職者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="yakusyoku" value="2" disabled="disabled" /></td>
<td class="xl76" />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79" />
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>担当者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="tanto1" value="3" disabled="disabled" /></td>
<td />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79"></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl80\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>担当者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="tanto2" value="4" disabled="disabled" /></td>
<td class="xl80"></td>
<?php
$c = 0;
while($c < 6){
	echo "<td />";
	$c++;
}
?>
<td class="xl82" />
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 13){
	echo "<td class=\"xl80\" />";
	$c++;
}
?>
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>

-->
	
</tr>



<tr style='mso-height-source:userset; height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td />
<td colspan="3" style='mso-ignore:colspan'>電話での</td>
<td />
<td colspan="8" rowspan="2" class="xl92">092-433-8735</td>
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" style='mso-ignore:colspan'>お問い合わせは</td>
<td />
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl83">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td class=\"xl84\">　</td>";
	$c++;
}
?>
<td class="xl85">　</td>
</tr>

<tr style='display:none'>
<?php
$c = 0;
while($c < 23){
	echo "<td width=\"31px\" style='width:23pt' />";
	$c++;
}
?>
</tr>
</table>




<!-- 佐藤追加分ここから -->
<div style="margin : 50px;">
<hr />
<div style="margin : 20px;">
<h3>注文書申請</h3>
<?php
	// エラーがなかった場合
	if($finished_shounin_flg){
		print "<p>承認作業は終了しています</p>";
	}
	else if($err_message == ""){
		print "<p>操作選択</p>";
		print $select_content;
	}
	// エラーメッセージが格納されている場合、メッセージを表示
	else{
		print "<p>$err_message</p>";
	}
?>
</div>
<hr />
</div>

<!-- 追加分ここまで -->






<div align="center">

<?php	if($send_available_flg){ ?>
<input type="button" name="sub" value="送信" onclick="OnButtonClick('<?php echo $Flg;?>', '<?php echo $id;?>');" />
<?php	} ?>
<?php	if($tyuumon_creater_flg){ ?>
<input type="button" name="edi" value="編集" onclick="location.href='Order_form_editing.php?id=<?php echo $id;?>'" />
<?php	} ?>
<input type="button" name="can" value="戻る" onclick="location.href='Selection.php'" />
</div>
</div>
<?php
// 切断
$pdo = null;
?>

<!-- 佐藤追加分ここから -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function() {

  //送信ボタンをクリック
  $('#select_action').change(function(){

    //POSTメソッドで送るデータを定義する
    //var data = {パラメータ : 値};
    var data = {request : $("#select_action option:selected").val()};

    //Ajax通信メソッド
    //type : HTTP通信の種類(POSTとかGETとか)
    //url  : リクエスト送信先のURL
    //data : サーバに送信する値
    $.ajax({
      type: "POST",
      url: "shounin_modeler.php",
      data: data,
      dataTyoe: "json",
      //Ajax通信が成功した場合に呼び出されるメソッド
      success: function(data, dataType){
        //デバッグ用 アラートとコンソール
        //alert(data);
        //console.log(data);

        //出力する部分
        $('#result').html(data);
      },
      //Ajax通信が失敗した場合に呼び出されるメソッド
      error: function(XMLHttpRequest, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
        $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
        $("#textStatus").html("textStatus : " + textStatus);
        $("#errorThrown").html("errorThrown : " + errorThrown);
      }
    });
    return false;
  });
});

</script>

<!-- 追加分ここまで -->

</body>
</html>