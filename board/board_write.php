<?php
	include('conn_db.php');
	checking_logged_in();
	$db = connect_db();
	# 로그인 id를 기준으로 user의 name과 primary key(number->post의 foreign key)를 반환
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db_user = $db->prepare("SELECT name, number FROM board_user WHERE id=:id");
		$db_user->bindParam(":id", $_SESSION['id']);
		# name과 number를 반환
		$db_user->execute();
		$user = $db_user->fetch();
		# 로그인시 생성된 session의 name과 db의 name을 비교
		if($user['name'] == $_SESSION['name']){
			$db_post = $db->prepare("INSERT INTO board_post (user_number, title, description, created, writer) VALUES (:user_number, :title, :description, now(), :writer)");
			$db_post->bindParam(":user_number", $user['number']);
			$db_post->bindParam(":title", $_POST['title']);
			$db_post->bindParam(":description", $_POST['description']);
			$db_post->bindParam(":writer", $user['name']);
			$db_post->execute();
			header("Location: board.php");
		}
		else{
			echo "<script>alert(\"등록된 유저가 아닙니다.\");
	window.location.replace('login.php');
		</script>";
		}
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<style>
		#write_table {
			margin-left: auto;
			margin-right: auto;
		}

		#write_title {
			padding-top: 10px;
			margin-bottom: 5px;
			padding-left: 39px;
		}

		#write_input {
			width: 350px;
		}

		#write_textarea {
			margin: 0 auto;
			width: 400px;
		}

	</style>
</head>

<body>
	<div id="write_table" align="center">
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
			<p>작성자: <?php echo $_SESSION['name']?></p>
			<p id="write_title">제목: <input id="write_input" type="text" name="title" align="center"></p>
			<p>본문 : <textarea id="write_textarea" name="description" cols="50" rows="30" align="center"></textarea></p>
			<p><input type="submit" name='submit'></p>
		</form>
	</div>
</body>

</html>
