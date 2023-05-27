<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexus Link v2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<style>
    .bg-gradient-bsit {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-coe {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-coed {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-cas {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-coc {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-con {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-cmbt {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-cit {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-cpadm {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }

    .bg-gradient-lbh {
        background: linear-gradient(to right, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%);
    }
    #calendar {
      margin-top: 20px;
    }

    /* Responsive styles */
    @media screen and (max-width: 767px) {
      .container {
        max-width: 100%;
        padding: 5px;
      }
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        session_start();

        // check if the user is the correct category the category is 1
        if ($_SESSION["category"] != 3) {
            // if not, redirect to the login page
            header("location: ../login.php");
            exit();
        } else {
            $auth_id = $_SESSION["auth_id"];
        }
        ?>