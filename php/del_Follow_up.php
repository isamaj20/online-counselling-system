<?php
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
  session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
      $counsellorID=$_SESSION['staff'];
 $clientID=$_GET['clientID'];
 $sql= mysqli_query($mysqli, "delete from follow_up where counsellorID='$counsellorID' && clientID='$clientID'");
 //$sql1=mysqli_query($mysqli, "delete from group_members where groupID='$groupID'");
 if($sql){
     header('Location:view_follow_up.php');
 }
} else {
     header('Location:counsellorHome.php');
 }