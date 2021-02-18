<?php

header("Content-Type: text/html; charset=Big5");

include_once "include/conn.php";

$event_id = $_POST['event_id'];
$dest = $_POST['dest'];

$sql_d = "DELETE FROM honor_test WHERE event_id='$event_id'";
$result = odbc_exec($conn, $sql_d);

?>

<?php include_once "./template/header.php";?>

<script type="text/javascript">
	setTimeout("location.href='./admin_honor.php'", 500);
</script>
<div class="header">
	<h1>Deleting Page</h1>
</div>
<div class="container">
	<div class="content-center">
		<div class="title">
			<h2>Delete data</h2>
		</div>
		<h3>
			<?php 
				if(is_file($dest)){
					if(unlink($dest) && $result){
						echo "Deleted successfully!";
					}else{
						if(chmod($dest,0777)){
							unlink($dest);
							echo "檔案{$dest}許可權修改後刪除完畢...";
						}else{
							echo "檔案{$dest}無法通過web方式刪除...";
						}
						if ($result) { "SQL error: " . odbc_errormsg();}
					}
				}
			?>
		</h3>
	</div>
</div>

<?php include_once "./template/footer.php";?>