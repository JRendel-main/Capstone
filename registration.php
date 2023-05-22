<?php include('includes/conn.php');
include('includes/header.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $firstName = $_POST["firstName"];
  $middleName = $_POST["middleName"];
  $lastName = $_POST["lastName"];
  $dob = $_POST["dob"];
  $sex = $_POST["sex"];
  $email = $_POST["email"];
  $year = $_POST["year"];
  $course = $_POST["course"];
  $studentNumber = $_POST["studentNumber"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $category = $_POST["category"];
  $error[] = "";
  $acc_status = 0;

  //check if all field 
  if (empty($firstName) || empty($lastName) || empty($dob) || empty($sex) || empty($email) || empty($year) || empty($course) || empty($studentNumber) || empty($username) || empty($password) || empty($category)) {
    $error[] = "Please fill out all required fields!";
  }

  // check of username already exsist 
  $sql = "SELECT * FROM tbl_auth WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows > 0) {
    $error[] = "Username already taken";
  }

  // check of email already exsist
  $sql = "SELECT * FROM tbl_peerinfo WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows > 0) {
    $error[] = "Email already taken";
  }

  // check of student number already exsist
  $sql = "SELECT * FROM tbl_peerinfo WHERE studentNumber = '$studentNumber'";
  $result = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($result);
  if ($num_rows > 0) {
    $error[] = "Student Number already taken";
  }

  // if $error is empty enter the content in form 
  $sql = "INSERT INTO tbl_peerinfo (firstname, middlename, lastname, dob, sex, email, year, course, studentNumber, category) VALUES ('$firstName', '$middleName', '$lastName', '$dob', '$sex', '$email', '$year', '$course', '$studentNumber', '$category')";
  $sql2 = "INSERT INTO tbl_auth (username, password, acc_status, category) values ('$username', '$password', '$acc_status', '$category')";
  $result = mysqli_query($conn, $sql);
  $result2 = mysqli_query($conn, $sql2);

  //get the auth_id of the user who just registered and insert it into tbl_tutor
  $sql3 = "SELECT auth_id from tbl_auth where username = '$username'";
  $result3 = mysqli_query($conn, $sql3);
  $row = mysqli_fetch_assoc($result3);
  $auth_id = $row['auth_id'];
  $sql4 = "UPDATE tbl_peerinfo SET auth_id = '$auth_id' WHERE email = '$email'";
  $result4 = mysqli_query($conn, $sql4);

  // get the peerid of user
  $sql5 = "SELECT peerid from tbl_peerinfo where email = '$email'";
  $result5 = mysqli_query($conn, $sql5);
  $row = mysqli_fetch_assoc($result5);
  $peerid = $row['peerid'];

  if ($result && $result2 && $result3 && $result4) {
    //send alert success on register login using session
    $_SESSION['success'] = "Registration Success!, wait for account verification!";
    header('Location: login.php');
  } else {
    $error[] = "Something gone wrong try again!";
  }
}
?>
<style>
  #password-validation li.invalid {
    color: red;
  }

  #password-validation li.valid {
    color: green;
  }

  #password-validation li i {
    margin-right: 5px;
  }

  .modal-body h4 {
    color: #f57f17;
    /* Highlighted section color */
    margin-top: 20px;
    margin-bottom: 10px;
  }

  .modal-body p:last-child {
    margin-bottom: 0;
  }
</style>
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Nexus</b>Link</a>
    </div>
    <div class="card-body position-relative">
      <div class="bs-stepper">
        <div class="bs-stepper-header justify-content-center" role="tablist">
          <div class="step" data-target="#personal-info">
            <button type="button" class="step-trigger" role="tab" aria-controls="personal-info" id="personal-info-trigger">
              <span class="bs-stepper-circle"><i class="fas fa-user"></i></span>
              <span class="bs-stepper-label">Personal Information</span>
            </button>
          </div>
          <div class="step" data-target="#student-info">
            <button type="button" class="step-trigger" role="tab" aria-controls="student-info" id="student-info-trigger">
              <span class="bs-stepper-circle"><i class="fas fa-graduation-cap"></i></span>
              <span class="bs-stepper-label">Student Information</span>
            </button>
          </div>
          <div class="step" data-target="#account-info">
            <button type="button" class="step-trigger" role="tab" aria-controls="account-info" id="account-info-trigger">
              <span class="bs-stepper-circle"><i class="fas fa-lock"></i></span>
              <span class="bs-stepper-label">Account Information</span>
            </button>
          </div>
          <div class="step" data-target="#account-type">
            <button type="button" class="step-trigger" role="tab" aria-controls="account-type" id="account-type-trigger">
              <span class="bs-stepper-circle"><i class="fas fa-users"></i></span>
              <span class="bs-stepper-label">Type of Account</span>
            </button>
          </div>
        </div>
        <div class="bs-stepper-content">
          <form id="" method="post">
            <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
              <div class="input-group mb-3">
                <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" pattern="[A-Za-z]+" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" name="middleName" class="form-control" id="middleName" placeholder="Middle Name" pattern="[A-Za-z]+" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" pattern="[A-Za-z]+"required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="date" name="dob" class="form-control" id="dob" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <select name="sex" class="form-control" id="sex" required>
                  <option value="" disabled selected>Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-venus-mars"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary btn-block" type="button" onclick="stepper.next()">Next</button>
            </div>
            <div id="student-info" class="content" role="tabpanel" aria-labelledby="student-info-trigger">
              <div class="input-group mb-3">
                <select class="form-control form-control-plaintext dropdown" id="year" name="year" required>
                  <option value="" disabled selected>Year</option>
                  <option class="dropdown-item" value="1">1st Year</option>
                  <option class="dropdown-item" value="2">2nd Year</option>
                  <option class="dropdown-item" value="3">3rd Year</option>
                  <option class="dropdown-item" value="4">4th Year</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <select class="form-control form-control-plaintext dropdown" id="course" name="course" required>
                  <option class="dropdown-item" disabled selected>Department</option>
                  <option class="dropdown-item" value="CICT"><b>CICT</b> - College of Information and Computing Sciences (CICT)</option>
                  <option class="dropdown-item" value="COE"><b>COE</b> - College of Engineering</option>
                  <option class="dropdown-item" value="COED"><b>COED</b> - College of Education</option>
                  <option class="dropdown-item" value="CAS"><b>CAS</b> - College of Arts and Sciences</option>
                  <option class="dropdown-item" value="COC"><b>COC</b> - College of Criminology</option>
                  <option class="dropdown-item" value="CON"><b>CON</b> - College of Nursing</option>
                  <option class="dropdown-item" value="CMBT"><b>CMBT</b> - College of Management and Business Technology</option>
                  <option class="dropdown-item" value="CIT"><b>CIT</b> - College of Industrial Technology</option>
                  <option class="dropdown-item" value="CPADM"><b>CPADM</b> - College of Public Administration and Management</option>
                  <option class="dropdown-item" value="Others"><b>Others</b></option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" name="studentId" class="form-control" id="studentId" placeholder="Student ID" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-id-card"></i>
                  </div>
                </div>
              </div>
              <button class="btn btn-default btn-block" type="button" onclick="stepper.previous()">Previous</button>
              <button class="btn btn-primary btn-block" type="button" onclick="stepper.next()">Next</button>
            </div>
            <div id="account-info" class="content" role="tabpanel" aria-labelledby="account-info-trigger">
              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <ul id="password-validation" class="list-unstyled">
                  <li class="invalid"><i class="fas fa-times"></i> Must contain at least 8 characters</li>
                  <li class="invalid"><i class="fas fa-times"></i> Must contain at least one number</li>
                  <li class="invalid"><i class="fas fa-times"></i> Must contain at least one uppercase letter</li>
                  <li class="invalid"><i class="fas fa-times"></i> Must contain at least one lowercase letter</li>
                  <li class="invalid"><i class="fas fa-times"></i> Must contain at least one special character</li>
                  <li class="valid"><i class="fas fa-check"></i> Must not contain your birthday</li>
                </ul>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
              </div>
              <button class="btn btn-default btn-block" type="button" onclick="stepper.previous()">Previous</button>
              <button class="btn btn-primary btn-block" type="button" onclick="stepper.next()">Next</button>
            </div>
            <div id="account-type" class="content" role="tabpanel" aria-labelledby="account-type-trigger">
              <div class="input-group mb-3">
                <select class="form-control form-control-plaintext dropdown" id="accountType" name="accountType" required>
                  <option class="dropdown-item" disabled selected>Type of Account</option>
                  <option value="Tutor">Tutor</option>
                  <option value="Tutee">Tutee</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" required>
                    <label for="agreeTerms">
                      I agree to the <a href="#" id="termsLink" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-default btn-block" type="button" onclick="stepper.previous()">Previous</button>
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please read these terms and conditions carefully before using Nexus Link, a peer tutoring and monitoring system. By accessing or using Nexus Link, you agree to be bound by these terms and conditions. If you do not agree with any part of these terms and conditions, please refrain from using Nexus Link.</p>

        <h4>1. Account Registration</h4>
        <p>
          a. To access Nexus Link, you must create an account by providing accurate and complete information.<br>
          b. You are responsible for maintaining the confidentiality of your account login credentials.<br>
          c. You agree to notify us immediately of any unauthorized use or security breach of your account.
        </p>

        <h4>2. User Conduct</h4>
        <p>
          a. You agree to use Nexus Link solely for lawful purposes and in accordance with these terms and conditions.<br>
          b. You will not engage in any activity that may interfere with or disrupt the operation of Nexus Link or its associated services.<br>
          c. You will not attempt to gain unauthorized access to any part of Nexus Link or its users' information.
        </p>

        <h4>3. Peer Tutoring and Monitoring</h4>
        <p>
          a. Nexus Link provides a platform for peer tutoring and monitoring services.<br>
          b. The tutors and monitors using Nexus Link are independent individuals, and their qualifications and expertise may vary.<br>
          c. Nexus Link does not guarantee the accuracy, quality, or effectiveness of the tutoring or monitoring services provided by its users.<br>
          d. Users of Nexus Link are solely responsible for their interactions and engagements with tutors and monitors.
        </p>

        <h4>4. Content and Intellectual Property</h4>
        <p>
          a. Nexus Link may contain user-generated content, including but not limited to text, images, and multimedia.<br>
          b. By using Nexus Link, you grant us a non-exclusive, royalty-free, worldwide license to use, reproduce, modify, adapt, publish, and display the content for the purpose of operating and improving Nexus Link.<br>
          c. You agree not to upload or share any content that infringes upon the intellectual property rights of others.
        </p>

        <h4>5. Privacy and Data Protection</h4>
        <p>
          a. Nexus Link collects and processes personal information in accordance with its Privacy Policy.<br>
          b. By using Nexus Link, you consent to the collection, storage, and processing of your personal information as described in the Privacy Policy.
        </p>

        <h4>6. Limitation of Liability</h4>
        <p>
          a. Nexus Link and its operators shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of or in connection with the use of Nexus Link.<br>
          b. Nexus Link does not assume any responsibility for the actions, content, or conduct of its users.
        </p>

        <h4>7. Modifications to Terms and Conditions</h4>
        <p>
          a. Nexus Link reserves the right to modify or update these terms and conditions at any time.<br>
          b. Any changes to the terms and conditions will be effective upon posting the revised version on Nexus Link.<br>
          c. It is your responsibility to review the terms and conditions periodically to stay informed of any updates.
        </p>

        <h4>8. Governing Law and Jurisdiction</h4>
        <p>
          a. These terms and conditions shall be governed by and construed in accordance with the laws of [Your Jurisdiction].<br>
          b. Any disputes arising out of or in connection with these terms and conditions shall be subject to the exclusive jurisdiction of the courts in [Your Jurisdiction].
        </p>

        <p>By using Nexus Link, you acknowledge that you have read, understood, and agreed to these terms and conditions.</p>

        <p>Please note that this is a sample document, and it's advisable to consult with a legal professional to ensure that the terms and conditions are tailored to your specific requirements and comply with applicable laws in your jurisdiction.</p>
      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>