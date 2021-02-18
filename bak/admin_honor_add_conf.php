<?php include_once "./template/header.php";?>

<div class="header">
	<h1>Adding Page</h1>
</div>

<div class="container">
	<div class="content-center">
		<div class="title noborder">
			<h2>Add</h2>
			<a href="./index.php">Back</a>
		</div>

		<form action="./admin_honor_add.php" method="POST" enctype="multipart/form-data">			
			<span>1. Type in new data</span>
			<textarea type="text" name="event" placeholder="New data ..." style="margin-bottom: 20px"></textarea> 

			<span>2. Select an image</span>
			<input type="file" name="image">

			<button type="submit" name="submit">Submit</button>
		</form>
	</div>
</div>

<?php include_once "./template/footer.php"; ?>
