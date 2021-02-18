<?php 


session_start();

// initializing variables

$errors = array(); 

// connect to the database
include_once("./include/conn.php");

// LOGIN USER
if (isset($_POST['submit'])) {
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];

  if (empty($uid)) {
    array_push($errors, "Username is required");
  }
  if (empty($pwd)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $stmt =  odbc_prepare($conn, "SELECT pwd FROM account WHERE uid=?");
    $result = odbc_execute($stmt, array($uid));
    if ($result) {
         $row = odbc_fetch_array($stmt);
         print_r($row);
        if (password_verify($_POST['pwd'], $row['pwd'])) {
          $_SESSION['loggedin'] = TRUE;
          header('location: ./display_investi.php');
        } else {
            array_push($errors, "Wrong username/password");
        }
    } else {
        array_push($errors, "Wrong username/password");
    }
  } else {
    $_SESSION['errors'] = $errors;
    print_r($errors);
    // header('location: ./login.php');
  }

}
?>

