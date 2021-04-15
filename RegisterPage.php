<?php
require_once "DB.php";

try{
if(isset($_POST["name"]) && isset($_POST["mail"]) && isset($_POST["psw"]) && isset($_POST["psw1"]))
{
  $name=$_POST["name"];
  $mail=$_POST["mail"];
  $password=$_POST["psw"];
  $profe=$_POST["prof"];
  if($password!=$_POST["psw1"])
  {
    echo "<script> alert('Please make sure the confirm password is the same as the password')</script>";

  }
  else{
  $Query=$pdo->prepare("select max(u_id) as u_id from user");
  $Query->execute();
  $last_id=$Query->fetch();
  $id=$last_id["u_id"]+1;
  $Query="INSERT INTO user VALUES(:id,:name,:mail,:pwd,:prof)";
  $stmt=$pdo->prepare($Query);
  //This is to avoid sql injection
  $stmt->execute(array(
    ':id' => $last_id["u_id"]+1,
    ':name'=> $_POST["name"],
    ':mail'=>$_POST["mail"],
    ':pwd'=>$_POST["psw"],
    ':prof'=>$_POST["prof"] ));
 // $Query="insert into user values($id,'$name','$mail','$password','$profe');";
  //$pdo->exec($Query);
   // redirect();
   header('location:home.php');
  }
}
}
catch(Exception $ex)
{
  echo $ex;
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
  <img src="Images/Goal.Do.png" width="15%" height="10%">
    <h1>Register</h1>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter your name" name="name" required>

    <label for="mail"><b>Email</b></label>
    <input type="email" placeholder="Enter your mail id" name="mail" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your password" name="psw" required>
    <label for="psw1"><b>Confirm password</b><label>
    <input type="password" placeholder="Enter your password" name="psw1" required>
    <label for="prof"><b>Profession</b></label>
    <input type="text" placeholder="Enter your profession" name="prof" required>

    <button type="submit" class="btn">Register</button><br>

    <label>Already registered??? <a href="LoginPage.php">Click here</a></label>
  </form>
</div>

</body>
</html>



