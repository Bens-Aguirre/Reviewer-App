<?php require_once 'header.php' ?>
<?php require_once '../config.php'; ?>
<?php
$user_id = null; // Initialize user_id as null

if (isset($_SESSION["user_id"])) {
    $conn = require __DIR__ . "/../config.php";
    
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        $user_id = $user['user_id']; // Set user_id if user is found
    }
} else {
    $user = null;
}
?>
<?php
@$page = $_GET['page'];


   if($page != '')
   {
    if($page == "pt")
     {
       include("user_ptexam.php");
     }
     else if($page == "ptresult")
     {
       include("ptresult.php");
     }
     else if($page == "exam")
     {
       include("user_exam.php");
     }
     else if($page == "result")
     {
       include("result.php");
     }
     
   }
   // Else ang home nga page mo display
   else
   {
     include("home1.php"); 
   }
?>


<?php require_once 'user_footer.php'?>