<?php require_once 'header.php'; ?>
<?php require_once '../config.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <h3 style="display: inline-block; margin-right: 25px;">Flashcards</h3>
            </header>
            <div class="card-body">
                <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subjects</th>
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
                            if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td class = 'text-center'><a href='user_fc.php?id=" . $row['id'] . "' class='btn btn-primary'>View</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No subjects found</td></tr>";
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

            <div id="flashcards-container" style="display: none;">
                <h3>Flashcards</h3>
                <div id="flashcards-content"></div>
            </div>

            <?php require_once 'user_footer.php'; ?>