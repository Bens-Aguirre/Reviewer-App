<?php
require_once '../config.php';

// Handle form submission
if(isset($_POST['gen-btn'])) {
    // File handling for image
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp,"sub_images/$image");

    // Get form data
    $name = $_POST['name'];
    
    // File handling for PDF
    $pdf = $_FILES['pdf']['name'];
    $pdf_tmp = $_FILES['pdf']['tmp_name'];
    move_uploaded_file($pdf_tmp,"pdfs/$pdf");
    
    // SQL to insert data into database
    $sql = "INSERT INTO gen_tbl (image, name, pdf) VALUES ('$image', '$name', '$pdf')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('New record created successfully');</script>";
        echo "<script>window.location.href = 'admin_addgen.php';</script>";
    exit();
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Close connection
$conn->close();
?>