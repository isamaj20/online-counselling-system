<?php 
 ob_start();
 include 'DBConnect.php';
?>
<?php
 //starting session and checking if the session variable is empty. if empty redirect to login page.
 session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
     $date= date('Y-m-d');
 $msg="";
 $msg1="";
 $clientID=$_SESSION['client'];//getting client id from session
 $update2= mysqli_query($mysqli, "update messages SET status='read' where clientID='$clientID' && status='unread' && sender='counsellor'");
 $counsellorID=$_GET['counsellorID'];//getting counsellor id from the previous page through URL
  $_SESSION['clientCounsel']=$counsellorID; //binding a client to counsellor using session variable  
                    
                  //getting the current client details
 $userSql= mysqli_query($mysqli, "select * from clients where matNo='$clientID'");
 $user= mysqli_fetch_array($userSql);
 if($clientID!="" && $counsellorID!="")
 {
     //Checking if client have any active session with any counsellor, no know either to add new counselling session or continue from prev, session
           $checkSessSQL= mysqli_query($mysqli, "select * from counsel_session where clientID='$clientID'");
           $checkSess=mysqli_fetch_array($checkSessSQL);
           $count2=mysqli_num_rows($checkSessSQL);
           if($count2<1)
            { // execute if client does not have any active session with counsellor
              
                             //starting client's counselling session 
         $sql= mysqli_query($mysqli, "select * from counsel_session");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         $session="active";
         $request="no request";
         $sessionSQL= mysqli_query($mysqli, "insert into counsel_session values('$sn','$counsellorID','$clientID','$date','$session','$request')");
                                                              
                   //sending message to counsellor
 if(isset($_POST['send'])!="")
 {
$mess=$_POST['mess'];//posting the content of the textarea
  date_default_timezone_set('Africa/Lagos');//setting Local timezone

 $time= date('h:i:a',time());
  if($mess!="")
  {
      //insert new message to message table if variable '$mess' is not empty
      $sql1= mysqli_query($mysqli, "select * from messages");
         $total1= mysqli_fetch_array($sql1);
         $totalCount1= mysqli_num_rows($sql1);
         $sn1=$totalCount1+1;
          $msgID="MSG/".$sn1;
         $status="unread";
         $sender="client";
         $stmt= mysqli_query($mysqli, "insert into messages values('$sn1','$clientID','$counsellorID','$mess','$msgID','$date','$time','$sender','$status')");
         if($stmt)
         {
//if succcess do nothing
         } else{
             $msg="sorry, message failed ";
         }
           } else {
      $msg="write your message here ";
  }
 }
            }else 
          { //execute if client have an active session with a counsellor
 if(isset($_POST['send'])!="")
 {
     //getting message id to enable update a specific message and updating message status
 $msgID=isset($_GET['msgID'])? $_GET['msgID']:null;
 $update= mysqli_query($mysqli, "update messages SET status='read' WHERE messageID='$msgID'");
 
 $mess=$_POST['mess'];
  date_default_timezone_set('Africa/Lagos');
 $time= date('h:i:a',time());
  if($mess!="")
  {
      $sql1= mysqli_query($mysqli, "select * from messages");
         $total1= mysqli_fetch_array($sql1);
         $totalCount1= mysqli_num_rows($sql1);
         $sn1=$totalCount1+1;
          $msgID="MSG/".$sn1;
         $status="unread";
         $sender="client";
         $stmt= mysqli_query($mysqli, "insert into messages values('$sn1','$clientID','$counsellorID','$mess','$msgID','$date','$time','$sender','$status')");
         if($stmt)
         {

         } else{
             $msg="sorry, message failed due to ". mysqli_error($mysqli);
         }
           } else {
      $msg="write your message here ";
  }
 }
      }
 }else{
     header('Location:Vcounsellors.php');
 }
 ?>
<html>
<?php     include 'header_client.php';?>
<!--           <div class="sec"> contains the codes for the other part of this page after the header-->
            <div class="sec" style="background-color:white;">
<!--               <div class="counsel"> ccontains the code for the left side of the section (navigation)-->
                <div class="counsel">
                    <div class="login" style=" color:black;">
                   
                        Current Client<br>
                        <div  style="border:#000 1px dashed; height: 20%; color:  red; width:60%; font-size: 25px; padding: 10px; border-radius: 2em 0em 2em 0em;">
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
                    </div>
<!--                   < div class-pop >contains the content of the 'ABOUT, SERVICE and CONTACT' section-->
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                </div>
<!--getting and sending messages using iframe-->
                <div style="height:98%;" class="sec2">
                    <hr>
                    <form method="POST" name="newMes">
                        <table style="height:2%;" border="0">
                            <tr>
                                <th >
                                    <?php $witSQL= mysqli_query($mysqli, "select surname from counsellors where staff_id='$counsellorID'");
                                    $wit=mysqli_fetch_array($witSQL);?>
                                  Individual Counselling Session with <?php echo"<font color='red'>".$wit['surname']."</font>" ;?>|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="CTviewGroup.php?clientID=<?php echo $clientID; ?>" style="text-decoration: none; border: 1px solid #663300; background-color: brown;color:white; border-radius: .3em;">View Groups</a>
                                </th>
                            </tr>
                        </table><hr>
                             <?php
      $stmt= mysqli_query($mysqli, "select * from messages where clientID='$clientID' && counsellorID='$counsellorID'");
      //$message= mysqli_fetch_array($stmt);
      $count=mysqli_num_rows($stmt);
      if($count<1)//if there is message display in iframe else hide iframe
      { }else{
           ?>
           <iframe src="clientText.php" style="height:63%; width: 99%;" frameborder="0" scrolling="yes"></iframe>
          <?php 
               }
                ?>
           <table border="0" style="height:10%; ">
                            <tr>
                                <td align="right">
                                    <textarea id="post" name="mess" rows="3" cols="50" style="border:2px solid lightblue; border-radius: 1em;" placeholder="<?php echo $msg ?>"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                   <input style="width:auto; background-color: brown; color: white;" type="submit" name="send" value="Send">  
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
