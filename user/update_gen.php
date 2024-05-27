<?php
require_once '../config.php';

// Handle form submission
if(isset($_POST['update-gen'])) {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];

    // File handling for image
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp, "sub_images/$image");

    // File handling for PDF
    $pdf = $_FILES['pdf']['name'];
    $pdf_tmp = $_FILES['pdf']['tmp_name'];
    move_uploaded_file($pdf_tmp, "pdfs/$pdf");

    // SQL to update data in the database
    $sql = "UPDATE gen_tbl SET image='$image', name='$name', pdf='$pdf' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'admin_geneduc.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Close connection
$conn->close();
?>