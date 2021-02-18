<?php 

header("Content-Type: text/html; charset=Big5");

// session_start();

include_once "include/conn.php";

$event_id = $_GET['event_id'];
$sql_o = "SELECT * FROM investi WHERE event_id = '$event_id'";
$result = odbc_exec($conn, $sql_o)or die("SQL error: " . odbc_errormsg());
$row = odbc_fetch_array($result);
$event = $row['events'];
$event_id = $row['event_id'];
?>

<?php include_once "./template/header.php";?>

<div class="header">
	<h1>Editing Page</h1>
</div>
<div class="container">
	<div class="content-center del">
		<div class="title">
			<h2>Delete data</h2>
			<a href="./admin_investi.php">Back</a>
		</div>
		<form action="./admin_investi_del.php" method="post">
			<!-- echo txt to be deleted -->
			<p><?php echo $event;?></p>

			<input type="hidden" name="deleted" value="<?php echo $_SESSION['deleted'];?>">
			<input type="hidden" name="event_id" value="<?php echo $event_id;?>">

			<button type="submit">Delete</button>
		</form>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>