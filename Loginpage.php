<?php
require_once "DB.php";

/* This function will check for valid details */
if(isset($_POST["mail"])&&isset($_POST["psw"]))
{
    $mail=$_POST["mail"];
    $pass=$_POST["psw"];
    $Query=$pdo->prepare("select u_id,count(u_id) from user where mail_id='$mail' and password='$pass'");
    $Query->execute();
    $stmt=$Query->fetch();
    $count=$stmt["count(u_id)"];
    if($count==1){
    $u_id=$stmt["u_id"];
    session_start();
    $_SESSION['id']=$u_id;
    echo '<script>alert("You have logged in successfully")</script>'; 
    header('location:home.php');  }
    else
    echo '<script>alert("please enter the correct login details")</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("Images/bgimage.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
input[type=text], input[type=password],input[type=email] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  }

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  
  position: relative;
  font-weight: bold;
  border: 3px solid #f1f1f1;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 50%;
  padding: 20px;
  text-align: center;
}
.btn {
  background-color: #cc99ff;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>

<div class="bg-image"></div>

<div class="bg-text">
  <form method="POST" class="container">
    <img src="Images/Goal.Do.png" width="20%" height="20%">
    <h1>Login!!!</h1>

    <label for="mail"><b>Email</b></label>
    <input type="text" placeholder="Enter your mail id" name="mail" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your password" name="psw" required>
    <button type="submit" class="btn">Login</button><br><br>
    <label>New user???<a href="RegisterPage.php">Click here</a></label>
  </form>
</div>

</body>
</html>