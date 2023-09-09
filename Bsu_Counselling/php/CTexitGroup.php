<?php
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
  session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
      $clientID=$_SESSION['client'];
    $groupID=$_GET['groupID'];
 //
 $sql1=mysqli_query($mysqli, "delete from group_members where groupID='$groupID' && ID='$clientID'");
 if($sql1){
     $sql= mysqli_query($mysqli, "select * from groups where groupID='$groupID'");
     $result=mysqli_fetch_array($sql);
     $members=$result['member'];
     $mem=$members-1;
     $update= mysqli_query($mysqli, "update groups SET member='$mem' where groupID='$groupID'");
     header('Location:clientHome.php');
 }
} else {
     header('Location:clientHome.php');
 }