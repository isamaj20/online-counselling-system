
<?php 
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
$msg="";
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
   <?php     include 'header_counsellor.php';?>
            <div class="sec"  style=" height: auto;">
                <div class="counsel"  style=" height:100%; ">
                    <div class="login" style="height: auto;color:black;">
                   
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
                                  COUNSELLOR'S FOLLOW UP CLIENTS
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
      $stmt= mysqli_query($mysqli, "select * from follow_up where counsellorID='$counsellorID'");
      $k=0;
	  $cnt=mysqli_num_rows($stmt);
	  if($cnt>0)
	  {
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
                            <tr >
                                <td colspan="5" style="border-bottom: 1px dashed  #000;">
                                 TERMINATION DATE :<?php echo"  <font color='red'>". $message['Termination_Date']."</font>";?>   
                                </td>
                                 <th style="border-bottom: 1px dashed  #000;">
        <?php echo "<a href='del_Follow_up.php?clientID=".$client."'style=' text-decoration: none; border: 1px solid #663300; background-color: brown;color:  white; border-radius:0.3em 0.3em 0.3em 0.3em;'>Remove</a>";?>                            
                                </th>
                            </tr>
                        <?php }
	  }else{$msg="No client available for follow up";}						?>
                   </table>
				   <?php echo "<font color='red'>".$msg."</font>"; ?>
                </div>
             </div>
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }



