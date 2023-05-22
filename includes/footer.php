</body>
<script>
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
    </script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
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


</html>
