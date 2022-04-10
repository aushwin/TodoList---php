<?php 
include 'includes/config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

if(isset($_GET['id'])){
    $todoId = mysqli_real_escape_string($conn,$_GET['id']);
}else{
    header("Location: todos.php");
    die();
}

$msg = "";
$sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if ($count > 0) {
    $row = mysqli_fetch_assoc($res);
    $user_id = $row['id'];
} 


if (isset($_POST['updateTodo'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);

    

    //inserting todo

    $sql = "UPDATE todos SET title='{$title}' , description='{$desc}' ,date=CURRENT_TIMESTAMP WHERE id='$todoId'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>Todo is updated. </div>";
    } else {
        $msg = "<div class='alert alert-success'>Todo is not updated. </div>";
    }
}

$sql = "SELECT * FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){
    $todoData = mysqli_fetch_assoc($res);
}else {
    header("Location: todos.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php getHead(); ?>
</head>

<body class="bg-light">
    <?php getHeader(); ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card bg-white rounded border shadow">
                    <div class="card-header px-4 py-3">
                        <h4 class="card-title ">Edit Todo</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php echo $msg; ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input value="<?php echo $todoData['title']; ?>" name="title" type="text" class="form-control" id="title" placeholder="e.g Do the dishes" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea  name="desc" class="form-control" id="desc" rows="1" required><?php echo $todoData['description'];?></textarea>
                            </div>
                            <div>
                                <button type="submit" name="updateTodo" class="btn btn-primary">Update Todo</button>
                                <button type="reset" name="reset" class="btn btn-danger me-2">Reset</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>