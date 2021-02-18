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
  if (empty($uid)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($pwd_1)) { array_push($errors, "Password is required"); }
  if ($pwd_1 != $pwd_2) {
    array_push($errors, "The two passwords do not match");
  }
  if (empty($authr)) { array_push($errors, "Authorization is required!"); }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email

  $stmt = odbc_prepare($conn, "SELECT * FROM account WHERE uid=? OR email=?");
  $result = odbc_execute($stmt, array($uid, $email));

  $user = odbc_fetch_array($stmt);

  if ($user) { // if user exists
    if ($user['uid'] === $uid) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$hash = password_hash($pwd_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database

  	$stmt = odbc_prepare($conn, "INSERT INTO account (uid, pwd, email, authorize ) VALUES(?, ?, ?, ?)");
  	$signup = odbc_execute($stmt, array($uid, $hash, $email, $authr)) or die("SQL ERROR: " . odbc_errormsg());
  } else {
    $_SESSION['errors'] = $errors;
    header('location: signup.php');
  }
}
?>
<?php include_once "./template/header.php";?>

<script type="text/javascript">
  setTimeout("location.href='./login.php'", 550);
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

