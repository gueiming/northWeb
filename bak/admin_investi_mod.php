<?php

header("Content-Type: text/html; charset=Big5");

include_once "include/conn.php";

$event_id = $_POST['event_id'];
$event = $_POST['event'];
$sql_i = "UPDATE investi_test SET events='$event' WHERE event_id='$event_id';";
$result = odbc_exec($conn, $sql_i)or die("SQL error: " . odbc_errormsg());

?>


<?php include_once "./template/header.php";?>

<script type="text/javascript">
	setTimeout("location.href='./admin_investi.php'", 500);
</script>
<div class="header">
	<h1>Modifying Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title" style="border-bottom: 1.5px solid silver;">
			<h2>Upload data</h2>
		</div>
		<h3><?php if ($result) { echo "Updated successfully!";}?></h3>
	</div>
</div>
<?php include_once "./template/footer.php";?>