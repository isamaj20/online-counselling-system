<?php
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
 $groupID=$_GET['grpID'];
 $sql= mysqli_query($mysqli, "delete from groups where groupID='$groupID'");
 $sql1=mysqli_query($mysqli, "delete from group_members where groupID='$groupID'");
 $sql2=mysqli_query($mysqli, "delete from grp_messages where group_id='$groupID'");
 if($sql1 && $sql){
     header('Location:viewGroup.php');
 }
} else {
     header('Location:counsellorHome.php');
 }
