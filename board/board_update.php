<?php
	include('conn_db.php');
	checking_logged_in();
	session_save_path('./session');
	session_start();
	$db = connect_db();
	$db_ = $db->prepare("SELECT * FROM board_post WHERE id=:id");
	$db_->bindParam(":id", $_GET['post_id']);
	$db_->execute();
	$detail_info = $db_->fetch();
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		if ($detail_info['writer'] != $_SESSION['name']){
			echo "<script>alert(\"접근 권한이 없습니다.\");
				window.location.replace('board.php');
				</script>";
		}
	}
	elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db_ = $db->prepare("UPDATE board_post SET title=:title, description=:description WHERE id=:id");
		$db_->bindParam(":title", $_POST['title']);
		$db_->bindParam(":description", $_POST['description']);
		$db_->bindParam(":id", $_POST['post_id']);
		$db_->execute();
		header("Location: board_detail.php?post_id=".$_POST['post_id']);
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<style>
		#update_table{
			margin-left: auto;
			margin-right: auto;
		}
		#update_title{
			padding-top: 10px;
			margin-bottom: 5px;
			padding-left: 39px;
		}
		#update_input{
			width: 350px;
		}
		#update_textarea{
			margin:0 auto;
			width: 400px;
		}
	</style>
</head>

<body>
 <div id="update_table" align="center">
		<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
		<input type="hidden" name="post_id" value="<?php echo htmlspecialchars($_GET["post_id"]);?>">
		<p>작성자1 : <?php echo $detail_info['writer']?></p>
		<p>작성일 : <?php echo $detail_info['created']?></p>
		<p id="update_title">제목 : <input id="update_input" type="text" name="title" align="center" value="<?=$detail_info['title']?>"></p>
		<p>본문 : <textarea id="update_textarea" name="description" cols="50" rows="30" align="center"> <?=$detail_info['description']?></textarea></p>
		<p><input type="submit" name='submit'></p>
	</form>
	</div>
	
</body>
</html>
