<?php require_once 'admin_header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h3 style="display: inline-block; margin-right: 25px;">Flash Card</h3>
            </header>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Meaning</th>
                                <th>Answer</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../vendor/autoload.php';
                            require_once '../config.php';
                            $sql = "SELECT * FROM `fc_tbl` ORDER BY 1 DESC";
                            $result = mysqli_query($conn, $sql);
                            $id = 0;
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope='row'><?= ++$id ?></th>
                                    <td><?= $row['question'] ?></td>
                                    <td><?= $row['answer'] ?></td>
                                    <td class="text-center">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalForUpdateFc<?= $row['fc_id'] ?>">Update</button>
                                    <button type="button" class="btn btn-danger btn-sm deleteFlashcard" data-id="<?= $row['fc_id']; ?>">Delete</button>
                                    </td>
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


<?php require_once 'footer.php'; ?>
<?php include("update_fc_modal.php"); ?>
