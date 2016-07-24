<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel=Stylesheet href=stylesheet.css type="text/css">
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<style >
<!--table
{mso-displayed-decimal-separator:"\.";
mso-displayed-thousand-separator:"\,";}
@page
{margin:.75in .7in .75in .7in;
mso-header-margin:.3in;
mso-footer-margin:.3in;}
-->
</style>


<title>書類閲覧</title>


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
<script type="text/javascript">
      $(function(){
           $("a[href^='http://']").attr("target","_blank");
           $(".open").click(function(){
                $("#slideBox").slideToggle("fast");
           });
      });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open2").click(function(){
               $("#slideBox2").slideToggle("fast");
          });
     });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open3").click(function(){
               $("#slideBox3").slideToggle("fast");
          });
     });
 </script>

<script>//プルダウン切り替え
		$(function domReady() {
  		$('.demo').focused();
		});
</script>

</head>

<body>

<?php

session_start();
require '../../DB.php';
require '../../user_name.php';

$user_name=$_SESSION['user_name'];   //ユーザー名取得
$tm_id=$_POST['eturan_tm_id'];     //選んだ注文書id


//ログインしていないorセッションが切れた場合------------
if($user_name==null){
	header("Location: ../../Login/login.html");
}
//-------------------------------------------------------
echo "tm_id:".$tm_id;

//-----注文書内容をDBから受け取る-----------------------
 $sql = "SELECT * FROM (((((((tyuumon TY
		INNER JOIN hinmei HI ON TY.hin_id = HI.hin_id)
		INNER JOIN school SC ON TY.school_id = SC.school_id)
		INNER JOIN tyuumon_master TM ON TY.tm_id=TM.tm_id)
		INNER JOIN tyuumonsha TS ON TM.user_id=TS.user_id)
		INNER JOIN user U ON TM.user_id=U.user_id)
		INNER JOIN gakubu GK ON TY.school_id=GK.school_id)
		LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
		WHERE TY.tm_id =:tm_id";
$data = $pdo->prepare($sql);
$data->bindParam(':tm_id', $tm_id, PDO::PARAM_STR);
$data->execute();


while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	 $t_user_id=$row['user_id'];    //注文マスターテーブルを主にする為の取得
	 $t_date = $row['t_date'];
	 $naiyou = $row['t_naiyou'];     //見積りor発注
	 $school_name=$row['school_name']; //学校名
	 $hin_name = $row['hin_janru'];      //品名
	 $gakubu_name=$row['gakubu_name'];  //利用する学部名
	 $bikou = $row['t_bikou'];
	 $mokuteki = $row['t_mokuteki'];
	 $size=$row['t_size'];
	 $page = $row['t_page'];
	 $color = $row['t_color'];
	 $men = $row['t_men'];
	 $kami = $row['t_kami'];
	 $orikata = $row['t_orikata'];
	 $busu = $row['t_busu'];
	 $kiboubi = $row['t_kiboubi'];
	 $basyo = $row['t_basho'];
	 $money = $row['t_money'];
	 $youbou = $row['t_youbou'];
	 $s_tm_id = $row['t_sakunen_tm_id'];
	 $s_jisseki = $row['t_sakunen_jisseki'];
	 $s_hiyou = $row['t_sakunen_hiyou'];
	 $s_zei_hantei = $row['t_zei_hantei'];
	 $s_busu = $row['t_sakunen_busu'];
	 $s_size = $row['t_sakunen_size'];
	 $s_page = $row['t_sakunen_page'];
	 $s_color = $row['t_sakunen_color'];
	 $s_men = $row['t_sakunen_men'];
	 $s_kami = $row['t_sakunen_kami'];
	 $s_orikata = $row['t_sakunen_orikata'];
	 $s_basyo = $row['t_sakunen_basho'];
	 $s_tantou = $row['t_sakunen_tantou'];  //昨年担当者名
	 $img_path=$row['gazou_path'];     //画像
}


echo "user_id:".$t_user_id;

//注文者の部署、担当者情報
$sql1="SELECT * FROM ((tyuumon_master TM
		INNER JOIN tyuumonsha TS ON TM.user_id= TS.user_id)
		INNER JOIN user U ON TM.user_id=U.user_id)
		WHERE TM.user_id=?";
$data1 = $pdo->prepare($sql1);
$data1->execute(array('$user_id'));

while($row1 = $data1 ->fetch(PDO::FETCH_ASSOC)){
	$user_id=$row1['user_id'];
	$busyo_name=$row1['tyuumonsha_busyo_name'];//部署名
	$tantou_name=$row1['user_name'];    //担当者名
	$tantou_tel=$row1['user_tel'];    //担当者電話
}


list($t_yy, $t_mm, $t_dd) = explode('-', $t_date);  // 文字列の分解


//---------------------------------------------------------
?>


<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name"><?php echo $user_name;?> さん</div>

</div>

<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログアウト
				<ul style="list-style:none;">
					<li><a href="../../Login/Logout.php">ログアウト</a></li>
				</ul>
			</li>
			<li>注文書
				<ul style="list-style:none;">
					<li><a href="#">新規注文書</a></li>
					<li><a href="#">注文書選択</a></li>
				</ul>
			</li>
			<li>書類
				<ul style="list-style:none;">
					<li><a href="Image_selection.php">書類閲覧</a></li>
					<li><a href="#">製作物画像登録</a></li>
				</ul>
			</li>
			<li>進捗管理
				<ul style="list-style:none;">
					<li><a href="../progress/Purchase_order_selection.php">進捗管理</a></li>
				</ul>
			</li>
		</ul>
</div>

<div id="main">
<div id="border"></div>
<div id="title">書類閲覧</div>


<div style="text-align: center;">
<!-- ポインター部分開始 -->
			<div onclick="obj=document.getElementById('slideBox1').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">[ 注文書▼ ]</a>
			</div>
<!-- ポインター部分終了 -->

<!-- 折り畳み中身 -->
		<div id="slideBox1" class="divColorGray" style="display:none;clear:both;">

<!--  注文書表示 -->
<table border=0 width=713 style='border-collapse:
 collapse;table-layout:fixed;width:529pt' align = center>
 <col width=31 span=23 style='width:23pt'>
 <tr height=36 style='height:27.0pt'>
 <td height=36 width=31 style='height:27.0pt;width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl65>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl67>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan=4 class=xl115>注文書</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td class=xl70></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan ="2">
 <INPUT type="text" name="year" size = "1" maxlength = "4" value="<?php echo $t_yy;?>">
 </td>
 <td>年</td>
 <td>
 <INPUT type="text" name="month" size = "2" maxlength = "2" class = "two" value="<?php echo $t_mm;?>">
 </td>
 <td>月</td>
 <td>
 <INPUT type="text" name="date" size = "2" maxlength = "2" class = "two" value="<?php echo $t_dd;?>">
 </td>
 <td>日</td>
 <td class=xl69></td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>注文内容</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71 colspan=3 style='mso-ignore:colspan'>
 <input type="radio" name="t_naiyou" value="est" >見積もり
 </td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71 colspan=2 style='mso-ignore:colspan'>
 <input type="radio" name="t_naiyou" value="ord" checked>発注
 </td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl72>　</td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36b>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>学校名</td>
 <td colspan=8 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="school_name" maxlength="25" class = "one" value="<?php echo $school_name;?>">
 </td>
 <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>部署名</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="name" maxlength="15" class = "one">
 </td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>ご担当者名</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="user_name" maxlength="15" class = "one">
 </td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black;border-left:none'>お電話番号</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="number" name="user_tel" maxlength="11" class = "one">
 </td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl114 style='border-right:.5pt solid black'>品名</td>
 <td colspan=6>
 <SELECT name="hin_janru" class = "one">
 <OPTION value="pamph" selected>パンフレット</OPTION>
 <OPTION value="pos">ポスター</OPTION>
 <OPTION value="sign">看板</OPTION>
 <OPTION value="other">その他</OPTION>
 </SELECT>
 </td>
 <td colspan=3 class=xl114 style='border-right:.5pt solid black'>備考</td>
 <td colspan=7 class=xl114 style='border-right:.5pt solid black;border-bottom:border-left:none'>
 <textarea name="t_bikou" rows="2" wrap="soft" maxlength = "255" class = "one">
 </textarea>
 </td>
 <td class=xl69>　</td>
 </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>利用する学部系</td>
  <td colspan=6 class=xl89 style='border-left:none'>
  <input type="text" name="gakubu_name" maxlength="20" class = "one">
  </td>
  <td colspan=3 class=xl111 style='border-right:.5pt solid black'>利用目的</td>
  <td colspan=7 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <textarea name="t_mokuteki" rows="2" wrap="soft" maxlength = "255" class = "one">
  </textarea>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>仕様</td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>サイズ</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_size" maxlength="2" class = "three">
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_page" maxlength="3" class = "three">
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_color" maxlength="3" class = "three">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=3 class=xl90>
  <input type="radio" name="t_men" value="kata" checked>片面
  </td>
  <td colspan=3 class=xl90 style='border-right:.5pt solid black'>
  <input type="radio" name="t_men" value="ryo">両面
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>紙</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_kami" maxlength="10" class = "one">
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_orikata" maxlength="10" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>部数</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_busu" maxlength="7" class = "five">部</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_kiboubi" maxlength="20" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望納品場所</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_basho" maxlength="60" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望金額</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_money" maxlength="8" class = "six money">円
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>仕様の要望</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_youbou" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl108 style='border-right:.5pt solid black'>昨年制作実績の有無</td>
  <td class=xl73 style='border-top:none;border-left:none'>　</td>
  <td class=xl71 style='border-top:none'>　</td>
  <td colspan=5 class=xl90>
  <input type="radio" name="t_sakunen_jisseki" value="yes" >あり
  </td>
  <td class=xl71 style='border-top:none'>　</td>
  <td colspan=5 class=xl90>
  <input type="radio" name="t_sakunen_jisseki" value="no" checked>なし
  </td>
  <td class=xl71 style='border-top:none'>　</td>
  <td class=xl71 style='border-top:none'>　</td>
  <td class=xl72 style='border-top:none'>　</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-bottom:.5pt solid black'>昨年実績費用</td>
  <td colspan=8 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="t_sakunen_money" maxlength="8" class = "seven">
  </td>
  <td rowspan=2 class=xl94 style='border-bottom:.5pt solid black'>　</td>
  <td colspan=3 rowspan=2 class=xl95 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="radio" name="t_zei_hantei" value="komi">(税込み)
  </td>
  <td rowspan=2 class=xl95 style='border-bottom:.5pt solid black'>　</td>
  <td colspan=3 rowspan=2 class=xl95 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="radio" name="t_zei_hantei" value="nuki" checked>(税抜き)
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>昨年部数</td>
  <td colspan=10 rowspan=2 class=xl100 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="t_sakunen_busu" class = "four">部
  </td>
  <td colspan=6 rowspan=2 class=xl102 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>※↑必ずどちらか解る様にしてください。</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl69>　</td>
  </tr>
  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>昨年仕様</td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>サイズ</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_size" maxlength="2" class = "three">
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_page" maxlength="3" class = "three">
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_color" maxlength="3" class = "three">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=3 class=xl90>
  <input type="radio" name="t_sakunen_men" value="kata" checked>片面
  </td>
  <td colspan=3 class=xl90 style='border-right:.5pt solid black'>
  <input type="radio" name="t_sakunen_men" value="ryo">両面
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>紙</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_kami" maxlength="10" class = "one">
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_orikata" maxlength="10" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>昨年発注先</td>
  <td colspan=8 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_basho" maxlength = "60" class = "one">
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>担当者</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one">
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl74></td>
  <td class=xl74></td>
  <td class=xl74></td>
  <td class=xl74></td>
  <td class=xl74></td>
  <td class=xl74></td>
  <td colspan=6 class=xl93>注文書承認</td>
  <td class=xl74></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl75></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td colspan=5 class=xl86 style='border-right:.5pt solid black'>最終責任者</td>
  <td class=xl77 style='border-top:none;border-left:none'>
  <input type="checkbox" name="saisyu" value="1">
  </td>
  <td class=xl76></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl79></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td class=xl76></td>
  <td colspan=5 class=xl86 style='border-right:.5pt solid black'>役職者</td>
  <td class=xl77 style='border-top:none;border-left:none'>
  <input type="checkbox" name="yakusyoku" value="2">
  </td>
  <td class=xl76></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl79></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan=5 class=xl86 style='border-right:.5pt solid black'>担当者</td>
  <td class=xl77 style='border-top:none;border-left:none'>
  <input type="checkbox" name="tanto1" value="3">
  </td>
  <td></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl79></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td colspan=5 class=xl86 style='border-right:.5pt solid black'>担当者</td>
  <td class=xl77 style='border-top:none;border-left:none'>
  <input type="checkbox" name="tanto2" value="4">
  </td>
  <td class=xl80></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl82></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td class=xl80></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td></td>
  <td colspan=3 style='mso-ignore:colspan'>電話での</td>
  <td></td>
  <td colspan=8 rowspan=2 class=xl92>092-433-8735</td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 style='mso-ignore:colspan'>お問い合わせは</td>
  <td></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl83>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl85>　</td>
  </tr>

  <tr height=0 style='display:none'>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  </tr>

  </table>
 </div>

<!-- ポインター部分開始 -->
			<div onclick="obj=document.getElementById('slideBox2').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">[ 報告書▼ ]</a>
			</div>
<!-- ポインター部分終了 -->
<!-- 折り畳み中身開始 -->
		<div id="slideBox1" class="divColorGray" style="display:none;clear:both;">報告書を表示</div>
<!-- 折り畳み中身終了 -->

<!-- ポインター部分開始 -->
			<div onclick="obj=document.getElementById('slideBox3').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">[ 画像▼ ]</a>
			</div>
<!-- ポインター部分終了 -->
<!-- 折り畳み中身 -->
		<div id="slideBox3" class="divColorGray" style="display:none;clear:both;">画像を表示</div>
<!-- 折り畳み中身終了 -->
</div>
</div>

</body>


</html>