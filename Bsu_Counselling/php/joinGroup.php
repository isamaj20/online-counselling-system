<?php
 ob_start();
 include 'DBConnect.php';
 ?>
<?php
   session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
     $msg="";
 $mat=$_SESSION['client'];
 $grpID=$_GET['grpID'];
 $_SESSION['groupID']=$grpID;
         $sql= mysqli_query($mysqli, "select * from group_members");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         
         $sql1= mysqli_query($mysqli, "select * from group_members where ID='$mat' && groupID='$grpID'");
         //$total1= mysqli_fetch_array($sql);
         $totalCount1= mysqli_num_rows($sql1);
         if($totalCount1<1)//checking to avoid duplicate members' records
         {
         $clientSql= mysqli_query($mysqli, "select * from clients where matNo='$mat'");
         $result= mysqli_fetch_array($clientSql);
         $fname=$result['fName'];
         $mname=$result['mName'];
         $surname=$result['surname'];
         //$mat="";
         $dept=$result['dept'];
         $level=$result['level'];
         $sex=$result['sex'];
 $stmt= mysqli_query($mysqli,"insert into group_members values('$sn','$fname','$mname','$surname','$mat','$dept','$level','$sex','$grpID')");
 $stmt1= mysqli_query($mysqli,"select * from groups");
 $reslt= mysqli_fetch_array($stmt1);
 $members=$reslt['member'];
 $newMember=$members+1;
 $stmt2= mysqli_query($mysqli,"update groups SET member='$newMember' where groupID='$grpID'");
         }else{
           $msg="welcome, please write message and click >>post";  
         }
 if(isset($_POST['post']))
 {
     $comment=$_POST['comment'];
     if($comment!="")
     {
         $client=$_SESSION['client'];
         $stmt= mysqli_query($mysqli, "select * from clients where matNo='$client'");
         $serial= mysqli_fetch_array($stmt);
         $sender="CLIENT".$serial['S/N'];
//NOTE: CLIENT---> is a convention name for all clients and the Integer-->is client's number in the client table
         $sql1= mysqli_query($mysqli, "select * from grp_messages");
         $total1= mysqli_fetch_array($sql1);
         $totalCount= mysqli_num_rows($sql1);
         $sn1=$totalCount+1;
         $date= date('Y-m-d');
         $time= date('h:i:a',time());
         $sql2= mysqli_query($mysqli, "insert into grp_messages values('$sn1','$sender','$comment','$time','$date','$grpID','$client')");
        }else{
         $msg="write message to post";
        }
 }
 ?>
<html>
    <?php include 'header_client.php';?>
                    </div><div class="sec" style="background-color: whitesmoke;">
                        <div class="counsel" style="background-color: #EEE;">
                            <div class="login" style=" color:black;">
                            <?php 
                             $userSql= mysqli_query($mysqli, "select * from clients where matNo='$mat'");
                            $user= mysqli_fetch_array($userSql);
                            ?>     
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
                    $stmt= mysqli_query($mysqli, "update clients set status='offline', logoutRef='$logout', logoutTime='$logoutTime' where matNo='$mat'");
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
                            </div> 
                           <?php
                            $k=0;
                            $NotStmt= mysqli_query($mysqli, "select * from messages where clientID='$mat' && status='unread' && sender='counsellor'");
                           $count= mysqli_num_rows($NotStmt);
                           if($count>0)
                            { 
                               $message=mysqli_fetch_array($NotStmt);
                               $counsellor=$message['counsellorID'];
                               $CounSsql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellor'");
                               $sender= mysqli_fetch_array($CounSsql);
                               $k++;
                             // $msgID=$count['messageID'];
                          ?>
                            <br><div class="notification" style="height:auto; width:80%;">
                        <table border="0"><tr><th>
                         <?php echo "You have (<font color='red'>".$count."</font>) new message(s)"; ?>
                                </th></tr>
                            <tr><td align="right">
                       <?php echo "<a href='ClientMessage.php?counsellorID=".$counsellor."'align='right'><u>Read</u></a>";?>
                                </td></tr></table>
                        </div>  
                          <?php }?>
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                        </div>
                        <div class="sec2"><hr>
                             <?php $grpSQL= mysqli_query($mysqli, "select * from groups where groupID='$grpID'");
                            $grpReslt=mysqli_fetch_array($grpSQL);
                            $crtedby=$grpReslt['authourID'];
                            $aut=mysqli_query($mysqli, "select * from counsellors where staff_id='$crtedby'");
                            $author= mysqli_fetch_array($aut); 
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Group Name:<font color="red"> <?php echo $grpReslt['name'];?></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created by: <font color="red"> <?php echo $author['surname'].", ".$author['fName']." ".$author['mName'];?></font>
                            <hr>
                            <iframe src="grpMessage.php" style="height: 75%; width: 98%; border:none; "></iframe>
                            <form method="POST">
                                <textarea id="post" rows="2" cols="60" style="border:2px solid lightblue;" name="comment" placeholder="<?php echo $msg ?>"></textarea><input type="submit" name="post" value="Post" style=" color:white; width:auto; padding: 5px; background-color: brown;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="CTexitGroup.php?groupID=<?php echo $grpID;?>" style=" color:white; width:auto; padding: 5px; color: red;">Exit Group</a>
                        </form>
                    </div>
            </div>
    </body>
</html>
<?php
 //$_SESSION['client']=$client;
 } else {
     header('Location:home.php');
 }
 ?>