<?php 
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
 $msg="";
 $msg1="";
  $clientID=$_SESSION['client'];
 $sender="client";
 $userSql= mysqli_query($mysqli, "select * from clients where matNo='$clientID'");
 $user= mysqli_fetch_array($userSql);
 $_SESSION['log']=$user['logoutRef'];
 ?>
<html lang="en">
   <?php     include 'header_client.php';?>
            <div class="sec" >
<!--                contains user details like login, name, status etc-->
                <div class="counsel">
                    <div class="login">
                       
                        Current Client<br>
                        <div  style="border:#000 1px dashed; height:auto; color:  red; width:60%; font-size: 25px; padding: 10px; border-radius: 2em 0em 2em 0em;">
                          <?php echo $user['surname'].', '.$user['fName'];?>
                            <form method="POST">
                <?php
                 
                  if(isset($_POST['logout'])!="")
                {
                      $logout="";
                       $time=date('a',time());
                       $logoutTime=date('Y-m-d:').date('h:i:a',time());
                       //differentiating between AM and PM
     if($time=="am")
     {
         $date=date('ymd').date('his',time());
         $newdate=$date."1";
         $logout=$newdate;
     }else{
        $date=date('ymd').date('his',time());
         $newdate=$date."2"; 
          $logout=$newdate;
     }
                    $stmt= mysqli_query($mysqli, "update clients set status='offline', logoutRef='$logout', logoutTime='$logoutTime' where matNo='$clientID'");
                    unset($_SESSION['client']);
                    unset($_SESSION['role']);
                    session_destroy();
                    header("Location:home.php");
                }
                ?>
                                <br>
                                <center><input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="logout" Value="LOGOUT"></center>
                            </form>
                        </div>
                        <br><br><a href="user.php" style=" color:white;">Change Username/Password</a>
                    </div>
<!--  contact container-->
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                </div>
<!--contains notifications and every other things in this page apart from user details and page header-->
                <div style="height:99.9%; text-shadow:none;" class="sec2">
<!--                    <br>-->
<!--                    <form method="POST" name="newMes">-->
                        <table style="height:2%; width: 100%;" border="0">
                            <tr>
                                <th >
                                  NOTIFICATIONS
                                </th>
                            </tr>
                        </table>
<hr>
<?php
 $sessionSQL= mysqli_query($mysqli, "select * from counsel_session where clientID='$clientID'");
 $sess=mysqli_fetch_array($sessionSQL);
 $sesscount=mysqli_num_rows($sessionSQL);
 if($sesscount>0)
 {
  $counsellorID=$sess['counsellorID']; 
  $stmt= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'"); 
  $counsellor=mysqli_fetch_array($stmt);
 ?>
<!--client session notification table-->
<table border="0" style="width: 90%; height: auto; font-size: 20px; text-shadow:none;">
    <tr>
        <th colspan="2">
            <?php echo "You have an active session with: <font color='red'>".$counsellor['surname']." ".$counsellor['fName']."</font>";?>
        </th>
    </tr>
    <tr>
        <th>
            Termination Request:<?php echo "<font color='red' > ".$sess['request']."</font>";?>
        </th>
        <th>
        STATUS:  <?php echo "<font color='red' > ".$counsellor['status']."</font>";?>    
        </th>
    </tr>
    <tr>
        <td style="padding-right: 10px;">
          <?php echo "<a href='ClientMessage.php?counsellorID=".$counsellorID."'  style='text-decoration: none;float:right; border: 1px solid #663300; background-color:green;color:  white; border-radius:0em 0.5em 0em 0em;'>Continue Session</a>";?>   
        </td>
        <td style="padding-left: 10px;">
         <?php echo "<a href='ClientTerminate.php?counsellorID=".$counsellorID."'align='right'  style='text-decoration: none; border: 1px solid #663300; background-color: brown;color:  white; border-radius: 0.5em 0em 0em 0em;'>Terminate Session</a>";?>      
        </td>
    </tr>
</table>
 <?php  
 }else
     {
     echo"<font color='red'>no active session </font>";
     }
     ?>
<hr>
<!--message notification section-->
<div style=" height:20%;">
<div class="notify" style="height: auto;">
                             <?php
      $stmt= mysqli_query($mysqli, "select * from messages where clientID='$clientID' && status='unread' && sender='counsellor'");
      $count= mysqli_num_rows ($stmt);
      $k=0;
      if($count<1)
      {
          echo 'No new message|<a href="clientHome.php" style="color: red">Refresh</a>';
      }else{
      $message= mysqli_fetch_array($stmt); 
          $counsellor=$message['counsellorID'];
          $sql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellor'");
          $sender= mysqli_fetch_array($sql);
          $k++;
          $msgID=$message['messageID'];
?>
                    <div class="notification" style="height: auto; width: 100%;">
                        <table border="0" style="width: 100%;"><tr><td><?php echo "Notice:"; ?></td><th>
                         <?php echo  "<font color='red'>(".$count.") </font>New message(s) from: <font color='red'>".$sender['surname']." ".$sender['fName']."</font></u>"; ?>
                                </th></tr>
                            <tr><td align="right" colspan="2">
                       <?php echo "<a href='ClientMessage.php?counsellorID=".$counsellor."&msgID=".$msgID."'align='right'><u>Read</u></a>";?>
                                </td></tr></table>
                    </div>
      <?php }?>
</div>
<!--goTo section of this page, contains links for redirecting to view counsellors, and group-->
<div class="client_actions">
    GOTO...<br>
    <a href="CTviewGroup.php?clientID=<?php echo $clientID; ?>">View Groups</a><br>
    <a href="Vcounsellors.php">Select Counsellor</a>
</div>
</div>
<hr>
<?php 
     $log=$user['logoutRef'];
     $newSql= mysqli_query($mysqli,"select * from news_feeds where nFeedID>='$log'");
     $num=mysqli_num_rows($newSql);
     ?>
 
<table style=" width: 100%;" border="0">
    <tr><th>News Feeds </th></tr>
</table>
<?php 
     if($num>0)
     { ?>
    <iframe style=" height:34%; width: 99.9%; border:none;" src="post.php" scrolling="yes">  </iframe> 
     <?php }else{
         echo "<font color='red'>no news update</font>";
     }
?>
  </div>
        </div>
        </div>
         <?php include 'footer.php';?>
    </body>
</html>
<?php
 
 $_SESSION['client']=$clientID;
      } else {
     header('Location:home.php');
 }