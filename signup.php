<?php 
header("Content-Type: text/html; charset=Big5");

session_start();

if (isset($_SESSION['errors'])) {
	$errors = $_SESSION['errors'];
} else { $errors = '';}


?>

<?php include_once "./template/header.php";?>

<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>申請頁面</h1>
</div>
<div class="container">
	<div class="login-back">
		<a href="./index.php">Back</a>
	</div>
	<div class="content-center mart-10">
		<div class="title noborder">
			<h2>申 請</h2>
		</div>
		<form action="./signup_process.php" method="POST">
			<div class="login">
				<img src="./img/login/pwd_grayB6B.png">
				<input type="email" name="email" placeholder="E-mail ...">
			</div>
			<div class="login">
				<img src="./img/login/uid_grayB66.png">
				<input type="text" name="uid" placeholder="輸入帳號 ...">
			</div>
			<div class="login">
				<img src="./img/login/pwd_grayB6B.png">
				<input type="password" name="pwd_1" placeholder="輸入密碼 ...">
			</div>
			<div class="login">
				<img src="./img/login/pwd_grayB6B.png">
				<input type="password" name="pwd_2" placeholder="再次輸入密碼 ...">
			</div>
			<div class="item">
				<div class="radio-item">
					<label for="general">普通人員</label>
					<input type="radio" id="general" name="authr" value="2">
				</div>
				<div class="radio-item">
					<label for="admin">管理員</label>
					<input type="radio" id="admin" name="authr" value="1">
				</div>
			</div>
			<button type="submit" name="submit">確 認</button>
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