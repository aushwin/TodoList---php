<?php

function dbConnect()
{
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'todo_list';

    $conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed");
    return $conn;
}

$conn = dbConnect();


function emailIsValid($email)
{
    //TODO: Proper Validation required
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) return true;
    else return false;
}

function checkLoginDetails($email, $password)
{

    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) return true;
    else return false;
}

function createUser($email, $password)
{
    $conn = dbConnect();
    $sql = "INSERT INTO users (email,password) VALUES ('$email','$password')";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function getHead()
{
    $output = '<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script async defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>TodoList</title>';

    echo $output;
}

function  getHeader()
{
    $output = '<header class="bg-white py-3 mb-4 border-bottom">
    <div class="d-flex flex-wrap justify-content-center container">
        <a href="todos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <span class="fs-4">Todo List</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="todos.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="add-todo.php" class="nav-link ">Add Todo</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link bg-danger text-white">Logout</a></li>
        
        </ul>
    </div>
</header>';

    echo $output;
}


function getTodo($todo){
    $output = ' <div class="card shadow-sm m-1">

    <div class="card-body">
    <h4 class="card-title">'. textLimit($todo['title'],25)  .'</h4>
        <p class="card-text">'.  textLimit($todo['description'],75) .'</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="view-todo.php?id='.$todo['id'].'" class="btn btn-sm btn-outline-secondary">View</a>
                <a href ="edit-todo.php?id='.$todo['id'].'" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
            <small class="text-muted">'.  $todo['date'] .'</small>
        </div>
    </div>
</div>';
    echo $output;
}

function textLimit($string, $limit){

   if(strlen($string) > $limit){
       return substr($string,0,$limit) . "...";
   }else {
       return $string;
   }
}


