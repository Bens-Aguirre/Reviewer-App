<?php
require_once '../config.php';

if(isset($_GET['managegen'])){
    // Getting id of the data from URL
    $id = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM gen_tbl WHERE id = $id";

    // Execute the delete statement
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Record deleted successfully.');</script>";
        echo "<script>window.location.href = 'admin_geneduc.php';</script>";
    } else {
        // Error executing the delete statement
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

// Close the database connection
mysqli_close($conn);

}
?>