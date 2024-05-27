<?php require_once 'admin_header.php'; ?>
<?php require_once '../config.php'; ?>

<?php
$exId = $_GET['id'];

// Assuming $conn is your mysqli connection object
$selExam = $conn->query("SELECT * FROM pt_tbl WHERE pt_id='$exId'");
if ($selExam) {
    $selExamRow = $selExam->fetch_assoc();

    $subId = $selExamRow['id'];
    $selSub = $conn->query("SELECT name as subName FROM gen_tbl WHERE id='$subId'");
    if ($selSub) {
        $selSubRow = $selSub->fetch_assoc();
        $subName = $selSubRow['subName'];
        // Now you can use $subName
    } else {
        // Handle error if query fails
        echo "Error: " . $conn->error;
    }
} else {
    // Handle error if query fails
    echo "Error: " . $conn->error;
}
?>

<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> Manage Practice Test
                            <div class="page-title-subheading">
                              Add Question for <?php echo $selExamRow['pt_title']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
            <div id="refreshData">
            <div class="row">
                  <div class="col-md-6">
                      <div class="main-card mb-3 card">
                          <div class="card-header">
                            <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Practice Test Information
                          </div>
                          <div class="card-body">
                           <form method="post" id="updatePtFrm">
                               <div class="form-group">
                                <label>Subject</label>
                                <select class="form-control" name="subId" required="">
                                <option value="<?php echo $selExamRow['id']; ?>"><?php echo $selSubRow['subName']; ?></option>
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
                                <label>Practice Test Title</label>
                                <input type="hidden" name="ptId" value="<?php echo $selExamRow['pt_id']; ?>">
                                <input type="" name="ptTitle" class="form-control" required="" value="<?php echo $selExamRow['pt_title']; ?>">
                              </div>  

                              <div class="form-group">
                                <label>Description</label>
                                <input type="" name="ptDesc" class="form-control" required="" value="<?php echo $selExamRow['pt_desc']; ?>">
                              </div>  

                              <div class="form-group">
                                <label>Display limit</label>
                                <input type="number" name="ptQuestDipLimit" class="form-control" value="<?php echo $selExamRow['pt_questlimit_display']; ?>"> 
                              </div>

                              <div class="form-group" align="right">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                              </div> 
                           </form>                           
                          </div>
                      </div>
                   
                  </div>
                  <div class="col-md-6">
                    <?php 
                        $selQuest = $conn->query("SELECT * FROM pt_question_tbl WHERE prac_id='$exId' ORDER BY eqt_id desc");
                    ?>
                     <div class="main-card mb-3 card">
                          <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Practice Test Question's 
                            <span class="badge badge-pill badge-primary ml-2">
                            <?php 
                                if ($selQuest) {
                                    $row_count = mysqli_num_rows($selQuest);
                                    echo $row_count;
                                } else {
                                    // Handle query error
                                    echo "Error: " . $conn->error;
                                }
                                ?>
                            </span>
                             <div class="btn-actions-pane-right">
                                <button class="btn btn-sm btn-primary " data-toggle="modal" data-target="#modalForAddQuestionPt">Add Question</button>
                              </div>
                          </div>
                          <div class="card-body" >
                            <div class="scroll-area-sm" style="min-height: 400px;">
                               <div class="scrollbar-container">

                            <?php 
                               
                               if($selQuest->num_rows > 0)
                               {  ?>
                                 <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-1">Subject Name</th>
                                            <th class="text-center" width="20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if ($selQuest->num_rows > 0) {
                                                $i = 1;
                                                while ($selQuestionRow = $selQuest->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                        <td >
                                                            <b><?php echo $i++ ; ?>.) <?php echo $selQuestionRow['exam_question']; ?></b><br>
                                                            <?php 
                                                              // Choice A
                                                              if($selQuestionRow['exam_ch1'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">A - <?php echo  $selQuestionRow['exam_ch1']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">A - <?php echo $selQuestionRow['exam_ch1']; ?></span><br>
                                                              <?php }

                                                              // Choice B
                                                              if($selQuestionRow['exam_ch2'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                                              <?php }

                                                              // Choice C
                                                              if($selQuestionRow['exam_ch3'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                                              <?php }

                                                              // Choice D
                                                              if($selQuestionRow['exam_ch4'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                                              <?php }

                                                             ?>
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                        <a rel="facebox" href="update_question_modalpt.php?id=<?php echo $selQuestionRow['eqt_id']; ?>" class="btn btn-sm btn-primary mt-3 mb-2">Update</a>
                                                         
                                                         <button type="button" id="deletePtQuestion" data-id='<?php echo $selQuestionRow['eqt_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                               <?php }
                                            }
                                            else
                                            { ?>
                                                <tr>
                                                  <td colspan="2">
                                                    <h3 class="p-3">No Subject Found</h3>
                                                  </td>
                                                </tr>
                                            <?php }
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                               <?php }
                               else
                               { ?>
                                  <h6 class="text-primary">No Question Found...</h6>
                                 <?php
                               }
                             ?>
                               </div>
                            </div>


                          </div>
                        
                      </div>
                  </div>
              </div>  
            </div> 
            </div>
               
            </div>

<?php require_once 'modals.php'; ?>
<?php require_once 'footer.php'; ?>