<?php
include 'includes/config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

$msg = "";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHead(); ?>
</head>

<body class="bg-light">
    <?php getHeader(); ?>
    <div class="container">
        <h1 class="mb-4 text-center fw-bold">Your Todos</h1>
        <div class="row">
        <?php
               $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
               if ($count > 0) {
                   $row = mysqli_fetch_assoc($res);
                   $user_id = $row['id'];
               }
               $sql1 = "SELECT * FROM todos WHERE user_id='{$user_id}' ORDER BY id DESC";
               $res1 = mysqli_query($conn,$sql1);
               if(mysqli_num_rows($res1) > 0) {
                   foreach ($res1 as $todo){
                       getTodo($todo);
                   }
               }else {
                   echo "<div class='alert alert-danger'>Todos are empty</div>";
               }
               ?>
            <div class="col-lg-3 col-md-6">
             
            </div>
        </div>
    </div>
</body>

</html>