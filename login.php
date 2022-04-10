 <?php

 include "includes/config.php";
 session_start();
 $msg = "";
  
  

 if(isset($_POST['submit'])){
   
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  
    //Check whether email exists
    if(emailIsValid($email)){ 
        //If Email -> checks login credentials 
        if(checkLoginDetails($email,$password)) {
            $_SESSION["user_email"] = $email;
            header("Location: todos.php");
            die();
        }else {
           echo "<script>
           alert('Login details is invalid');
           window.location.replace('index.php');
           </script>";
        
        }
    }else{
        //If !Email -> Creates a new user 
        $users_registration = createUser($email,$password);
        if($users_registration) {
            $_SESSION['user_email'] = $email;
            echo 'User registrtion succesfull';
            header("Location: todos.php");
            die();
        }
        else {
            echo "User registration failed. Please try again later";
            die("user registration failed");
        }
    }
 }else{
     header("Location: index.php");
     die();
 }

 
 ?>