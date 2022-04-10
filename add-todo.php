<?php 
include 'includes/config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

$msg = "";

$msg = "";

if (isset($_POST['addTodo'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);

    //get user id based on user email
    $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['id'];
    }

    $sql = null;

    //inserting todo

    $sql = "INSERT INTO todos (title,description,user_id) VALUES ('$title', '$desc', '$user_id')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>Todo is created. </div>";
    } else {
        $msg = "<div class='alert alert-success'>Todo is not created. </div>";
    }
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
                        <h4 class="card-title ">Add Todo</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php echo $msg; ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="e.g Do the dishes" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="desc" class="form-control" id="desc" rows="1" required></textarea>
                            </div>
                            <div>
                                <button type="submit" name="addTodo" class="btn btn-primary">Add Todo</button>
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