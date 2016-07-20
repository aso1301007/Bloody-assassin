<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert title here</title>
<link rel=Stylesheet href=stylesheet.css type="text/css">
<link rel=stylesheet type=text/css href=css.css>
<style>
<!--table
{mso-displayed-decimal-separator:"\.";
mso-displayed-thousand-separator:"\,";}
@page
{margin:.75in .7in .75in .7in;
mso-header-margin:.3in;
mso-footer-margin:.3in;}
-->
</style>


<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
<script src="js/jquery.focused.min.js"></script>

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

  //フォーカスを得たとき
  $(".money").focus(function(){

    //カンマを消す
    this.value = this.value.replace(/,/g,"") ;
if (this.value == '0') this.value = "";
  })

  //フォーカスを失ったとき
  $(".money").blur(function(){

    //うっかり入力しているかもしれないカンマを消す
    this.value = this.value.replace(/,/g,"") ;

    //整数に変換したのち文字列に戻す
    //この時点で数字とマイナス記号だけが残る
    var num = "" + parseInt(this.value) ;

    //正規表現で桁区切りするための良く見かける関数的な何か
    //変数 num の中身が、桁区切りされる
    while(num != (num = num.replace(/^(-?\\d+)(\\d{3})/, "$1,$2")));

    //numに入っている値が数値じゃないときは0とする
    if (isNaN(parseInt(num))) num = "0" ;

    //桁区切りした結果（変数 num）でテキストボックスの中身を書き換える
    this.value = num ;

  })

})

</script>
</head>
<body>

<div id="header">
			<input type = "button" name = "top" value = "TOP" onclick = "location.href='#'">
			<div id="login_name">担当者さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>
			ログイン
		</li>
		<li>書類閲覧
			<ul style="list-style:none;">
				<li><a href="#">発注書一覧</a></li>
				<li><a href="#">制作物結果報告書</a></li>
			</ul>
		</li>
		<li>検索機能
			<ul style="list-style:none;">
				<li><a href="#">制作物ナンバー検索</a></li>
			</ul>
		</li>
		<li>DB管理
			<ul style="list-style:none;">
				<li><a href="#">注文者マスタ追加</a></li>
				<li><a href="#">制作会社マスタ追加</a></li>
			</ul>
		</li>
	</ul>

</div>


<div id="main">
<div id = "border"></div>
<p></p>
<form>
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
 <INPUT type="text" name="year" size = "1" maxlength = "4" >
 </td>
 <td>年</td>
 <td>
 <INPUT type="text" name="month" size = "2" maxlength = "2" class = "two">
 </td>
 <td>月</td>
 <td>
 <INPUT type="text" name="date" size = "2" maxlength = "2" class = "two">
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
 <input type="text" name="school_name" maxlength="25" class = "one">
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
  <td colspan=4 rowspan=2 class=xl94 style='border-bottom:.5pt solid black'>昨年実績</td>
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
  <div align="right">
  <input type="submit" value="保存" class = "eight">
  <input type="reset" value="リセット" class = "eight"	>
  </div>
  </form>
  <?php
		//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
		require_once "../DB.php";
		//セッションデータ取得
//		$user_id = $_SESSION['user_id'];	//ユーザ表.ユーザid
//	  	$user_name = $_SESSION['user_name'];//ログイン者名
		$user_name="高塚";
		$user_id="2";
		?>

//---------------INSERT文実行サンプル-------------------------------
//INSERT INTO userphoto (user_name,img_name,good) VALUES (:user,:img,:good)
	$stmt = $pdo -> prepare("INSERT INTO userphoto (user_name,img_name,good) VALUES (:user,:img,:good)");
	$name = "あああ";
	$img = "testimg.jpg";

         //-----VALUESに設定する値のセット-------------------
	$stmt->bindParam(':user', $name, PDO::PARAM_STR);//変数を入力するときはこっち:bindParam
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->bindValue(':good', 0, PDO::PARAM_INT);//変数ではなく値を直接入力する場合はこっち:bindValue
         //---------------------------------------------

	$stmt->execute();//INSERT文実行
  </div>
  </body>
  </html>