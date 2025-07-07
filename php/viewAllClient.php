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
     $counsellorID=$_SESSION['staff'];
 $msg="";
 $msg1="";
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 ?>
<html>
   <?php include 'header_counsellor.php';?>
            <div class="sec">
                <div class="counsel">
                    <div class="login">
                   
                        Current Counsellor<br>
                        <div class="loginUser">
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
                    </div>
                   
<?php
        include 'contactUs.php';
        include 'about.php';
 ?>
                    
                </div>
                <div class="sec2" style="height: auto;">
<!--                    <br>-->
                    <table border="0" style="height:2%; width:98%; background-color:  #CCC; color:  #333; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
                    <tr>
                        <th colspan="9" style="border-bottom: 1px dashed #663300;">
                            <font color="white">BSU STUDENT COUNSELLING</font> | CLIENTS
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="viewAllClient.php" style=" color:white; width:auto; padding: 5px;background-color: brown; color: white; border-radius: .5em">Refresh</a> 
                        </th>
                    </tr>
                </table>
                    <iframe src="Vclients.php" style="height:75%; width: 98%; border:none;"></iframe>
                </div>
             </div>
        </div>
        <?php     include 'footer.php';?>
    </body>
</html>
 <?php }else{
     header('Location:home.php');
 }
 