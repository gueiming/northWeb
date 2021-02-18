<?php

header("Content-Type: text/html; charset=Big5");

include_once "include/conn.php";

$event = $_POST['event'];
$event = mb_convert_encoding($event, "Big5", "UTF-8");
print_r($event);
$stmt = odbc_prepare($conn, "INSERT INTO investi(events, created_at) VALUES( ?, CONVERT(varchar(100), GETDATE(), 20))");
$result = odbc_execute($stmt, array($event));

?>

<?php require_once("template/header.php");?>

<script type="text/javascript">
	setTimeout("location.href='./admin_investi.php'", 550);
</script>

<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title">
			<h2>Add data</h2>
		</div>
		<?php if ($result) { ?>
		<h3><?php echo "Added successfully!";?></h3>
		<?php } else { ?>
		<h3 style="color: red;"><?php echo "Fail to add data...";?></h3>
		<?php } ?>
	</div>
</div>

<?php include_once "./template/footer.php";?>