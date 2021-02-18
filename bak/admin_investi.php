<!-- 
設計目標:
1. 確認是否由正常管道進入
2. _SESSION紀錄帳密
3. 部分顯示vs全部顯示
4. 修改功能
5. SQL injection
6. 顯示所有資料
7. 加入修改鍵
-->

<?php
header("Content-Type: text/html; charset=Big5");

include_once "./include/conn.php";

$sql_o = "SELECT * FROM investi_test ORDER BY event_id DESC";
$result = odbc_exec($conn, $sql_o)or die("SQL ERROR: " . odbc_errormsg());

?>

<?php include_once "./template/header.php";?>

<script> 

  	function setMore(event_id) { 

    	document.getElementById( "moreOrLess" +  event_id).className = "readMore";

    	document.getElementById("more" + event_id).style = "display: none;";
    	document.getElementById("less" + event_id).style = "display: inline;";
    }

    function setLess(event_id) { 

    	document.getElementById( "moreOrLess" +  event_id ).className = "readLess";

    	document.getElementById("less" + event_id).style = "display: none;";
    	document.getElementById("more" + event_id).style = "display: inline;";
    }


</script>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>Modifying Page</h1>
</div>
<div class="container admin-investi-width">
	<div class="title">
		<h2>Data list</h2>
		<a href="./index.php">Home</a>
		<a href="./admin_investi_add.php" >Add</a>
	</div>
	<?php 
		while($row = odbc_fetch_array($result)) { 
			$event_id = $row['event_id'];
			$moreOrLess = "moreOrLess".$event_id;
			$more = "more".$event_id;
			$less = "less".$event_id;
	?>
		<div class="item">
			<div class="readLess" id="<?php echo $moreOrLess;?>">

				<button id="<?php echo $more; ?>" onclick="setMore(<?php echo $event_id?>)">...More</button>

				<p><?php echo $row['events'];?>
				<button id="<?php echo $less; ?>" onclick="setLess(<?php echo $event_id;?>)" style="display: none;">...Less</button>
				</p>

			</div>
			<!-- actions to apply -->
			<div class="btn">
				<button id="delete" onclick='location.href="./admin_investi_del_conf.php?event_id=<?php echo $event_id;?>"'>Delete</button>
				<button id="modify" onclick='location.href="./admin_investi_mod_conf.php?event_id=<?php echo $event_id;?>"'>Modify</button>
			</div>
			<!-- display of time -->
			<div class="time">
				<?php echo substr($row['created_at'], 0, 16)?>
			</div>
		</div>
	<?php } ?>
</div>

<?php include_once "./template/footer.php"; ?>