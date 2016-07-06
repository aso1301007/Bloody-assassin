<?php
//PDOでDB接続

 $pdo = new PDO('mysql:host=52.197.80.228;dbname=acs_system', 'assassin', 'acs6clover');

// UTF8
 $pdo->exec("set names utf8");



?>