<?php
require_once '../vendor/autoload.php';

$page = htmlspecialchars(basename($_SERVER['PHP_SELF'])); // Get the current page name

$title = ''; // Initialize the title variable

// Determine the title based on the current page
if($page == 'admin_index.php'){
    $title = 'Home';
}elseif($page == 'admin_addgen.php' || $page == 'admin_geneduc.php'){
    $title = 'Education Subjects';
}elseif($page == 'add_fc.php' || $page == 'manage_fc.php'){
    $title = 'Education Subjects';
}
elseif($page == 'add_pt.php' || $page == 'manage_pt.php'){
    $title = 'Post';
}
elseif($page == 'addexam.php' || $page =='manage_exam.php'){
    $title = 'Exam';
}
elseif($page == 'admin_users.php'){
    $title = 'Users';
}
else{
    $title = 'Home'; // Default title if no match found
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <link href="css/facebox.css" rel="stylesheet">
    <!--  summernote -->
    <link href="assets/summernote/dist/summernote.css" rel="stylesheet">
    <title><?= $title . ' | '?>User Panel</title>

    <link href="css/main.css" rel="stylesheet">
    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <!--dynamic table-->
    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css" />
    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body>

    <section id="container">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <i class="fa fa-bars"></i>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo"><span>ReviewSavvy</span></a>
            <!--logo end-->
            
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">Admin
                                </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout dropdown-menu-right">
                            <div class="log-arrow-up"></div>
                            <li><a href="admin_logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a href="admin_index.php" <?= $page == 'admin_index.php' ? 'class="active"' : '' ?>>
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" <?= ($page == 'admin_addgen.php' || $page == 'admin_geneduc.php') ? 'class="active"' : '' ?>>
                            <i class="fa fa-book"></i>
                            <span>Subjects</span>
                        </a>
                        <ul class="sub">
                            <li <?= $page == 'admin_addgen.php' ? 'class="active"' : '' ?>><a href="admin_addgen.php">Add Subjects</a></li>
                            <li <?= $page == 'admin_geneduc.php' ? 'class="active"' : '' ?>><a href="admin_geneduc.php">Manage Subjects</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" <?= ($page == 'add_fc.php' || $page == 'manage_fc.php') ? 'class="active"' : '' ?>>
                            <i class="fa fa-info-circle"></i>
                            <span>Flashcards</span>
                        </a>
                        <ul class="sub">
                            <li <?= $page == 'add_fc.php' ? 'class="active"' : '' ?>><a href="add_fc.php">Add Flashcard</a></li>
                            <li <?= $page == 'manage_fc.php' ? 'class="active"' : '' ?>><a href="manage_fc.php">Manage Flashcard</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" <?= ($page == 'add_pt.php' || $page == 'manage_pt.php') ? 'class="active"' : '' ?>>
                            <i class="fa fa-pencil-square-o"></i>
                            <span>Practice Tests</span>
                        </a>
                        <ul class="sub">
                            <li <?= $page == 'add_pt.php' ? 'class="active"' : '' ?>><a href="add_pt.php">Add Practice Test</a></li>
                            <li <?= $page == 'manage_pt.php' ? 'class="active"' : '' ?>><a href="manage_pt.php">Manage Practice Test</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" <?= ($page == 'addexam.php' || $page == 'manage_exam.php') ? 'class="active"' : '' ?>>
                            <i class="fa fa-lightbulb-o"></i>
                            <span>Exam</span>
                        </a>
                        <ul class="sub">
                            <li <?= $page == 'addexam.php' ? 'class="active"' : '' ?>><a href="addexam.php">Add Exam</a></li>
                            <li <?= $page == 'manage_exam.php' ? 'class="active"' : '' ?>><a href="manage_exam.php">Manage Exam</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="admin_users.php" <?= $page == 'admin_users.php' ? 'class="active"' : '' ?>>
                            <i class="fa fa-user"></i>
                            <span>Manage Users</span>
                        </a>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">