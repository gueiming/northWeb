<?php
session_start();

// initializing variables

$errors = array(); 

// connect to the database
include_once "./include/conn.php";

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $uid   = $_POST['uid'];
  $email = $_POST['email'];
  $pwd_1 = $_POST['pwd_1'];
  $pwd_2 = $_POST['pwd_2'];
  $authr = $_POST['authr'];

  // form validation: ensure that the form is correctly filled
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($uid)) { array_push($errors, "UserID is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($pwd_1)) { array_push($errors, "Password is required"); }
  if ($pwd_1 != $pwd_2) {
    array_push($errors, "The two passwords do not match");
  }
  if (empty($authr)) { array_push($errors, "Authorization is required!"); }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email

  $sql_o = "SELECT * FROM investi_account WHERE uid='$uid' OR email='$email'";
  $result = odbc_exec($conn, $sql_o);

  $user = odbc_fetch_array($result);

  if ($user) { // if user exists
    if ($user['uid'] === $uid) {
      print_r("ahola!");
      array_push($errors, "UserID already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {


  	$hash =  openssl_encrypt($pwd_1, "AES-128-ECB", 'SECRETKEY');//encrypt the password before saving in the database

  	$stmt = odbc_prepare($conn, "INSERT INTO investi_account (email, uid, pwd, authorize) VALUES(?, ?, ?, ?)");
  	$signup = odbc_execute($stmt, array($email, $uid, $hash, $authr)) or die("SQL ERROR: " . odbc_errormsg());
  } else {
    $_SESSION['errors'] = $errors;
    header('location: signup.php');
  }
}
?>
<?php include_once "./template/header.php";?>

<script type="text/javascript">
  setTimeout("location.href='./login_investi.php'", 550);
</script>
<div class="header">
  <h1>Sign up Page</h1>
</div>
<div class="container">
  <div class="content-center">
    <div class="title" style="border-bottom: 1.5px solid silver;">
      <h2>Result</h2>
    </div>
    <h3>
      <?php if ($signup) : ?>

        <h3><?php echo "Sign up successfully!";?></h3>

      <?php endif ?>
    </h3>
  </div>
</div>

<?php include_once "./template/footer.php";?>

