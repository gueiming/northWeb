<?php
	
	if(isset($_POST['submit'])){
		if(empty($_POST['name'])){
			$errors['name'] = 'Your name is required'; 
		}

		if(empty($_POST['event'])){
			$errors['event'] = 'An eventis required';
		}

		header("location: ../gallery.php?submit_sucess");


	} else{
		header("location: ../gallery.php");
	}

