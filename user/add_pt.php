<?php require_once 'admin_header.php' ?>


<div class="row">
        <div class="col-lg-6 offset-lg-3">
            <section class="card">
                <header class="card-header">
                    <h3 style="display: inline-block;margin-right: 25px;">Add Practice Test</h3>
                </header>
                <div class="card-body">
                    <form class="refreshFrm" id="addPracFrm" method="post">
                    <div class="form-group">
            <label>Select Subject</label>
            <select class="form-control" name="subSelected">
              <option value="0">Select Subject</option>
              <?php 
                require_once '../config.php';
                $selSub = $conn->query("SELECT * FROM gen_tbl ORDER BY id DESC");
                if($selSub->num_rows > 0)
                {
                    while ($selSubRow = $selSub->fetch_assoc()) { ?>
                        <option value="<?php echo $selSubRow['id']; ?>"><?php echo $selSubRow['name']; ?></option>
                    <?php }
                }
                else
                { ?>
                    <option value="0">No Subject Found</option>
                <?php }
                ?>
            </select>
          </div>

          <div class="form-group">
            <label>Question Limit to Display</label>
            <input type="number" name="ptQuestDipLimit" id="" class="form-control" placeholder="Input question limit to display">
          </div>

          <div class="form-group">
            <label>Practice Test Title</label>
            <input type="text" name="ptTitle" class="form-control" placeholder="Input Title" required="">
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="ptDesc" class="form-control" rows="4" placeholder="Input Description" required=""></textarea>
          </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                            <button type="submit" class="btn btn-info btn-block">Add Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>

<?php require_once 'footer.php'?>