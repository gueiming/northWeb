<?php

header("Content-Type: text/html; charset=Big5");

include_once "include/conn.php";

$event_id = $_POST['event_id'];
$event = $_POST['event'];
$stmt = odbc_prepare($conn, "UPDATE investi SET events=? WHERE event_id='$event_id';");

$result = odbc_execute($stmt, array($event))or die("SQL error: " . odbc_errormsg());

?>


<?php include_once "./template/header.php";?>

<script type="text/javascript">
	setTimeout("location.href='./admin_investi.php'", 550);
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