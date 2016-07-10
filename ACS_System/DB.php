<?php
//PDOでDB接続
try {
 $pdo = new PDO('mysql:host=52.40.177.20;dbname=acs_system', 'assassin', 'acs6clover',array(PDO::ATTR_EMULATE_PREPARES => false));

// UTF8
 $pdo->exec("set names utf8");
} catch (PDOException $e) {
 exit('データベース接続失敗。'.$e->getMessage());
}



?>
