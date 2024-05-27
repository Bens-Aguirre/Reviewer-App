<?php require_once 'admin_header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h3 style="display: inline-block; margin-right: 25px;">Users</h3>
            </header>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../vendor/autoload.php';
                            require_once '../config.php';
                            $sql = "SELECT * FROM `users` ORDER BY 1 DESC";
                            $result = mysqli_query($conn, $sql);
                            $id = 0;
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope='row'><?= ++$id ?></th>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td class="text-center">
                                        <a href="delete_users.php?id=<?= $row['user_id'] ?>&manageusers" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash-o"></i> Delete</a>
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