<?php
include('conn_db.php');
checking_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if ($_GET['writer'] != $_SESSION['name']){
		echo "<script>alert(\"접근 권한이 없습니다.\");
			window.location.replace('board.php');
			</script>";
	}else{
		$db = connect_db();
		$db_ = $db->prepare("DELETE FROM board_post WHERE id=:id");
		$db_->bindParam(':id', $_GET["post_id"]);
		$db_->execute();
		header("Location: board.php");
	}
}
?>
