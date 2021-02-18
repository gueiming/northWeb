<?php
header("Content-Type: text/html; charset=Big5");

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['loggedin']);
	header("location: login.php");
}

session_start();

if (isset($_SESSION['errors'])) {
	$errors = $_SESSION['errors'];
} else { $errors = '';}

?>

<?php include_once "./template/header.php";?>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>查緝成效</h1>
</div>
<div class="container">
	<div class="login-back">
		<a href="./index.php">Back</a>
	</div>
	<div class="content-center">
		<div class="title noborder">
			<h2>登入</h2>
		</div>
		<form action="./authenticate.php" method="POST">
			<div class="login">
				<img src="./img/login/uid_grayB66.png">
				<input type="text" name="uid" placeholder="帳號 ...">
			</div>
			<div class="login">
				<img src="./img/login/pwd_grayB6B.png">
				<input type="password" name="pwd" placeholder="密碼 ...">
			</div>
			<button type="submit" name="submit">登入</button>
		</form>
		<?php  if ($errors > 0) : ?>
		<div class="error">
			<?php foreach ($errors as $error) : ?>
				<p><?php echo $error;?></p>
			<?php endforeach ?>
		</div>
		<?php  endif ?>
		<?php unset($_SESSION['errors']);?>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>