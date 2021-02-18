<?php

header("Content-Type: text/html; charset=Big5");

include_once "include/conn.php";

$event = $_POST['event'];

$sql_i = "INSERT INTO investi_test(events, created_at)VALUES('$event', CONVERT(varchar(100), GETDATE(), 20))";
$sql_i = mb_convert_encoding($sql_i, "Big5", "UTF-8");
$result = odbc_exec($conn, $sql_i)or die("SQL error: " . odbc_errormsg());

?>

<?php require_once("template/header.php");?>

<script type="text/javascript">
	setTimeout("location.href='./admin_investi.php'", 500);
</script>

<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title">
			<h2>Add data</h2>
		</div>
		<h3><?php if ($result) { echo "Added successfully!";}?></h3>
	</div>
</div>

<?php include_once "./template/footer.php";?>