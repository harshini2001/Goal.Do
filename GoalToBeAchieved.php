<?php

include 'header.php';
?>
<?php

session_start();
$u_id=$_SESSION['id'];

function isGoalavaible()
  {
    $u_id=$_SESSION['id'];
    require_once "DB.php";
    $Query=$pdo->prepare("select count(g_id) as no from goalhistory where u_id=$u_id and isCompleted=0");
    $Query->execute();
    $stmt=$Query->fetch();
    return $stmt["no"];
  }
 
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

.menu li:hover {
  background-color: #d24dff;
}
</style>

</head>
<body>
<h3 style="padding:5px"><b>Goal To Be Achieved</b></h3>

<?php if(isGoalavaible()!=0){?>
<div class="menu">
<?php 
   require "DB.php";
  
   $Query=$pdo->prepare("select * from goalhistory where u_id=$u_id and isCompleted=0");
    $Query->execute();
    $data=$Query->fetchAll();
    foreach($data as $d){?>
    <form method="POST">
    <ul style="font-size:19px">
      <li><b>Goal : </b><?php echo $d["g_name"];?>&emsp;
          <b>Status:</b><?php if($d["isCompleted"]==1) echo "Achieved"; else echo "Not achieved";  ?>&emsp;
          <b>Category:</b><?php echo $d["g_category"]; ?><br>
          <b>Goal Description:</b><?php echo $d["g_desc"];?>
          <input type="submit" style="float:right" value="Completed??" name="button">
      </li>
    </ul>
    </form>
    <?php 
     if(isset($_POST['button']))
     {
         $Query1=$pdo->prepare("update goalhistory set isCompleted=1 where u_id=$u_id;");
         $Query1->execute();
         header('location:home.php');
     }
     ?>
    <?php } ?></div><?php }else{     ?>
    <h3 style="text-align:center"><b>No Goals..</b></h3>
    <?php } ?>
    </html>

