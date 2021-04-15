<?php

include 'header.php';
session_start();
$u_id=$_SESSION['id'];
?>
<html>
<head>
<style>
.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 30px;
}

.menu li {
  padding: 20px;
  margin-bottom: 7px;
  background-color:#ecb3ff;
  color: #660066;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

</style>

</head>
<body>
<h3 style="padding:5px"><b>Profile</b></h3>
<div class="menu">
<?php 
   require_once "DB.php";
   $Query=$pdo->prepare("select u_name,mail_id,u_profession, count(isCompleted) as count from user natural join goalhistory where u_id=$u_id and isCompleted=1;");
    $Query->execute();
    $data=$Query->fetchAll(); 
    foreach($data as $d){
?>
    <form method="POST">    
    <ul style="font-size:19px">
      <li><b>User Name         : </b><?php echo $d['u_name'];?><br><br>
          <b>Mail ID             : </b><?php  echo $d["mail_id"];  ?><br><br>
          <b>Profession          : </b><?php echo $d["u_profession"]; ?><br><br>
          <b>No of goal completed   :</b><?php echo $d["count"];?><br>
          <input type="submit" style="float:right" value="EDIT PROFILE" name="button">
      </li>
    </ul>
    </form>
   <?php } ?>
   <?php
    if(isset($_POST["button"]))
    {
        $visible=1;
    }
    else
    $visible=0;
?>
<?php
if(isset($_POST["button2"]))
{
    echo "hi";
    $name=$_POST["name"];
    $mail=$_POST["mail"];
    $prof=$_POST["prof"];
    $Query="UPDATE user set u_name=:name , mail_id=:mail , u_profession=:prof where u_id=$u_id";
    $stmt=$pdo->prepare($Query);
  //This is to avoid sql injection
  $stmt->execute(array(
    ':name'=> $_POST["name"],
    ':mail'=>$_POST["mail"],
    ':prof'=>$_POST["prof"] ));
    header('location:profile.php');
}

if($visible==1){
    foreach($data as $d){
      $name=$d["u_name"];
    ?>
  <form method="POST" style="font-size:19px">
    <h3 style="padding:5px"><b>EDIT</b></h3>
    <ul>
    <li><label for="name"><b>Name  :  </b></label>
    <input type="text" value='<?php echo $d["u_name"]; ?>'' name="name" required><br><br>
    <label for="mail" ><b>Email  :  </b></label>
    <input type="email" size="25" value='<?php echo $d["mail_id"]; ?>' name="mail" required><br><br>
    <label for="prof"><b>Profession : </b></label> 
    <input type="text" size="25" value='<?php echo $d["u_profession"]; ?>' name="prof" required><br><br>
    <input type="submit" style="float:right" value="SAVE PROFILE" name="button2"></li>
    </ul>
  </form>
<?php  }

} ?>
</div>

</body>
</html>