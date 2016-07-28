<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>新規会員登録</title>
</head>
<body>
  <p>全項目をご記入ください</p>
  <form action="t_user_touroku_kakunin.php" method="post" enctype="multipart/form-data">
  <dl>
  <dt>氏名</dt>
    <dd>
      <input type="text" name="name" value="<?php if(isset($name)){ echo $name; } ?>" size="15" maxlength="15">
    </dd>
    <dt>学校</dt>
    <dd>
    <from>
    	<select name="school">
    	<option value=1>麻生情報ビジネス専門学校福岡校</option>
    	<option value=2>麻生外語観光＆製菓専門学校</option>
    	<option value=3>麻生医療福祉専門学校福岡校</option>
    	<option value=4>麻生建築＆デザイン専門学校</option>
    	<option value=5>麻生公務員専門学校福岡校</option>
    	<option value=6>麻生リハビリテーション大学校</option>
    	<option value=7>麻生工科自動車大学校</option>
    	<option value=8>麻生ビューティーカレッジ</option>
    	<option value=9>麻生情報ビジネス専門学校北九州校</option>
    	<option value=10>麻生公務員専門学校北九州校</option>
    	<option value=11>麻生医療福祉＆観光カレッジ</option>
    	<option value=12>麻生看護大学校</option>
    	</select>
    </from>
    </dd>
    <dt>部署</dt>
    <dd>
      <input type="text" name="busho" size="15" maxlength="20">
    </dd>
    <dt>メールアドレス</dt>
    <dd>
      <input type="text" name="mail" size="35" maxlength="255">
    </dd>
    <dt>パスワード</dt>
    <dd>
      <input type="password" name="pass" size="10" maxlength="20">
    </dd>
    <dt>電話番号</dt>
    <dd>
      <input type="text" name="tel" size="10" maxlength="11">
    </dd>

  </dl>
  <div><input type="submit" value="入力内容を確認"></div>
  </form>
</body>
</html>
