<?php
include'DBConnect.php';

// $clientID="";
// $counsellorID="";
 session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
     
     $clientID=$_GET['clientID']; 
     $counsellorID=$_SESSION['staff'];   
  $stmt= mysqli_query($mysqli, "select * from counsel_session where counsellorID='$counsellorID' && clientID='$clientID'");
  $result=mysqli_fetch_array($stmt);
  if($result['request']=="no request")
  {
      $req="sent by counsellor";
      $sql= mysqli_query($mysqli, "update counsel_session set request='$req' where counsellorID='$counsellorID' && clientID='$clientID'");
      header('Location:counsellor_Clients.php');
  }else if($result['request']=="sent by client")
      {
      $Dsql= mysqli_query($mysqli, "delete from counsel_session where counsellorID='$counsellorID' && clientID='$clientID'");
      if($Dsql)
      {
          $date=date('Y-m-d');
          $terminateSQL= mysqli_query($mysqli, "insert into follow_up values('$clientID','$counsellorID','$date')");
      }else{
        //do nothing  
      }
      header('Location:counsellor_Clients.php');
  }else{
     header('Location:counsellor_Clients.php'); 
  }
       } else {
           header('Location:counsellorHome.php');
 }
