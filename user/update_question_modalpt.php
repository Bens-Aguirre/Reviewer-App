
<?php 
  require_once '../config.php';
  $id = $_GET['id'];
 
  $selSubResult = $conn->query("SELECT * FROM pt_question_tbl WHERE eqt_id='$id'");
if ($selSubResult) {
    $selSub = $selSubResult->fetch_assoc();
} else {
    echo "Error: " . $conn->error;
}
 ?>

<fieldset>
	<legend style="font-size: 15px;"><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update Question</i></legend>
  
  <div class="col-md-12 mt-4">
    <form method="post" id="updatePtQuestionFrm">
      <div class="form-group">
        <legend style="font-size: 15px;">Question</legend>
        <input type="hidden" name="question_id" value="<?php echo $id; ?>">
        <textarea name="question" class="form-control" rows="2" required=""><?php echo $selSub['exam_question']; ?></textarea>
      </div>


      <div class="form-group">
        <legend style="font-size: 15px;">Choice A</legend>
        <input type="" name="exam_ch1" value="<?php echo $selSub['exam_ch1']; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <legend style="font-size: 15px;">Choice B</legend>
        <input type="" name="exam_ch2" value="<?php echo $selSub['exam_ch2']; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <legend style="font-size: 15px;">Choice C</legend>
        <input type="" name="exam_ch3" value="<?php echo $selSub['exam_ch3']; ?>" class="form-control" required>
      </div>
      <div class="form-group">
        <legend style="font-size: 15px;">Choice D</legend>
        <input type="" name="exam_ch4" value="<?php echo $selSub['exam_ch4']; ?>" class="form-control" required>
      </div>

      <div class="form-group">
        <legend class="text-success" style="font-size: 15px;">Correct Answer</legend>
        <input type="" name="exam_answer" value="<?php echo $selSub['exam_answer']; ?>" class="form-control" required>
      </div>


      <div class="form-group" align="right">
        <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
      </div>
    </form>
  </div>
</fieldset>







