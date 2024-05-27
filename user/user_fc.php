<?php require_once 'header.php'; ?>

<?php
require_once '../vendor/autoload.php';

if (!isset($_GET['id'])) {
    die('Subject ID is required.');
}

$subject_id = $_GET['id'];
$conn = require __DIR__ . "/../config.php";

$sql = "SELECT * FROM fc_tbl WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $subject_id);
$stmt->execute();
$result = $stmt->get_result();

$flashcards = []; // Initialize $flashcards as an empty array
while ($row = $result->fetch_assoc()) {
    $flashcards[] = $row;
}
$stmt->close();
?>

<h3>Flashcards</h3>
            <?php if (count($flashcards) > 0): ?>
                <?php foreach ($flashcards as $flashcard): ?>
                    <div class="flashcard">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($flashcard['answer']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($flashcard['question']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No flashcards found for this subject.</p>
            <?php endif; ?>

            <?php require_once 'user_footer.php'; ?>
