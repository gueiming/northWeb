<?php

header('content-type:text/html;charset=utf-8');

include_once "./include/conn.php";

include_once './include/upload.func.php';

$file_info = $_FILES['image'];

$dest_fname = uploadFile($file_info);

$event = $_POST['event'];

$sql_i = "INSERT INTO honor_test(events, dest, fname, created_at) VALUES('$event', '$dest_fname[0]', '$dest_fname[1]', CONVERT(varchar(100), GETDATE(), 20))";

$sql_i = mb_convert_encoding($sql_i, "Big5", "UTF-8");

$result = odbc_exec($conn, $sql_i);

?>

<?php include_once("template/header.php");?>

<script type="text/javascript">
	setTimeout("location.href='./admin_honor.php'", 500);
</script>

<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title">
			<h2>Add data</h2>
		</div>
		<h3>
			<?php if ($result) {

				echo "Added successfully!";

			} else {
				
				$dest = $dest_fname[0];

				if(is_file($dest)){
					if(unlink($dest)){
						echo "�ɮ�{$dest}�R������...!";
					}else{
						if(chmod($dest,0777)){
							unlink($dest);
							echo "�ɮ�{$dest}�\�i�v�ק��R������...";
						}else{
							echo "�ɮ�{$dest}�L�k�q�Lweb�覡�R��...";
						}
					}
				}
				echo "SQL error: " . odbc_errormsg();	
			}	
			?>
		</h3>
	</div>
</div>

<?php include_once("./template/footer.php");?>