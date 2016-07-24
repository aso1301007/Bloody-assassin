<?php
$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$date3 = "$year"."-"."$month"."-"."$date";
$t_naiyou = $_POST["t_naiyou"];
$school_name = $_POST["school_name"];
$busho = $_POST["busho"];
$user_name = $_POST["user_name"];
$user_tel = $_POST["user_tel"];
$hin_janru = $_POST["hin_janru"];
$t_bikou = $_POST["t_bikou"];
$gakubu_name = $_POST["gakubu_name"];
$t_mokuteki = $_POST["t_mokuteki"];
$t_size = $_POST["t_size"];
$t_page = $_POST["t_page"];
$t_color = $_POST["t_color"];
$t_men = $_POST["t_men"];
$t_kami = $_POST["t_kami"];
$t_orikata = $_POST["t_orikata"];
$t_busu = $_POST["t_busu"];
$t_kiboubi = $_POST["t_kiboubi"];
$t_basho = $_POST["t_basho"];
$t_money = $_POST["t_money"];
$t_youbou = $_POST["t_youbou"];
$t_sakunen_jisseki = $_POST["t_sakunen_jisseki"];

$t_sakunen_money = $_POST["t_sakunen_money"];
$t_zei_hantei = $_POST["t_zei_hantei"];
$t_sakunen_busu = $_POST["t_sakunen_busu"];
$t_sakunen_size = $_POST["t_sakunen_size"];
$t_sakunen_page = $_POST["t_sakunen_page"];
$t_sakunen_color = $_POST["t_sakunen_color"];
$t_sakunen_men = $_POST["t_sakunen_men"];
$t_sakunen_kami = $_POST["t_sakunen_kami"];
$t_sakunen_orikata = $_POST["t_sakunen_orikata"];
$t_sakunen_basho = $_POST["t_sakunen_basho"];
$t_sakunen_tantou = $_POST["t_sakunen_tantou"];

require_once "../DB.php";

$stmt = $pdo -> prepare("INSERT INTO tyuumon_master
		(tm_id,user_id,tm_seisakubutu,seisaku_id,tm_hattyu_flg,tm_kakunin_flg,tm_mitumorityuu_flg,tm_mitumorizumi_flg,tm_nouhin_flg,tm_touroku_flg,tm_houkokusho_flg,tm_sakujo_flg)
		VALUES ('1','$year'.'0001','null','0','0','0','0','0','0','0','0')");
$name = "あああ";
if (!$stmt) {
	exit('データを登録できませんでした。');
}

//-----VALUESに設定する値のセット-------------------
$stmt->bindParam(':user', $name, PDO::PARAM_STR);//変数を入力するときはこっち:bindParam
$stmt->bindParam(':img', $img, PDO::PARAM_STR);
$stmt->bindValue(':good', 0, PDO::PARAM_INT);//変数ではなく値を直接入力する場合はこっち:bindValue
//---------------------------------------------

$stmt->execute();//INSERT文実行

$con = mysql_close($con);
if (!$con) {
	exit('データベースとの接続を閉じられませんでした。');
}

?>
<body>
 <?php echo $date3; ?>
 <?php echo $t_naiyou; ?>
 <?php echo $school_name; ?>
 <?php echo $busho; ?>
 <?php echo $user_name; ?>
 <?php echo $user_tel; ?>
 <?php echo $hin_janru; ?>
 <?php echo $t_bikou; ?>
 <?php echo $gakubu_name; ?>
 <?php echo $t_mokuteki; ?>
 <?php echo $t_size; ?>
 <?php echo $t_page; ?>
 <?php echo $t_color; ?>
 <?php echo $t_men; ?>
 <?php echo $t_kami; ?>
 <?php echo $t_orikata; ?>
 <?php echo $t_busu; ?>
 <?php echo $t_kiboubi; ?>
 <?php echo $t_basho; ?>
 <?php echo $t_money; ?>
 <?php echo $t_youbou; ?>
 <?php echo $t_sakunen_jisseki; ?>
 <?php echo $t_sakunen_money; ?>
 <?php echo $t_zei_hantei; ?>
 <?php echo $t_sakunen_busu; ?>
 <?php echo $t_sakunen_size; ?>
 <?php echo $t_sakunen_page; ?>
 <?php echo $t_sakunen_color; ?>
 <?php echo $t_sakunen_men; ?>
 <?php echo $t_sakunen_kami; ?>
 <?php echo $t_sakunen_orikata; ?>
 <?php echo $t_sakunen_basho; ?>
</body>