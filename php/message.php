<?php 
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
 $msg="";
 $msg1="";
 $Pmsg="";
 $clientID=$_GET['client'];

 $_SESSION['ccounselClient']=$clientID;
 $msgID=isset($_GET['msgID'])? $_GET['msgID']:null;
 $counsellorID=$_SESSION['staff'];
 //$msgID="";
 $sender="counsellor";
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 $sql= mysqli_query($mysqli, "update messages SET status='read' WHERE messageID='$msgID'");
 if(isset($_POST['send'])!="")
 {
  $mess=$_POST['mess'];
  date_default_timezone_set('Africa/Lagos');
$date= date('Y-m-d');
 $time= date('h:i:a',time());
  if($mess!="")
  {
      $sql= mysqli_query($mysqli, "select * from messages");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         $msgID="MSG/".$sn;
         $status="unread";
         $stmt= mysqli_query($mysqli, "insert into messages values('$sn','$clientID','$counsellorID','$mess','$msgID','$date','$time','$sender','$status')");
         if($stmt)
         {

         } else{
             $msg="sorry, message failed due to ". mysqli_error($mysqli);
         }
           } else {
      $msg="write your message here ";
  }
 }
 ?>
<html>
   <?php include 'header_counsellor.php';?>
            <div class="sec" style="background-color: white;">
                <div class="counsel">
                    <div class="login" style=" color:black;">
<!--                  current user-->
                        Current Counsellor<br>
                        <div class="loginUser">
                          <?php echo $user['surname'].', '.$user['fName'];?>
                            <form method="POST">
                <?php
                 
                  if(isset($_POST['logout'])!="")
                { $stmt= mysqli_query($mysqli, "update counsellors set status='offline' where staff_id='$counsellorID'");
                    unset($_SESSION['staff']);
                    unset($_SESSION['role']);
                    session_destroy();
                    header("Location:home.php");
                }
                ?>
                                <br>
                                <center><input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="logout" Value="LOGOUT"></center>
                            </form>
                        </div>
                        <br>
                        <form method="POST" style="border: 1px dashed black; width:60%;border-radius: 2em 2em 0em 0em; padding:10px; ">
                            STATUS:
                        <?php
                         $statSQL= mysqli_query($mysqli, "select status from counsellors where staff_id='$counsellorID'");
                         $status=mysqli_fetch_array($statSQL);
                         echo "<font color='red'>".$status['status']."</font>";
                         ?><br>
                            <?php 
                             if(isset($_POST['ok'])!="")
                             {
                              $stat=$_POST['stat'];
                              if($stat!="...select...")
                              {
                              $stmt= mysqli_query($mysqli, "update counsellors set status='$stat' where staff_id='$counsellorID'"); 
                             }else{}}
                             ?>
                           Change: <select name="stat">
                                <option>...select...</option>
                                <option>online</option>
                                <option>busy</option>
                                <option>away</option>
                           </select>
                          <br><center> <input type="submit" name="ok" value="Change" style="color:white; width:auto; padding: 5px; background-color: brown;"></center>
                        </form>
                    </div>
                   
<?php
        include 'contactUs.php';
        include 'about.php';
 ?>
                    
                </div>
                <div style="height:98%;" class="sec2">
                    <table style="height:2%; width: 90%;" border="0">
                            <tr>
                                <th >
                                    <?php $witSQL= mysqli_query($mysqli, "select surname, fName from clients where matNo='$clientID'");
                                    $wit=mysqli_fetch_array($witSQL);?>
                                    <h3>Individual Counselling Session with <?php echo"<font color='red'>".$wit['surname']." ".$wit['fName']."</font>" ;?></h3>
                                </th>
                            </tr>
                        </table>
                             <?php
      $stmt= mysqli_query($mysqli, "select * from messages where clientID='$clientID' && counsellorID='$counsellorID'");
      $message= mysqli_fetch_array($stmt);
      $count=mysqli_num_rows($stmt);
      if($count<1)
      { }else{
           ?>
           <iframe src="text.php" style="height:70%; width: 99%;" frameborder="0" scrolling="yes"></iframe>
          <?php 
               }
                ?>
<!--           new message form-->
           <form method="POST" name="newMes">
           <table border="0" style="height:auto; ">
                            <tr>
                                <td align="right">
                                    <textarea  id="post" name="mess" rows="3" cols="50" style="border:2px solid lightblue; border-radius: .6em; " placeholder="<?php echo $msg ?>"></textarea> <input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="send" value="Send" > 
                                </td>
                            </tr>
                            </table>
            </form>
                </div>
             </div>
        </div>
<!--        footer-->
       <?php include 'footer.php';?>
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }
