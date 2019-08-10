<?php
include('conn_db.php');
$db = connect_db();
session_save_path('./session');
# post method 처리
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
	$password = $_POST['password'];
	$db_ = $db->prepare("SELECT * FROM board_user WHERE id=:id");
	$db_->bindParam(':id', $id);
	$db_->execute();
	$row = $db_->fetch();
	# db에서 유저 정보와 입력된 password 비교
	if($row["password"] == $password){  // db의 패스워드와 입력한 패스워드 비교
		$name = $row['name'];
		$id	= $row['id'];
		if(!isset($_SESSION)){
			session_start();
		};
		# session에 유저의 아이디와 이름을 저장 -> 게시판 이용 시 사용됨
		$_SESSION['id'] = $id;
		$_SESSION['name'] = $name;
		header("Location: board.php");
	}else{
		echo "비밀번호가 다릅니다.";
	}
};
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="login.css">
<meta charset="utf-8">

<head>
</head>

<body>
	<fieldset>
		<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
			<legend>로그인 정보</legend><br>
			<label class=heading>아이디: </label>
			<input type="text" name='id' id='id'><br>
			<label class=heading>비밀번호: </label>
			<input type="password" name="password" id="password">
			<br><br>
			<input type="submit" value="로그인">
		</form>
		<a href=<?php echo htmlspecialchars("signup.php"); ?>><input type="button" value="회원가입"></a>
	</fieldset>
</body>

</html>
