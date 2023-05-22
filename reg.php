<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexus Link | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/css/bs-stepper.min.css" rel="stylesheet">
</head>
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
</style>

<body class="hold-transition register-page">
    <!-- Include the required CSS and JavaScript files -->

    <?php
    include_once('includes/conn.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $firstname = $_POST["firstname"];
  $middlename = $_POST["middlename"];
  $lastname = $_POST["lastname"];
  $dob = $_POST["dob"];
  $sex = $_POST["sex"];
  $email = $_POST["email"];
  $year = $_POST["year"];
  $course = $_POST["course"];
  $student_number = $_POST["student_number"];
  $cor = $_FILES["cor"]["name"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $account_type = $_POST["account_type"];

  // Validate the form data (e.g., check for empty fields, validate email format, etc.)
  // ...

  // Insert data into tbl_peerinfo
  $sql = "INSERT INTO tbl_peerinfo (firstname, middlename, lastname, dob, sex, email, year, course, student_number, category) VALUES ('$firstname', '$middlename', '$lastname', '$dob', '$sex', '$email', '$year', '$course', '$student_number', '$account_type')";
  if ($conn->query($sql) !== TRUE) {
    die("Error inserting data into tbl_peerinfo: " . $conn->error);
  }

  // Get the peerid of the inserted record
  $peerid = $conn->insert_id;

  // Insert data into tbl_auth
  $sql = "INSERT INTO tbl_auth (peerid, username, password, category) VALUES ('$peerid', '$username', '$password', '$account_type')";
  if ($conn->query($sql) !== TRUE) {
    die("Error inserting data into tbl_auth: " . $conn->error);
  }

  // Close the database connection
  $conn->close();

  // Redirect to a success page or display a success message
  // ...
}
?>


    <div class="register-box">
        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Nexus Link</b>v2</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Fillout the details</p>
                <!-- Step 1: Personal Info -->
                <form action="" method="post" id="step1" class="content">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="First Name" name="firstname" pattern="[A-Za-z]+" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Middle Name" name="middlename" pattern="[A-Za-z]+" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastname" pattern="[A-Za-z]+" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" placeholder="Date of Birth" name="dob" id="dob">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control" name="sex">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-venus-mars"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- Step 1 button -->
                            <button type="button" class="btn btn-outline-danger btn-block next-button">Next</button>
                        </div>
                    </div>
                </form>

                <!-- Step 2: Student Info -->
                <form action="" method="post" id="step2" class="content">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Year" name="year">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control form-control dropdown" id="course" name="course">
                            <option class="dropdown-item" disabled default>Department</option>
                            <option class="dropdown-item" value="CICT"><b>CICT</b> - College of Information and Computing Sciences (CICT)</option>
                            <option class="dropdown-item" value="COE"><b>COE</b> - College of Engineering</option>
                            <option class="dropdown-item" value="COED"><b>COED</b> - College of Education</option>
                            <option class="dropdown-item" value="CAS"><b>CAS</b> - College of Arts and Sciences</option>
                            <option class="dropdown-item" value="COC"><b>COC</b> - College of Criminology</option>
                            <option class="dropdown-item" value="CON"><b>CON</b> - College of Nursing</option>
                            <option class="dropdown-item" value="CMBT"><b>CMBT</b> - College of Management and Business Technology</option>
                            <option class="dropdown-item" value="CIT"><b>CIT</b> - College of Industrial Technology</option>
                            <option class="dropdown-item" value="CPADM"><b>CPADM</b> - College of Public Administration and Disaster Management</option>
                            <option class="dropdown-item" value="LBH"><b>LBH</b> - Laboratory Highschool</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-building"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Student Number" name="student_number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-graduate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cor" name="cor">
                            <label class="custom-file-label" for="cor">Upload COR</label>
                        </div>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-graduation-cap"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Step 2 buttons -->
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-danger btn-block prev-button">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary btn-block next-button">Next</button>
                        </div>
                    </div>
                </form>

                <!-- Step 3: Account Info -->
                <form action="" method="post" id="step3" class="content">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
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
                        <input type="password" class="form-control" placeholder="Confirm Password" name="conf_password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Step 3 buttons -->
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-danger btn-block prev-button">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary btn-block next-button">Next</button>
                        </div>

                    </div>
                </form>

                <!-- Step 4: Account Type -->
                <form action="" method="post" id="step4" class="content">
                    <div class="input-group mb-3">
                        <select class="form-control" name="account_type">
                            <option value="" selected disabled>Select Account Type</option>
                            <option value="Student">Tutor</option>
                            <option value="Teacher">Tutee</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Step 4 buttons -->
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-danger btn-block prev-button">Previous</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <a href="login.html" class="text-center bg-sucess">I already have an account</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
    <script>

        // JavaScript for Step Navigation
        document.addEventListener("DOMContentLoaded", function() {
            const formSteps = document.querySelectorAll(".content");
            const prevButtons = document.querySelectorAll(".prev-button");
            const nextButtons = document.querySelectorAll(".next-button");
            let currentStep = 1;

            function showStep(step) {
                formSteps.forEach(function(formStep) {
                    formStep.style.display = "none";
                });

                formSteps[step - 1].style.display = "block";
            }

            function nextStep() {
                if (currentStep < formSteps.length) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            function prevStep() {
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            prevButtons.forEach(function(prevButton) {
                prevButton.addEventListener("click", prevStep);
            });

            nextButtons.forEach(function(nextButton) {
                nextButton.addEventListener("click", nextStep);
            });

            showStep(currentStep);
        });


        $(document).ready(function() {
            $('#password').on('keyup', function() {
                var password = $(this).val();
                var birthday = $('#dob').val();
                
                //get the month and day on birthday the format is yyyy-dd-mm
                var birthday = new Date(birthday.substring(0, 4), birthday.substring(5, 7) - 1, birthday.substring(8, 10));
                var month = birthday.getMonth() + 1;
                var day = birthday.getDate();


                // Validate password length
                if (password.length >= 8) {
                    $('#password-validation li:nth-child(1)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                } else {
                    $('#password-validation li:nth-child(1)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }

                // Validate number presence
                if (/\d/.test(password)) {
                    $('#password-validation li:nth-child(2)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                } else {
                    $('#password-validation li:nth-child(2)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }

                // Validate uppercase letter presence
                if (/[A-Z]/.test(password)) {
                    $('#password-validation li:nth-child(3)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                } else {
                    $('#password-validation li:nth-child(3)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }

                // Validate lowercase letter presence
                if (/[a-z]/.test(password)) {
                    $('#password-validation li:nth-child(4)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                } else {
                    $('#password-validation li:nth-child(4)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }

                // Validate special character presence
                if (/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(password)) {
                    $('#password-validation li:nth-child(5)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                } else {
                    $('#password-validation li:nth-child(5)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }

                // birthday month and day must on contains to password
                if (birthday != '' && password != '') {
                    if (password.indexOf(month) >= 0 || password.indexOf(day) >= 0) {
                        $('#password-validation li:nth-child(6)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                    } else {
                        $('#password-validation li:nth-child(6)').removeClass('invalid').addClass('valid').find('i').removeClass('fas fa-times').addClass('fas fa-check');
                    }
                } else {
                    $('#password-validation li:nth-child(6)').removeClass('valid').addClass('invalid').find('i').removeClass('fas fa-check').addClass('fas fa-times');
                }
            });
        });
    </script>

    <!-- /.register-box -->

    <!-- jQuery -->
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>
</body>

</html>