<?php
header("Content-Type: text/html; charset=Big5");


?>

<?php include_once "./template/header.php";?>

<div class="header">
	<h1>榮譽榜</h1>
</div>

<div class="container">
	<div class="content-center">
		<div class="title noborder">
			<h2>新增</h2>
			<a href="./index.php">Back</a>
		</div>

		<form action="./admin_honor_add.php" method="POST" enctype="multipart/form-data">			
			<span>1. 新增文字</span>
			<textarea type="text" name="event" placeholder="輸入文字 ..." style="margin-bottom: 20px"></textarea> 

			<span>2. 選擇圖片</span>
			<input type="file" name="image">

			<button type="submit" name="submit">Submit</button>
		</form>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>
