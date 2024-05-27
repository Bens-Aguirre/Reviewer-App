<?php
require_once '../config.php';

// Fetch data from the database
$sql = "SELECT * FROM `fc_tbl` ORDER BY 1 DESC";
$result1 = mysqli_query($conn, $sql);

// Check if any data was fetched
if ($result1 && mysqli_num_rows($result1) > 0) {
    // Loop through the fetched data
    while ($row = mysqli_fetch_assoc($result1)) {
        // Fetch the subject ID and name associated with the flashcard
        $subId = $row['id']; // Ensure this matches the column name in your database for the subject ID
        $selSub = $conn->query("SELECT name as subName FROM gen_tbl WHERE id='$subId'");
        if ($selSub && $selSub->num_rows > 0) {
            $selSubRow = $selSub->fetch_assoc();
            $subName = $selSubRow['subName'];
        } else {
            // Handle error if query fails or returns no results
            $error = $conn->error;
            $subName = "Unknown Subject";
            echo "Error: $error for subject ID $subId<br>";
        }
?>
    <div class="modal fade" id="modalForUpdateFc<?= $row['fc_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="right: 0px; bottom: 0px; margin-top:80px; display:none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Flashcard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="updateFcFrm">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <input type="hidden" id="fc_id" name="fc_id" value="<?= $row['fc_id'] ?>">
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="subId" required="">
                                    <option value="<?php echo $subId; ?>"><?php echo $subName; ?></option>
                                    <?php 
                                    $selAllSub = $conn->query("SELECT * FROM gen_tbl ORDER BY id DESC");
                                    if ($selAllSub) {
                                        while ($selAllSubRow = $selAllSub->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $selAllSubRow['id']; ?>"><?php echo $selAllSubRow['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        // Handle error if query fails
                                        echo "Error: " . $conn->error;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="updateQuestion">Question</label>
                                <input type="text" class="form-control" id="question" name="question" value="<?= $row['question'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="updateAnswer">Answer</label>
                                <input type="text" class="form-control" id="answer" name="answer" value="<?= $row['answer'] ?>" required>
                            </div>
                            <div class="form-group" align="right">
                                <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    }
} else {
    // Handle the case where no data is fetched
    echo "Error: No data fetched from the database";
}
?>
