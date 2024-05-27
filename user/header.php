<?php
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once 'home.php';
session_start();

$user_id = null; // Initialize user_id as null

if (isset($_SESSION["user_id"])) {
    $conn = require __DIR__ . "/../config.php";
    
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        $user_id = $user['user_id']; // Set user_id if user is found
    }
} else {
    $user = null;
}

$page = htmlspecialchars(basename($_SERVER['PHP_SELF'])); // Get the current page name

$title = ''; // Initialize the title variable

// Determine the title based on the current page
if($page == 'user_subject.php'){
    $title = 'Subjects';
}elseif($page == 'user_fctbl.php'){
    $title = 'Flashcards';
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
    <style>
        /* Ensure the container doesn't have unnecessary margins or padding */
        
        </style>
    <link rel="shortcut icon" href="img/favicon.html">
    <!--  summernote -->
    <link href="assets/summernote/dist/summernote.css" rel="stylesheet">
    <title>User Panel</title>

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

    <style>
        .flashcard {
            margin-bottom: 20px;
        }
        .flashcard .card-body {
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>

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
                            <span
                                class="username"><?php if (isset($user)): ?>
                                    <?= htmlspecialchars($user["name"]) ?>
                                    <?php endif; ?>
                                </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout dropdown-menu-right">
                            <div class="log-arrow-up"></div>
                            <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
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
                        <a href="user_subject.php" <?= $page == 'user_subject.php' ? 'class="active"' : '' ?>>
                            <i class="fa fa-book"></i>
                            <span>Subjects</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_fctbl.php" <?= $page == 'user_fctbl.php' ? 'class="active"' : '' ?>>
                            <i class="fa fa-info-circle"></i>
                            <span>Flashcards</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-pencil-square-o"></i>
                            <span>Practice Tests</span>
                        </a>
                        <ul class="sub">
                            <?php 
                                // Execute your query here
                                $selExam = $conn->query("SELECT * FROM pt_tbl"); // Adjust the query as needed

                                if (mysqli_num_rows($selExam) > 0) {
                                    while ($selExamRow = mysqli_fetch_assoc($selExam)) { ?>
                                        <li>
                                            <a href="#" id="startPtQuiz" data-id="<?php echo $selExamRow['pt_id']; ?>">
                                                <?php 
                                                    $lengthOfTxt = strlen($selExamRow['pt_title']);
                                                    if ($lengthOfTxt >= 23) { ?>
                                                        <?php echo substr($selExamRow['pt_title'], 0, 20); ?>.....
                                                    <?php } else {
                                                        echo $selExamRow['pt_title'];
                                                    }
                                                ?>
                                            </a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <a href="#">
                                        <i class="metismenu-icon"></i>No Exam's @ the moment
                                    </a>
                                <?php }
                            ?>
                        </ul>
                    </li>
                    <li>
                            <span>Taken PT</span>
                                </li>
                        <li>
                        <?php 
                        // Execute your query here Your connection should be already established in $conn

                            // Execute the query
                            $selTakenExam = $conn->query("SELECT * FROM pt_tbl pt INNER JOIN pt_attempt pa ON pt.pt_id = pa.prac_id WHERE user_id='$user_id' ORDER BY pa.ptat_id");

                            // Check if there are any rows returned
                            if(mysqli_num_rows($selTakenExam) > 0)
                            {
                                // Fetch and display each row
                                while ($selTakenExamRow = mysqli_fetch_assoc($selTakenExam)) { ?>
                                    <a href="home.php?page=ptresult&id=<?php echo $selTakenExamRow['pt_id']; ?>">
                                        <?php echo $selTakenExamRow['pt_title']; ?>
                                    </a>
                                <?php }
                            }
                            else
                            { ?>
                                <a href="#" class="pl-3">You are not taking exam yet</a>
                            <?php }
                        ?>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-lightbulb-o"></i>
                            <span>Exam</span>
                        </a>
                        <ul class="sub">
                            <?php 
                                // Execute your query here
                                $selExam = $conn->query("SELECT * FROM exam_tbl"); // Adjust the query as needed

                                if (mysqli_num_rows($selExam) > 0) {
                                    while ($selExamRow = mysqli_fetch_assoc($selExam)) { ?>
                                        <li>
                                            <a href="#" id="startQuiz" data-id="<?php echo $selExamRow['exam_id']; ?>">
                                                <?php 
                                                    $lengthOfTxt = strlen($selExamRow['ex_title']);
                                                    if ($lengthOfTxt >= 23) { ?>
                                                        <?php echo substr($selExamRow['ex_title'], 0, 20); ?>.....
                                                    <?php } else {
                                                        echo $selExamRow['ex_title'];
                                                    }
                                                ?>
                                            </a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <a href="#">
                                        <i class="metismenu-icon"></i>No Exam's @ the moment
                                    </a>
                                <?php }
                            ?>
                            </ul>
                        </li>
                        <li>
                            <span>Taken Exam</span>
                                </li>
                        <li>
                        <?php 
                        // Execute your query here Your connection should be already established in $conn

                            // Execute the query
                            $selTakenExam = $conn->query("SELECT * FROM exam_tbl et INNER JOIN exam_attempt ea ON et.exam_id = ea.ex_id WHERE user_id='$user_id' ORDER BY ea.examat_id");

                            // Check if there are any rows returned
                            if(mysqli_num_rows($selTakenExam) > 0)
                            {
                                // Fetch and display each row
                                while ($selTakenExamRow = mysqli_fetch_assoc($selTakenExam)) { ?>
                                    <a href="home.php?page=result&id=<?php echo $selTakenExamRow['exam_id']; ?>">
                                        <?php echo $selTakenExamRow['ex_title']; ?>
                                    </a>
                                <?php }
                            }
                            else
                            { ?>
                                <a href="#" class="pl-3">You are not taking exam yet</a>
                            <?php }
                        ?>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

            