<?php
header("Content-Type: text/html; charset=Big5");


?>

<?php include_once "./template/header.php";?>

<div class="header">
	<h1>�a�A�]</h1>
</div>

<div class="container">
	<div class="content-center">
		<div class="title noborder">
			<h2>�s�W</h2>
			<a href="./index.php">Back</a>
		</div>

		<form action="./admin_honor_add.php" method="POST" enctype="multipart/form-data">			
			<span>1. �s�W��r</span>
			<textarea type="text" name="event" placeholder="��J��r ..." style="margin-bottom: 20px"></textarea> 

			<span>2. ��ܹϤ�</span>
			<input type="file" name="image">

			<button type="submit" name="submit">Submit</button>
		</form>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>
