<?php
header("Content-Type: text/html; charset=Big5");

session_start();
session_destroy();
unset($_SESSION['loggedin']);


if (isset($_SESSION['errors'])) {
	$errors = $_SESSION['errors'];
} else { $errors = '';}


?>

<?php include_once "./template/header.php";?>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>∫a≈A∫]</h1>
</div>
<div class="container">
	<div class="login-back">
		<a href="./index.php">Back</a>
	</div>
	<div class="content-center">
		<div class="title noborder">
			<h2>µn§J</h2>
		</div>
		<form action="./authenticate.php" method="POST">
			<div class="login">
				<img src="./img/login/uid_grayB66.png">
				<input type="text" name="uid" placeholder="±b∏π ...">
			</div>
			<div class="login">
				<img src="./img/login/pwd_grayB6B.png">
				<input type="password" name="pwd" placeholder="±KΩX ...">
			</div>
			<button type="submit" name="submit">ΩTª{</button>
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