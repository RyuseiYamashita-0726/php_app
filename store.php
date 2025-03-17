<?php
require_once('function.php');


//createData($_POST); 
//formで送られてきたデータを$_POSTで受け取ってcreateDate関数を実行
//$_POSTは必ず文字列として処理される。

savePostedData($_POST);

header('Location: ./index.php');
//PHPのリダイレクト処理を行う関数。実行するとブラウザがindex.php
//に自動的に変化する。

