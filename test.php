<?php
	// phpinfo();

// header("Content-Type: text/html; charset=Big5");

// include_once "./include/conn.php";

// $sql_o = "SELECT * FROM investi_test ORDER BY event_id DESC";
// $result = odbc_exec($conn, $sql_o)or die("SQL ERROR: " . odbc_errormsg());
include_once("./include/conn.php");
$stmt =  odbc_prepare($conn, "SELECT pwd FROM account");
$result = odbc_execute($stmt, array());
$row = odbc_result($stmt);
print_r($row);
// while($row = odbc_fetch_array($result)) {
// 	echo $row['events']; 
// 	echo "<br />";
// }


?>