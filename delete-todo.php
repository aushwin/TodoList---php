<?php
include 'includes/config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

if (isset($_GET['id'])) {
    $todoId = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['id'];
    }
    $sql = "DELETE FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
    $res = mysqli_query($conn,$sql);
    header("Location: todos.php");
} else {
    header("Location: todos.php");

}

