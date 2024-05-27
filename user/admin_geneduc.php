<?php require_once 'admin_header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h3 style="display: inline-block; margin-right: 25px;">General Education</h3>
            </header>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Pdf</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../vendor/autoload.php';
                            require_once '../config.php';
                            $sql = "SELECT * FROM `gen_tbl` ORDER BY 1 DESC";
                            $result = mysqli_query($conn, $sql);
                            $id = 0;
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope='row'><?= ++$id ?></th>
                                    <td><img src="sub_images/<?php echo $row['image'] ?>" width="100px" alt=""></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><a href="pdfs/<?php echo $row['pdf'] ?>"><?php echo $row['pdf'] ?></a></td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#id<?= $row['id'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="delete.php?id=<?= $row['id'] ?>&managegen" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
require_once '../config.php';
$sql = "SELECT * FROM `gen_tbl` ORDER BY 1 DESC";
$result1 = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result1)) { ?>
    <!-- EDIT CATEGORY Modal -->
    <div class="modal fade" id="id<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="right: 0px; bottom: 0px; margin-top:80px; display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update General</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update_gen.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image"><b>Image</b></label>
                            <input type="file" class="form-control" value="<?= $row['image'] ?>" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="name"><b>Name</b></label>
                            <input type="text" class="form-control" value="<?= $row['name'] ?>" name="name" placeholder="File Name" required>
                        </div>
                        <div class="form-group">
                            <label for="pdf"><b>Pdf</b></label>
                            <input type="file" class="form-control" value="<?= $row['pdf'] ?>" name="pdf" required>
                        </div>
                        <input type="hidden" value="<?= $row['id'] ?>" name="id">
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-block btn-success" name="update-gen">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php require_once 'footer.php'; ?>
