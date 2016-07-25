<?php
//PDOでDB接続

 $pdo = new PDO('mysql:host=52.40.177.20;dbname=acs_system', 'assassin', 'acs6clover', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// UTF8
 $pdo->exec("set names utf8");



?>