<?php
include'DBConnect.php';
?>
<?php
// $clientID="";
// $counsellorID="";
 session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
     
     $counsellorID=$_GET['counsellorID']; 
     $clientID=$_SESSION['client'];
    
  $stmt= mysqli_query($mysqli, "select * from counsel_session where counsellorID='$counsellorID' && clientID='$clientID'");
  $result=mysqli_fetch_array($stmt);
  if($result['request']=="no request")
  {
      $req="sent by client";
      $sql= mysqli_query($mysqli, "update counsel_session set request='$req' where counsellorID='$counsellorID' && clientID='$clientID'");
      header('Location:clientHome.php');
  }else if($result['request']=="sent by counsellor")
      {
      $Dsql= mysqli_query($mysqli, "delete from counsel_session where counsellorID='$counsellorID' && clientID='$clientID'");
      if($Dsql)
      {
          $date=date('Y-m-d');
          $terminateSQL= mysqli_query($mysqli, "insert into follow_up values('$clientID','$counsellorID','$date')");
      }else{
        //do nothing  
      }
      header('Location:clientHome.php');
  }else{
     header('Location:clientHome.php'); 
  }
       } else {
           header('Location:clientHome.php');
 }
