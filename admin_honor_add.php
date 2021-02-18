<?php

header('content-type:text/html;charset=big5');

include_once "./include/conn.php";

include_once './include/upload.func.php';

$file_info = $_FILES['image'];

$dest_fname = uploadFile($file_info);

$event = $_POST['event'];

$stmt = odbc_prepare($conn, "INSERT INTO honor(events, dest, fname, created_at) VALUES(?, ?, ?, CONVERT(varchar(100), GETDATE(), 20))");

$result = odbc_execute($stmt, array($event, $dest_fname[0], $dest_fname[1]));

?>

<?php include_once("template/header.php");?>

<script type="text/javascript">
	setTimeout("location.href='./admin_honor.php'", 550);
</script>

<div class="header">
	<h1>Adding Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title">
			<h2>Add data</h2>
		</div>
		
			<?php if ($result) {

				echo "<h3>新增成功!</h3>";

			} else {
				
				$dest = $dest_fname[0];

				if(is_file($dest)){
					if(unlink($dest)){
						echo "<h3 style='color:red;'>新增失敗，檔案已刪除!</h3>";
					}else{
						if(chmod($dest,0777)){
							unlink($dest);
							echo "<h3 style='color:red;'>新增失敗，檔案已刪除!</h3>";
						}else{
							echo "<h3 style='color:red;'>新增失敗，檔案已刪除!</h3>";
						}
					}
				}
				odbc_execute($conn, $sql_i);
				echo odbc_errormsg();	
			}	
			?>
		
	</div>
</div>

<?php include_once("./template/footer.php");?>