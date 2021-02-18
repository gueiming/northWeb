<?php
header("Content-Type: text/html; charset=Big5");
?>


<?php include_once "./template/header.php";?>
<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title noborder">
			<h2>Add</h2>
			<a href="./gen_investi.php">Home</a>
		</div>
	</div>
	<form action="./gen_investi.php" method="POST">
		<div class="content-center">
			<textarea type="text" name="event" placeholder="New data ..."></textarea> 
		</div>
		<div class="content-center">
			<button type="submit" name="submit">Submit</button>
		</div>
	</form>
</div>

<?php include_once "./template/footer.php"; ?>