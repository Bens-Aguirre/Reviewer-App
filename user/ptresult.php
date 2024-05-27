<?php 
    $examId = $_GET['id'];
    $result = $conn->query("SELECT * FROM pt_tbl WHERE pt_id='$examId'");

    if ($result) {
        $selExam = $result->fetch_assoc();
    } else {
        // Handle error if query fails
        echo "Error: " . $conn->error;
    }
?>


<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
            
    <div class="col-md-12">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <?php echo $selExam['pt_title']; ?>
                          <div class="page-title-subheading">
                            <?php echo $selExam['pt_desc']; ?>
                          </div>

                    </div>
                </div>
            </div>
        </div>  
        <div class="row col-md-12">
        	<h1 class="text-primary">RESULT'S</h1>
        </div>

        <div class="row col-md-6 float-left">
        	<div class="main-card mb-3 card">
                <div class="card-body">
                	<h5 class="card-title">Your Answer's</h5>
        			<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                        $selQuest = $conn->query("SELECT * FROM pt_question_tbl pqt INNER JOIN pt_answers pa ON pqt.eqt_id = pa.ptquest_id WHERE pqt.prac_id='$examId' AND pa.ptaxmne_id='$user_id' AND pa.ptans_status='new'");
                        $i = 1;
                        while ($selQuestRow = $selQuest->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <b><p><?php echo $i++; ?> .) <?php echo $selQuestRow['exam_question']; ?></p></b>
                                    <label class="pl-4 text-success">
                                        Answer : 
                                        <?php 
                                            if($selQuestRow['exam_answer'] != $selQuestRow['ptans_answer']) { ?>
                                                <span style="color:red"><?php echo $selQuestRow['ptans_answer']; ?></span>
                                            <?php } else { ?>
                                                <span class="text-success"><?php echo $selQuestRow['ptans_answer']; ?></span>
                                            <?php }
                                        ?>
                                    </label>
                                </td>
                            </tr>
                        <?php }
                    ?>

	                 </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 float-left">
        	<div class="col-md-6 float-left">
        	<div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Score</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM pt_question_tbl pqt INNER JOIN pt_answers pa ON pqt.eqt_id = pa.ptquest_id AND pqt.exam_answer = pa.ptans_answer  WHERE pa.ptaxmne_id='$user_id' AND pa.prac_id='$examId' AND pa.ptans_status='new' ");
                            ?>
                            <span>
                            <?php 
                                    $rowCount = $selScore->num_rows;
                                    echo $rowCount;
                                    ?>

                                <?php 
                                    $over  = $selExam['pt_questlimit_display'];
                                 ?>
                            </span> / <?php echo $over; ?>
                        </div>
                    </div>
                </div>
            </div>
        	</div>

            <div class="col-md-6 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Percentage</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM pt_question_tbl pqt INNER JOIN pt_answers pa ON pqt.eqt_id = pa.ptquest_id AND pqt.exam_answer = pa.ptans_answer  WHERE pa.ptaxmne_id='$user_id' AND pa.prac_id='$examId' AND pa.ptans_status='new' ");
                            ?>
                            <span>
                                <?php 
                                    $score = $selScore->num_rows;
                                    $ans = $score / $over * 100;
                                    echo number_format($ans,2);
                                    echo "%";
                                    
                                 ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    </div>
</div>
