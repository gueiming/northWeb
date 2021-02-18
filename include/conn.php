<?php
$serverName = "localhost"; //serverName\instanceName
$database = "northWeb";//"northWeb";//
$uid = "sa";
$pwd = "Leo-597-111";

// $connectionInfo = array( "Database"=>"northWeb", "UID"=>"sa", "PWD"=>"Leo-597-111");


$conn =  odbc_connect("Driver={SQL Server};Server=$serverName;Database=$database;Charset=Big5", $uid, $pwd);;

if( !$conn ) {
//      echo "Connection established.<br />";
// }else{
     echo "Connection could not be established.<br />";
     die( print_r( odbc_error(), true));
}
?>