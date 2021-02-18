<!-- 
�]�p�ؼ�:
1. �T�{�O�_�ѥ��`�޹D�i�J
2. _SESSION�����b�K
3. �������vs�������
4. �ק�\��
5. SQL injection
6. ��ܩҦ����
7. �[�J�ק���
-->

<?php
header("Content-Type: text/html; charset=Big5");

session_start(); 

if (!$_SESSION['loggedin']) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login_investi.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['loggedin']);
	header("location: display_investi.php");
}

include_once "./include/conn.php";

$sql_o = "SELECT * FROM investi ORDER BY event_id DESC";
$result = odbc_exec($conn, $sql_o)or die("SQL ERROR: " . odbc_errormsg());

?>

<?php include_once "./template/header.php";?>

<script> 

  	function setMore(event_id) { 

  		var moreOrLess = document.getElementById( "moreOrLess" +  event_id );
    	var more = document.getElementById( "more-" + event_id);
    	var less = document.getElementById( "less-" + event_id);

    	moreOrLess.className = "readMore";
    	more.style.display = "none";
    	less.style.display = "inline";
    }

    function setLess(event_id) { 

    	var moreOrLess = document.getElementById( "moreOrLess" +  event_id );
    	var more = document.getElementById( "more-" + event_id);
    	var less = document.getElementById( "less-" + event_id);
    	moreOrLess.className = "readLess";
    	more.style.display = "inline";
    	less.style.display = "none";
    }


</script>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>�d�r����</h1>
	<!-- logout link -->
	 <a href="index.php?logout='1'">Logout</a>
</div>
<div class="container admin-investi-width">
	<div class="title">
		<h2>��ƦC��</h2>
		<a href="./index.php">Home</a>
		<a href="./admin_investi_add.php" >Add</a>
	</div>
	<?php 
		while($row = odbc_fetch_array($result)) { 
			$event_id = $row['event_id'];
			$moreOrLess = "moreOrLess".$event_id;
			$more = "more-".$event_id;
			$less = "less-".$event_id;
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
				<button id="delete" onclick='location.href="./admin_investi_del_conf.php?event_id=<?php echo $event_id;?>"'>�R ��</button>
				<button id="modify" onclick='location.href="./admin_investi_mod_conf.php?event_id=<?php echo $event_id;?>"'>�� ��</button>
			</div>
			<!-- display of time -->
			<div class="time">
				<?php echo substr($row['created_at'], 0, 16)?>
			</div>
		</div>
	<?php } ?>
</div>

<?php include_once "./template/footer.php"; ?>