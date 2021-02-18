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

    $stmt =  odbc_prepare($conn, "SELECT pwd, authorize FROM investi_account WHERE uid=?");
    $result = odbc_execute($stmt, array($uid));

    if ($result) {

         $row = odbc_fetch_array($stmt);

        if ($_POST['pwd'] === openssl_decrypt($row['pwd'], "AES-128-ECB", "SECRETKEY")) {

          $_SESSION['loggedin'] = TRUE;
          $authr = $row['authorize'];
          print_r($row);

          if ($row['authorize'] > 1) {
            header('location: ./gen_investi.php');
          } else {
            header('location: ./admin_investi.php');
          }

        } else {
            array_push($errors, "Wrong username/password");
            $_SESSION['errors'] = $errors;
            header('location: ./login_investi.php');
        }

    } else {
        array_push($errors, "Wrong username/password");
        $_SESSION['errors'] = $errors;
        header('location: ./login_investi.php');
    }

  } else {
    $_SESSION['errors'] = $errors;
    header('location: ./login_investi.php');
  }

}
?>

