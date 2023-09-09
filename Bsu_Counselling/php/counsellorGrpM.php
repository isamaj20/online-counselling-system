<?php
 include 'DBConnect.php';
 ?>
<?php
  session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
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
           $senderID=$message['senderID'];
           $senderSQL= mysqli_query($mysqli,"select * from clients where matNo='$senderID'");
           $sndr= mysqli_fetch_array($senderSQL);
           $num=mysqli_num_rows($senderSQL);
           if($num<1)
           {
           $senderSQL= mysqli_query($mysqli,"select * from counsellors where staff_id='$senderID'");
           $sndr= mysqli_fetch_array($senderSQL); 
            echo'<textarea name="CTmsg" rows="3" cols="70" style="color:white; border:none; border-radius: 0em 0em 2em 0em; background-color:#333;">Counsellor: '.$sndr['surname']." at ".$message['time'].":--->".$message['message'].'</textarea><br><br>';
           }else{
            echo'<textarea name="CTmsg" rows="3" cols="70" style="color:white; border:none; border-radius: 0em 0em 2em 0em; background-color:#333;">client: '.$sndr['surname']."|".$sndr['matNo']."| at ".$message['time']."|>".$message['message'].'</textarea><br><br>';
       }}
   ?>  

    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }
