<?php
 include 'DBConnect.php';
 ?>
<?php
  session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
$groupID=$_SESSION['groupID'];
?>
<html>
    <head>
                     <meta http-equiv="refresh" content="5">
        <title>hh</title></head>
    <body>
       
        <?php
//      $stmt= mysqli_query($mysqli, "select * from messages");
//   while($message= mysqli_fetch_array($stmt))
//    {
      $stmt1= mysqli_query($mysqli, "select * from grp_messages where group_id='$groupID'");
       while($message= mysqli_fetch_array($stmt1))
       { 
            echo'<textarea name="CTmsg" rows="3" cols="70" style="color:white; border:none; border-radius: 0em 0em 2em 0em; background-color:#333;">'.$message['sender']." at ".$message['time'].":--->".$message['message'].'</textarea><br><br>';
       }
   ?>  

    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }
