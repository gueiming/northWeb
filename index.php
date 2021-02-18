<?php


if (isset($_GET['logout'])) {
	session_start();
	session_destroy();
	unset($_SESSION['loggedin']);
	header("location: login.php");
}

?>

<?php include_once "./template/header.php";?>

<style type="text/css">
	.content-center button {
		margin: 15px auto 0;
	}
</style>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>HOME</h1>
</div>
<div class="container">
	<div class="title">
		<h2>List</h2>
	</div>
	<div class="content-center">
		<button onclick="location.href='./display_investi.php';">Display Investi</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./display_honor.php';">Display Honor</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./allFunc.php';">All Function</button>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>