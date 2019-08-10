<?php
	include("conn_db.php");
	checking_logged_in();
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$db = connect_db();
		$db_ = $db->prepare("SELECT * FROM board_post WHERE id=:id");
		$db_->bindParam(':id', $_GET["post_id"]);
		$db_->execute();
		$detail = $db_->fetch();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
		#detail_content {
			float: left;
			width: 500px;
			height: 300px;
			padding-top: 20px;
			padding-right: 20px;
			padding-left: 20px;
			padding-bottom: 20px;
		}

	</style>
</head>

<body>
	<table border=1 cellspacing=0 style="margin:0 auto;">
		<tr>
			<td height="30" width="100" style="text-align: center">글번호 </td>
			<td height="30" width="500" style="text-align: center"><?=$detail['id']?></td>
		</tr>
		<tr>
			<td style="text-align: center">제목 </td>
			<td height="30" style="text-align: center"><?=$detail['title']?></td>
		</tr>
		<tr>
			<td style="text-align: center">작성자 </td>
			<td height="30" style="text-align: center"><?=$detail['writer']?></td>
		</tr>
		<tr>
			<td style="text-align: center">작성일 </td>
			<td height="30" style="text-align: center"><?=$detail['created']?></td>
		</tr>
		<tr>
			<td style="text-align: center">내용 </td>
			<td id="detail_content"><?=$detail['description']?></td>
		</tr>
	</table>
	<a href="board.php"><input type="button" value="Home"></a>
	<a href=<?php echo htmlspecialchars("board_update.php?post_id=".$detail['id']);?>><input type="button" value="수정"></a>
	<a href=<?php echo htmlspecialchars("board_delete.php?post_id=".$detail['id'])."&write=".$detail['writer'];?> onclick="if(!confirm('삭제 하시겠습니까?')){return false;}"> 
	<input type="button" value="삭제"></a>
	
	
	
</body>

</html>
