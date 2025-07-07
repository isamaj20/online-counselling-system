<?php
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if ($_SESSION['staff'] != "" && $_SESSION['role']=="counsellor") {
     $msg          = "";
     $msg1         = "";
     $PSmsg="";
     $clientID     = ""; //$_SESSION['client'];
     $counsellorID = $_SESSION['staff'];
// $msgID="";
// $sender="Counsellor";
     $userSql      = mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
     $user         = mysqli_fetch_array($userSql);
     ?>
    <html>
    <?php include 'header_counsellor.php';?>
                 <div class="sec">
                     <div class="counsel">
                         <div class="login">

                             Current Counsellor<br>
                             <div  class="loginUser">
     <?php echo $user['surname'] . ', ' . $user['fName']; ?>
                                 <form method="POST">
                                 <?php
                                 if (isset($_POST['logout']) != "") {
                                     $stmt = mysqli_query($mysqli, "update counsellors set status='offline' where staff_id='$counsellorID'");
                                     unset($_SESSION['stff']);
                                     unset($_SESSION['role']);
                                     session_destroy();
                                     header("Location:home.php");
                                 }
                                 ?>
                                     <br>
                                     <center><input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="logout" Value="LOGOUT"></center>
                                 </form>
                             </div><br>
                             <form method="POST" style="border: 1px dashed black; width:60%;border-radius: 2em 2em 0em 0em; padding:10px; ">
                                 STATUS:
     <?php
     $statSQL = mysqli_query($mysqli, "select status from counsellors where staff_id='$counsellorID'");
     $status  = mysqli_fetch_array($statSQL);
     echo "<font color='red'>" . $status['status'] . "</font>";
     ?><br>
                                 <?php
                                 if (isset($_POST['ok']) != "") {
                                     $stat = $_POST['stat'];
                                     if ($stat != "...select...") {
                                         $stmt = mysqli_query($mysqli, "update counsellors set status='$stat' where staff_id='$counsellorID'");
                                     }
                                     else {} }
                                 ?>
                                 Change: <select name="stat">
                                     <option>...select...</option>
                                     <option>online</option>
                                     <option>busy</option>
                                     <option>away</option>
                                 </select>
                                 <br><center> <input type="submit" name="ok" value="Change" style="color:white; width:auto; padding: 5px; background-color: brown;"></center>
                             </form>
                             <a href="user.php" style=" color:white;">Change Username/Password</a>
                         </div>
<?php
        include 'contactUs.php';
        include 'about.php';
 ?>
                     </div>
                     <div style="height:90%; text-shadow:none; border-radius: 0em 0em 0em .6em;" class="sec2">
<!--                         posting update/news-->
<?php
 if (isset($_POST['post']) != "") 
     {
     $post=$_POST['newsfeed'];
     if($post!="")
     {
     $feedID="";
     $PSdate=date('Y-m-d');
     $PStime=date('h:i:s:a',time());
     $PSyr=date('Y');
     $newdate="";
     $time=date('a',time());
     //differentiating between AM and PM
     if($time=="am")
     {
         $date=date('ymd').date('his',time());
         $newdate=$date."1";
         $feedID=$newdate;
     }else{
        $date=date('ymd').date('his',time());
         $newdate=$date."2"; 
          $feedID=$newdate;
     }
                                     $stmt = mysqli_query($mysqli, "insert into news_feeds values('$feedID','$counsellorID','$post','$PSdate','$PSyr','$PStime')");
                                     if($stmt)
                                     {
                                         $PSmsg="last message was posted------->";
                                     }else{
                                       $PSmsg="--------->last message was not posted, re-write post";  
                                     }
     }else{
     $PSmsg="write to post an update or news";    
     }
       }
 ?>
<form method="POST">
    <center>
        <textarea  name="newsfeed" id="news" rows="3" cols="60" required="required" style="border-radius:.6em; margin-top: 10px; border: 1px solid lightskyblue;" placeholder="<?php echo $PSmsg;?>wrte something to post"></textarea>
        <input style="color:white; width:auto; background-color: brown;" type="submit" name="post" value="Post">
         </center>
   </form>
<table style="height:2%; width: 100%;" border="0">
                             <tr>
                                 <th  style="background-color:  #CCC;">
                                     NOTIFICATIONS
                                 </th>
                             </tr>
                         </table>
     <?php
     $stmt  = mysqli_query($mysqli, "select * from messages where counsellorID='$counsellorID' && status='unread' && sender='client'");
     $count = mysqli_num_rows($stmt);
     $k     = 0;
     if ($count < 1) {
         echo 'No new message|<a href="counsellorHome.php" style="color: red">Refresh</a>';
     }
     else {
         while ($message = mysqli_fetch_array($stmt)) {
             $client = $message['clientID'];
             $sql    = mysqli_query($mysqli, "select * from clients where matNo='$client'");
             $sender = mysqli_fetch_array($sql);
             $k++;
             $msgID  = $message['messageID'];
             ?>
                                 <div class="notification" style="height: auto;">
                                 <?php echo "<u>" . $k . ".New message(s) from: <font color='red'>" . $sender['surname'] . " " . $sender['fName'] . "</font></u>"; ?><br>

                                     <?php echo "<a href='message.php?client=" . $client . "&msgID=" . $msgID . "'><u>Read</u></a>"; ?>
                                 </div>
                                 <?php }
                             } ?> 
                     </div>
                 </div>
             </div>
<!--             footer-->
             <?php include 'footer.php';?>
         </body>
     </html>
     <?php
 }
 else {
     header('Location:home.php');
 }
