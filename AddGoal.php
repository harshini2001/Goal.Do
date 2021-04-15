<?php 
session_start();
$u_id=$_SESSION['id'];
?>
<?php
 
  
  function isGoalavaible()
  {
    $u_id=$_SESSION['id'];
    require_once "DB.php";
    $Query=$pdo->prepare("select count(g_id) as no from goalhistory where u_id=$u_id");
    $Query->execute();
    $stmt=$Query->fetch();
    if($stmt["no"]==0)
    return 0;
    else
    return $stmt["no"];
  }
  if(isset($_POST["button1"]))
  {
    require_once 'DB.php'; 
      $goalname=$_POST["goalname"];
      $sdate=$_POST["sdate"];
      $edate=$_POST["edate"];
      $cate=$_POST["category"];
      $desc=$_POST["desc"];
      echo $sdate;
      echo $edate;
      $Query=$pdo->prepare("select max(g_id) as g_id from goalhistory where u_id=$u_id");
      $Query->execute();
      $stmt=$Query->fetch();
      $g_id=$stmt["g_id"]+1;
      $Query=$pdo->prepare("insert into goalhistory values($g_id,'$goalname','$desc','$sdate','$edate',0,'$cate',$u_id)");
      $Query->execute();
      echo "<alert>Added succesfully</alert>";
      header('location:AddGoal.php');
  }
 
  
    

?>
<?php

include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size:18px;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}


.col-25 {
  float: left;
  width: 20%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 100%;
  margin-top: 6px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}


@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
   
}


.column {
  float: left;
  width: 50%;
  padding: 15px;
}


.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }
}


</style>
</head>
<body>
<div style="width:100%;padding-left:40px" >
<div class="row">
  <div class="column">
    <div class="row">
    <h2><b>Add goal</b></h2>
    <form method="POST">
    <div class="col-25">
      <label for="goalname">Goal</label>
    </div>
    <div class="col-75">
      <input type="text" id="goalname" name="goalname" placeholder="Your goal.." required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="sdate">Start date</label>
    </div>
    <div class="col-75">
      <input type="date" id="sdate" name="sdate" placeholder="Start date.." required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="edate">End date</label>
    </div>
    <div class="col-75">
      <input type="date" id="edate" name="edate" placeholder="End date.." required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="category">Category</label>
    </div>
    <div class="col-75">
      <select id="category" name="category" required>
        <option value="Personal">Personal</option>
        <option value="Professional">Professional</option>
        <option value="other">Others</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="desc">Goal Desciption..</label>
    </div>
    <div class="col-75">
      <textarea id="desc" name="desc" placeholder="Write something.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" name="button1" value="Submit">

  </div>
  </form>
  </div>
  <?php 
  
  if(isGoalavaible()!=0){?>
  <div class="column">
   <div class="col-3 menu">
   <?php 
   require "DB.php";
   $Query=$pdo->prepare("select * from goalhistory where u_id=$u_id");
    $Query->execute();
    $data=$Query->fetchAll();
    foreach($data as $d){?>
    <ul>
      <li><b>Goal : </b><?php echo $d["g_name"];?>&emsp;
          <b>Status:</b><?php if($d["isCompleted"]==1) echo "Achieved"; else echo "Not achieved";  ?>&emsp;
          <b>Category:</b><?php echo $d["g_category"]; ?><br>
          <b>Goal Description:</b><?php echo $d["g_desc"];?>
      </li>
    </ul>
    <?php }?>
  </div> 
   </div>
   <?php }?>
  
</div>
</div>
</body>
</html>


