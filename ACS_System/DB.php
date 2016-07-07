<?php
//PDOでDB接続

 $pdo = new PDO('mysql:host=52.40.177.20;dbname=acs_system', 'assassin', 'acs6clover');

// UTF8
 $pdo->exec("set names utf8");



?>
