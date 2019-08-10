<?php
include('conn_db.php');
checking_logged_in();
	if(!isset($_SESSION['name'])){
		echo "<script>alert(\"게시판은 로그인 후 이용할 수 있습니다.\");
	window.location.replace('login.php');
		</script>";
	}
	$db = connect_db();
	$db_ = $db->prepare("SELECT * FROM board_post ORDER BY created DESC");
	$db_->execute();
	$rows = $db_->fetchAll();

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!--	search script-->
	<?php include 'search.php'?>
</head>

<body>
	<p><?php echo $_SESSION['name']; ?> 님 환영합니다.</p>
	<input id="search" type="text" placeholder="Search..">
	<h1 style="text-align: center;">게시판</h1>
	<table id="post_table" border=1 cellspacing=0 style="margin:0 auto;">
		<!--foreach를 이용해 게시판 목록 표시-->
		<?php foreach($rows as $row){ ?>
		<tr id="article_list">
			<td height='30' width='100' style="text-align:center"><?=$row['id']?></td>
			<td id="title" height='30' width='500' style="text-align:center"><a href=<?php echo htmlspecialchars("board_detail.php?post_id=".$row['id']);?>><?=$row['title']?></a></td>
			<td height='30' width='100' style="text-align:center"><?=$row['writer']?></td>
			<td height='30' width='100' style="text-align:center"><?=$row['created']?></td>
		</tr>
		<?php }?>
	</table>
	<a href=<?php echo htmlspecialchars("board_write.php");?>><input type="button" value="Write"></a>
	<a href=<?php echo htmlspecialchars("logout.php");?>><input type="button" value="LogOut"></a>
</body>

</html>
