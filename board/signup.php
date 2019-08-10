<?php
include("conn_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$db = connect_db();
	$db_ = $db->prepare("SELECT id FROM board_user WHERE id=:id");
	$db_->bindParam(':id', $_POST["id"]);
	$db_->execute();
	$user_id = $db_->fetch();
	if($user_id){
		echo "<script>alert(\"존재하는 아이디 입니다.\");</script>";
	}else{
		$db_ = $db->prepare("INSERT INTO board_user (id, password, name) values (:id, :password, :name)");
		$db_->bindParam(':id', $_POST["id"]);
		$db_->bindParam(':password', $_POST["password"]);
		$db_->bindParam(':name', $_POST["name"]);
		$db_->execute();
		echo "<script>alert(\"회원가입 되었습니다.\");
		window.location.replace('login.php');
		</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="login.css">
<meta charset="utf-8">

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#equal").hide();
			$("#differ").hide();
			$("#password2").on("keyup", function() {
				var pwd1 = $("#password").val();
				var pwd2 = $("#password2").val();
				if (pwd1 != "" || pwd2 != "") {
					if (pwd1 == pwd2) {
						$("#equal").show();
						$("#differ").hide();
						$("#submit").removeAttr("disabled");
					} else {
						$("#equal").hide();
						$("#differ").show();
						$("#submit").attr("disabled", "disabled");
					}
				}
			});
		});

	</script>
</head>

<body>
	<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>
		<fieldset>
			<legend>회원 가입</legend>
			<label class=heading>아이디: </label>
			<input type="text" name='id' id='id'><br>
			<br>
			<label class=heading>비밀번호: </label>
			<input type="password" name="password" id="password"><br>
			<label class=heading>비밀번호 확인: </label>
			<input type="password" name="password2" id="password2">
			<br>
			<div id="equal">비밀번호가 일치합니다.</div>
			<div id="differ">비밀번호가 일치하지 않습니다.</div>
			<br>
			<label class=heading>이름: </label>
			<input type="text" name='name'><br>
			<br><br>
			<input id="submit" type="submit" value="회원가입">
		</fieldset>
	</form>
</body>

</html>
