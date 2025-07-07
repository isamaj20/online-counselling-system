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
 $clientID="";//$_SESSION['client'];
 $counsellorID=$_SESSION['staff'];
// $msgID="";
// $sender="Counsellor";
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 ?>
<html>
    <?php include 'header_counsellor.php';?>
            <div class="sec"  style=" height: auto;">
                <div class="counsel"  style=" height:100%; background-color: #333;">
                    <div class="login" style="height: auto;">
                   
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
                <div  style=" height: auto;" class="sec2">
                    
                    <table style="height:auto; width: 100%; text-shadow: none; font-size: 20px;" border="0" cellpadding='5' cellspacing='5'>
                            <tr>
                                <th colspan="6" style="border-bottom: 1px dashed  #000; background-color: #CCC;">
                                  COUNSELLOR'S CLIENTS
                                </th>
                            </tr>
                            <tr style="border-bottom: 1px dashed  #000;background-color: #CCC;">
                                <th>
                                    SN
                                </th>
                                <th>
                                   Full Name
                                </th>
                                <th colspan="2">
                                   Department
                                </th>
                                <th>
                                    Sex
                                </th>
                                <th>
                                    Phone Number
                                </th>
                            </tr>
<?php
      $stmt= mysqli_query($mysqli, "select * from counsel_session where counsellorID='$counsellorID'");
      $k=0;
      $count=mysqli_num_rows($stmt);
      if($count>0){
      while($message= mysqli_fetch_array($stmt))
      { 
          $client=$message['clientID'];
          $sql= mysqli_query($mysqli, "select * from clients where matNo='$client'");
          $sender= mysqli_fetch_array($sql);
          $k++;
          //$msgID=$message['messageID'];
?>
                            <tr>
                                <td>
                                   <?php echo $k; ?>  
                                </td>
                                <td>
                                   <?php echo $sender['surname'].", ".$sender['fName']." ".$sender['mName']; ?> 
                                </td>
                                <td colspan="2">
                                    <?php echo $sender['dept'];?>
                                </td>
                                <td>
                                    <?php echo $sender['sex'];?>
                                </td>
                                <td>
                                    <?php echo "0".$sender['phoneNo'];?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                 TERMINATION REQUEST :<?php echo"  <font color='red'>". $message['request']."</font>";?>   
                                </td>
                                <td colspan="2">
                                CLIENT STATUS: <?php echo"<font color='red'>".$sender['status']."</font>";
                                if($sender['status']=="offline")
                                    { ?>
                                </td>
                                <td>
                               <?php
                                    echo "Since: <font color='red'>".$sender['logoutTime']."</font>";
                                }else{}
                                ?>
                                </td>
                            </tr>
                            <tr >
                                <th colspan="2" style="border-bottom: 1px dashed  #000;">
        <?php echo "<a href='message.php?client=".$client."'  style='float:left; text-decoration: none;float:right; border: 1px solid #663300; background-color:green;color:  white; border-radius:0.3em 0.3em 0.3em 0.3em;'>Continue Session</a>";?>   
                                </th> 
                                <th colspan="3" style="border-bottom: 1px dashed  #000;">
        <?php echo "<a href='counsellorTerminate.php?clientID=".$client."'style='float:right; text-decoration: none; border: 1px solid #663300; background-color: brown;color:  white; border-radius:0.3em 0.3em 0.3em 0.3em;'>Terminate Session</a>";?>                            
                                </th>
                                <td style="border-bottom: 1px dashed  #000;"></td>
                            </tr>
      <?php }}else{echo "<tr><td><font color='red'>No active client</font></tr></td>";} ?>
                   </table>
                </div>
             </div>
        </div>
<!--         <div class="foot">
            <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy;copyright 2016. BSU Student Counselling System by Isama John Adeyi, Mathematics/Computer Sci Dept</center>
         </div>-->
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }

