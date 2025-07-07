<?php
 ob_start();
 include 'DBConnect.php';
 ?>
<?php
   session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
     $msg="";
 $counsellorID=$_SESSION['staff'];
 $grpID=$_GET['groupID'];
 $_SESSION['groupID']=$grpID;
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 if(isset($_POST['post']))
 {
     $comment=$_POST['comment'];
     if($comment!="")
     {
         //$client=$_SESSION['client'];
         $stmt= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
         $serial= mysqli_fetch_array($stmt);
         $sender=$serial['surname'];
//NOTE: Counsellor---> is a convention name for all clients and the '$serial['surname']'-->is counsellor's surname in the counsellor table
         $sql1= mysqli_query($mysqli, "select * from grp_messages");
         $total1= mysqli_fetch_array($sql1);
         $totalCount= mysqli_num_rows($sql1);
         $sn1=$totalCount+1;
         $date= date('Y-m-d');
         $time= date('h:i:a',time());
         $sql2= mysqli_query($mysqli, "insert into grp_messages values('$sn1','$sender','$comment','$time','$date','$grpID','$counsellorID')");
        }else{
         $msg="write message to post";
        }
 }
 ?>
<html>
   
<?php
        include 'header_counsellor.php';
 ?>
                    
                    </div><div class="sec" style="background-color: whitesmoke;">
                        <div class="counsel" style="background-color: #EEE;">
                            <div class="login" style=" color:black;">
                            
                        Current Counsellor<br>
                        <div class="loginUser" style=" height: auto;">
                          <?php echo $user['surname'].', '.$user['fName'];?>
                            <form method="POST">
                <?php
                 
                  if(isset($_POST['logout'])!="")
                {
                    $stmt= mysqli_query($mysqli, "update counsellors set status='offline' where staff_id='$counsellorID'");
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
                        <?php
                            $k=0;
                            $NotStmt= mysqli_query($mysqli, "select * from messages where counsellorID='$counsellorID' && status='unread' && sender='client'");
                           $count= mysqli_num_rows($NotStmt);
                           if($count>0)
                            { 
                               $message=mysqli_fetch_array($NotStmt);
                               $client=$message['clientID'];
                               $CounSsql= mysqli_query($mysqli, "select * from clients where matNo='$client'");
                               $sender= mysqli_fetch_array($CounSsql);
                               $k++;
                             // $msgID=$count['messageID'];
                          ?>
                            <div class="notification" style="height:auto; width:100%;">
                        <table border="0"><tr><th>
                         <?php echo "You have (<font color='red'>".$count."</font>) new message(s)"; ?>
                                </th></tr>
                            <tr><td align="right">
                       <?php echo "<a href='message.php?client=".$client."'align='right'><u>Read</u></a>";?>
                                </td></tr></table>
                        </div>  
                          <?php }?>
                        </div>
                            </div>
                           
<?php
        include 'contactUs.php';
        include 'about.php';
 ?>
                    
                        <div class="sec2"><hr>
                            <?php $grpSQL= mysqli_query($mysqli, "select * from groups where groupID='$grpID'");
                            $grpReslt=mysqli_fetch_array($grpSQL);
                            $crtedby=$grpReslt['authourID'];
                            $aut=mysqli_query($mysqli, "select * from counsellors where staff_id='$crtedby'");
                            $author= mysqli_fetch_array($aut); 
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group Name:<font color="red"> <?php echo $grpReslt['name'];?></font> 
<!--                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group ID:<font color="red"> <?php //echo $grpID;?></font>-->
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created by: <font color="red"> <?php echo $author['surname'].", ".$author['fName']." ".$author['mName'];?></font>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="groupMembers.php?grpID=<?php echo $grpID;?>" style=" color:white; width:auto; padding: 5px;background-color: brown; color: white; border-radius: .5em">Members</a> 
                            <hr>
                            <iframe src="counsellorGrpM.php" style="height: 75%; width: 98%; border:none;"></iframe>
                            <form method="POST">
                                <textarea id="post" rows="2" cols="60" style="border:2px solid lightblue;" name="comment" placeholder="<?php echo $msg ?>"></textarea><input type="submit" name="post" value="Post" style=" color:white; width:auto; padding: 5px;  background-color: brown;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="counsellorHome.php" style=" color:white; width:auto; padding: 5px; color: red;">Exit Group</a>
                           </form>
                        </div>
                        </div>
              </div>
<!--        </div>-->
    </body>
</html>
<?php
 //$_SESSION['client']=$client;
 } else {
     header('Location:home.php');
 }
 ?>