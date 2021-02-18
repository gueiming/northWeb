<?php

header("Content-Type: text/html; charset=Big5");

session_start(); 

// print_r($_SESSION['loggedin']);

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['loggedin']);
	header("location: login.php");
}

include_once "./include/conn.php";

if(isset($_POST['event']) && isset($_POST['submit'])){

	include_once "./include/conn.php";

	$event = $_POST['event'];

	$sql_i = "INSERT INTO investi(events, created_at) VALUES('$event', CONVERT(varchar(100), GETDATE(), 20))";
	$sql_i = mb_convert_encoding($sql_i, "Big5", "UTF-8");
	$query = odbc_exec($conn, $sql_i)or die("SQL ERROR: " . odbc_errormsg());

}


// pull data from dB
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
	<h1>查緝成效</h1>
	<!-- logout link -->
	 <a href="./login_investi.php">Login</a>
</div>
<div class="container">
	<div class="title">
		<h2>資料列表</h2>
		<a href="./index.php">返回</a>
		<a href="./login_investi.php" >新增</a>
	</div>
	<?php 
		// loop display of items 
		while($row = odbc_fetch_array($result)) { 
			$moreOrLess = "moreOrLess".$row['event_id'];
			$more = "more-".$row['event_id'];
			$less = "less-".$row['event_id'];
	?>
		<div class="item">
			<!-- display of txt-data -->
			<div class="readLess" style="width: 70%;" id="<?php echo $moreOrLess;?>">

				<button id="<?php echo $more; ?>" onclick="setMore(<?php echo $row['event_id'];?>)">...More</button>

				<p><?php echo $row['events'];?>
				<button id="<?php echo $less; ?>" onclick="setLess(<?php echo $row['event_id'];?>)" style="display: none;">...Less</button>
				</p>

			</div>
			<!-- display of time -->
			<div class="time" style="width: 30%";>
				<?php echo substr($row['created_at'], 0, 16)?>
			</div>
		</div>
	<?php } ?>
</div>

<?php include_once "./template/footer.php"; ?>