<?php
require_once 'header.php';
require_once '../config.php';

// Fetch data to display in cards
$dataQuery = "SELECT image, name, pdf FROM gen_tbl"; // Replace with your table and columns
$dataResult = $conn->query($dataQuery);

$data = [];
if ($dataResult && $dataResult->num_rows > 0) {
    while ($row = $dataResult->fetch_assoc()) {
        $data[] = $row;
    }
}
?>
        <div class="container-fluid mt-2">
            <div class="row">
                <?php foreach ($data as $item): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <img src="sub_images/<?= htmlspecialchars($item['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>" style="height: 200px; width: 100%; object-fit: fill;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                            <a href="pdfs/<?= htmlspecialchars($item['pdf']) ?>"><p class="card-text"><?= htmlspecialchars($item['pdf']) ?></p></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php require_once 'user_footer.php'; ?>
