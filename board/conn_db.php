<?php

function connect_db(){
	$db = new PDO("mysql:dbname=board_test;host=localhost:3306", "jihoon", "1234");
	return $db;
}
# 로그인 여부 확인
function checking_logged_in(){
	session_save_path('./session');
	session_start();
	if(!isset($_SESSION['name'])){
		echo "<script>alert(\"게시판은 로그인 후 이용할 수 있습니다.\");
	window.location.replace('login.php');
		</script>";
		return false;
	}else{
		return true;
	}
}
?>