<?php

	

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
		<button onclick="location.href='./cga/index_cga.php'">CGA Index</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='add_investi.php';">Add Investi</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./admin_honor_add_conf.php';">Add Honor</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./admin_investi.php';">Admin Investi</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./admin_honor.php';">Admin Honor</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./display_investi.php';">Display Investi</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./display_honor.php';">Display Honor</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./login.php'">Login</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./signup.php'">Signup</button>
	</div>
	<div class="content-center">
		<button onclick="location.href='./test.php';">Testing</button>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>