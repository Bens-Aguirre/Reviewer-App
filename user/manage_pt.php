<?php require_once 'admin_header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h3 style="display: inline-block; margin-right: 25px;">Practice Test List</h3>
            </header>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left pl-4">Practice Test Title</th>
                                <th class="text-left">Subject</th>
                                <th class="text-left">Description</th>
                                <th class="text-left">Display limit</th>
                                <th class="text-center" width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                require_once '../config.php';
                                $selPt = $conn->query("SELECT * FROM pt_tbl ORDER BY pt_id DESC ");
                                if($selPt->num_rows > 0)
                                {
                                    while ($selPtRow = $selPt->fetch_assoc()) { ?>
                                        <tr>
                                            <td class="pl-4"><?php echo $selPtRow['pt_title']; ?></td>
                                            <td>
                                                <?php 
                                                    $subId =  $selPtRow['id']; 
                                                    $selSub = $conn->query("SELECT * FROM gen_tbl WHERE id='$subId' ");
                                                    while ($selSubRow = $selSub->fetch_assoc()) {
                                                        echo $selSubRow['name'];
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $selPtRow['pt_desc']; ?></td>
                                            <td><?php echo $selPtRow['pt_questlimit_display']; ?></td>
                                            <td class="text-center">
                                             <a href="edit_pt.php?id=<?php echo $selPtRow['pt_id']; ?>" type="button" class="btn btn-primary btn-sm">Manage</a>
                                             <button type="button" id="deleteExam" data-id='<?php echo $selPtRow['pt_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Practice Test Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?php require_once 'footer.php'; ?>
