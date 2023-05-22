<?php
require_once "includes/conn.php";

$error = [];
$errorType = [];

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate username input
  if (empty(trim($_POST["username"]))) {
    $errors[] = "Please enter a username.";
    $errorType[] = "warning";
  } else {
    $username = trim($_POST["username"]);
  }

  // Validate password input
  if (empty(trim($_POST["password"]))) {
    $errors[] = "Please enter your password.";
    $errorType[] = "warning";
  } else {
    $password = trim($_POST["password"]);
  }

  // If there are no errors, attempt to authenticate the user
  if (empty($errors)) {

    // Prepare a SELECT query to retrieve the user's credentials
    $sql = "SELECT auth_id, username, password, category, acc_status FROM tbl_auth WHERE username = ?";

    // Prepare the query statement
    if ($stmt = mysqli_prepare($conn, $sql)) {

      // Bind the username parameter
      mysqli_stmt_bind_param($stmt, "s", $username);

      // Execute the statement
      mysqli_stmt_execute($stmt);

      // Store the result set
      mysqli_stmt_store_result($stmt);

      // Check if the username exists in the database
      if (mysqli_stmt_num_rows($stmt) == 1) {

        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $auth_id, $username, $hashed_password, $category, $acc_status);

        // Fetch the results
        if (mysqli_stmt_fetch($stmt)) {

          // Verify if acc_status is 1
          if ($acc_status == 1) {

            // Verify if the password matches
            if ($password == $hashed_password) {

              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["auth_id"] = $auth_id;
              $_SESSION["username"] = $username;
              $_SESSION["category"] = $category;
              // get the datetime now based on computer for logs
              $date = date('Y-m-d H:i:s');

              //get the peerid using authid
              $sql2 = "SELECT peerid FROM tbl_peerinfo WHERE auth_id = ?";
              if ($stmt2 = mysqli_prepare($conn, $sql2)) {
                mysqli_stmt_bind_param($stmt2, "i", $auth_id);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_store_result($stmt2);
                mysqli_stmt_bind_result($stmt2, $peerid);
                mysqli_stmt_fetch($stmt2);
                mysqli_stmt_close($stmt2);
              }

              //insert the login logs
              $sql3 = "INSERT INTO tbl_logs (peerid, action, timestamp) VALUES (?, ?, ?)";
              if ($stmt3 = mysqli_prepare($conn, $sql3)) {
                mysqli_stmt_bind_param($stmt3, "sss", $peerid, $action, $date);
                $action = 0;
                mysqli_stmt_execute($stmt3);
                mysqli_stmt_close($stmt3);
              }
              

              // Redirect the user to the dashboard according to their category
              if ($category == 1) {
                header('Location: admin/index.php');
              } else if ($category == 2) {
                header('Location: tutor/index.php');
              } else if ($category == 3) {
                header('Location: tutee/index.php');
              } else if ($category == 4) {
                header('Location: moderator/index.php');
              } else {
                header('Location: logout.php');
              }
            } else {

              // Display an error message if the password is not valid
              $errors[] = "Username or Password error try again!";
              $errorType[] = "warning";
            }
          } else if ($acc_status == 2) {

            // Display an error message if the account is not active
            $errors[] = "Your account has been <b>Deactivated</b>. Please contact the administrator.";
            $errorType[] = "danger";
          } else {

            // Display an error message if the account is not active
            $errors[] = "Your account is not activated. Please wait for confirmation.";
            $errorType[] = "warning";
          }
        }
      }
      else {
        // Display an error message if the username doesn't exist
        $errors[] = "Username or Password error try again!";
        $errorType[] = "warning";
      }
      mysqli_stmt_close($stmt);
    }
  }
  // Close the connection
  mysqli_close($conn);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nexus Link | v2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style>
  .bg-gradient-blue {
    background: #007bff;
    background: -webkit-linear-gradient(to right, #0062E6, #33AEFF);
    background: linear-gradient(to right, #0062E6, #33AEFF);

  }
</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index2.html" class="h1"><b>Nexus Link </b>v2</a>
      </div>
      <div class="card-body">
        <?php
        if (!empty($errors) && !empty($errorType)) {
          foreach (array_combine($errors, $errorType) as $error => $type) {
            echo "<div class='alert alert-{$type} alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <i class='icon fas fa-ban'></i> {$error}
            </div>";
          }
        }
        ?>
        <p class="login-box-msg">Sign in to start to start</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="registration.php" class="text-center">Create Account Now!</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>