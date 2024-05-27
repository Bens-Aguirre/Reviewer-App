<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() { null };
</script>

<?php 
$examId = $_GET['id'];
require_once '../config.php'; // Ensure you have this to establish a database connection

// Create a prepared statement to avoid SQL injection
$stmt = $conn->prepare("SELECT * FROM pt_tbl WHERE pt_id = ?");
$stmt->bind_param("i", $examId);  // 'i' for integer type

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch the associative array
$selExam = $result->fetch_assoc();

// Close the statement
$stmt->close();

// Assign variables
$ptDisplayLimit = $selExam['pt_questlimit_display'];
?>

<div class="app-main__outer">
    <div class="app-main__inner">
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
        </div>

        <div class="col-md-12 p-0 mb-4">
            <form method="post" id="submitPtAnswerFrm">
                <input type="hidden" name="prac_id" id="prac_id" value="<?php echo $examId; ?>">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                    // Query to select questions
                    $selQuest = $conn->query("SELECT * FROM pt_question_tbl WHERE prac_id='$examId' ORDER BY RAND() LIMIT $ptDisplayLimit");

                    // Check if there are any questions returned
                    if(mysqli_num_rows($selQuest) > 0) {
                        $i = 1;
                        while ($selQuestRow = mysqli_fetch_assoc($selQuest)) { 
                            $questId = $selQuestRow['eqt_id']; ?>
                            <tr>
                                <td>
                                    <p><b><?php echo $i++; ?>.) <?php echo $selQuestRow['exam_question']; ?></b></p>
                                    <div class="col-md-4 float-left">
                                        <div class="form-group pl-4">
                                            <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch1']; ?>" class="form-check-input" type="radio" required>
                                            <label class="form-check-label">
                                                <?php echo $selQuestRow['exam_ch1']; ?>
                                            </label>
                                        </div>  

                                        <div class="form-group pl-4">
                                            <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch2']; ?>" class="form-check-input" type="radio" required>
                                            <label class="form-check-label">
                                                <?php echo $selQuestRow['exam_ch2']; ?>
                                            </label>
                                        </div>   
                                    </div>
                                    <div class="col-md-8 float-left">
                                        <div class="form-group pl-4">
                                            <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch3']; ?>" class="form-check-input" type="radio" required>
                                            <label class="form-check-label">
                                                <?php echo $selQuestRow['exam_ch3']; ?>
                                            </label>
                                        </div>  

                                        <div class="form-group pl-4">
                                            <input name="answer[<?php echo $questId; ?>][correct]" value="<?php echo $selQuestRow['exam_ch4']; ?>" class="form-check-input" type="radio" required>
                                            <label class="form-check-label">
                                                <?php echo $selQuestRow['exam_ch4']; ?>
                                            </label>
                                        </div>   
                                    </div>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td style="padding: 20px;">
                                <button type="button" class="btn btn-xlg btn-warning p-3 pl-4 pr-4" id="resetPtFrm">Reset</button>
                                <input name="submit" type="submit" value="Submit" class="btn btn-xlg btn-primary p-3 pl-4 pr-4 float-right" id="submitPtAnswerFrmBtn">
                            </td>
                        </tr>
                    <?php
                    } else { ?>
                        <b>No question at this moment</b>
                    <?php }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
