<?php
require_once '../config.php';

// Fetch count of exams
$examQuery = "SELECT COUNT(*) as examCount FROM exam_tbl";
$examResult = mysqli_query($conn, $examQuery);
$examRow = mysqli_fetch_assoc($examResult);
$examCount = $examRow['examCount'];

// Fetch count of users
$userQuery = "SELECT COUNT(*) as userCount FROM users";
$userResult = mysqli_query($conn, $userQuery);
$userRow = mysqli_fetch_assoc($userResult);
$userCount = $userRow['userCount'];

// Fetch count of subjects
$subjectQuery = "SELECT COUNT(*) as subjectCount FROM gen_tbl";
$subjectResult = mysqli_query($conn, $subjectQuery);
$subjectRow = mysqli_fetch_assoc($subjectResult);
$subjectCount = $subjectRow['subjectCount'];

// Fetch count of practice tests
$practiceTestQuery = "SELECT COUNT(*) as practiceTestCount FROM pt_tbl";
$practiceTestResult = mysqli_query($conn, $practiceTestQuery);
$practiceTestRow = mysqli_fetch_assoc($practiceTestResult);
$practiceTestCount = $practiceTestRow['practiceTestCount'];
?>

<!--state overview start-->
<div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
        <section class="card">
            <div class="symbol terques">
                <i class="fa fa-book"></i>
            </div>
            <div class="value">
                <h1 class="count">
                    <?php echo $examCount; ?>
                </h1>
                <p>Exam</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="card">
            <div class="symbol red">
                <i class=" fa fa-users"></i>
            </div>
            <div class="value">
                <h1 class=" count2">
                    <?php echo $userCount; ?>
                </h1>
                <p>User</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="card">
            <div class="symbol yellow">
                <i class="fa fa-list-alt"></i>
            </div>
            <div class="value">
                <h1 class=" count3">
                    <?php echo $subjectCount; ?>
                </h1>
                <p>Subject</p>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="card">
            <div class="symbol blue">
                <i class="fa fa-pencil-square-o"></i>
            </div>
            <div class="value">
                <h1 class=" count4">
                    <?php echo $practiceTestCount; ?>
                </h1>
                <p>Practice Test/Quizzes</p>
            </div>
        </section>
    </div>
</div>
<!--state overview end-->
