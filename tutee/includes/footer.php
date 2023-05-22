<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
    $('#filterBtn').click(function() {
      // Get form data
      var formData = $('#filterForm').serialize();
      // AJAX call to filter tutors
      $.ajax({
        url: 'filter_tutors.php',
        method: 'POST',
        data: formData,
        success: function(response) {
          // Display filtered tutors
          $('#tutors').html(response);
        }
      });
    });
  });
</script>
</body>

</html>