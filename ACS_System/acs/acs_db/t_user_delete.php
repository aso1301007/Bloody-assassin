<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>注文者の削除をします</title>
</head>
<body>
  <p>所属学校を選択してください</p>
  <form action="t_user_delete_sentaku.php" method="post" enctype="multipart/form-data">
  <dl>
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
  </dl>
  <div><input type="submit" value="検索内容表示"></div>
  </form>
</body>
</html>
