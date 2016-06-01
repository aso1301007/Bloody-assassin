<html><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><body>
    <p align="center">検索　(MySQL接続テスト)</p>
    <hr>
    <?php
      // MySQL 接続
      if (!($cn = mysql_connect("localhost", "root", ""))) {
        print "mysql connect failed.";
        die;
      }

      // MySQL DB 選択
      if (!(mysql_select_db("hello"))) {
        print "mysql db selection failed.";
        die;
      }

      // MySQL 問い合わせ
      $sql = "select * from tes";
      if (!($rs = mysql_query($sql))) {
        print "mysql query execution failed.";
        die;
      }
    ?>
    <table border=1 >
      <tr><th>No</th><th>名</th>
    <?php
      // MySQL レコード参照
      while ($item = mysql_fetch_array($rs)) {
        print "<tr><td> ${item['number']} </td>";
        print "<td> ${item['name']} </td>";
      }
    ?>
    </table>
    <?php
      // MySQL 切断
      mysql_close($cn);

      // 正常終了
      print "<p>正常にデータを取得しました。</p>";
    ?>
    <hr>
  </body></html>