<?php
// get the details of user using auth_id
$sql = "SELECT * FROM tbl_peerinfo WHERE auth_id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $auth_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
    $peerid = $row["peerid"];
    $firstname = $row["firstname"];
    $middlename = $row["middlename"];
    $lastname = $row["lastname"];
    $email = $row["email"];

    $fullname = $firstname . ' ' . $lastname;
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Nexus<b>Link</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $fullname ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php if($active_page == "dashboard"){
                        echo "active";
                    }?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- Search and Filter Tutors -->
                <li class="nav-item">
                    <a href="tutor_list.php" class="nav-link <?php if($active_page == "tutor_list"){
                        echo "active";
                    }?>">
                        <i class="fas fa-search nav-icon"></i>
                        <p>Search and Filter Tutors</p>
                    </a>
                </li>

                <!-- My Tutors -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-tie nav-icon"></i>
                        <p>My Tutors</p>
                    </a>
                </li>

                <!-- Schedule and Messages -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Schedule and Messages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-calendar-alt nav-icon"></i>
                                <p>Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-envelope nav-icon"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Resources and Settings -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Tools
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Resources</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog nav-icon"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="../logout.php?peerid=<?php echo $peerid?>" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>