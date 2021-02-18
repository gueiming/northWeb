
<?php include_once "./template/header.php";?>

<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title noborder">
			<h2>Add</h2>
			<a href="./admin_investi.php">Back</a>
		</div>
		<form action="./admin_investi_add_up.php" method="POST">
			<textarea type="text" name="event" placeholder="New data ..."></textarea> 
			<button type="submit" name="submit">Submit</button>
		</form>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>