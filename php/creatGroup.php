<?php 
  ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 $msg="";
 $msg1="";
  session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
      $counsellorID=$_SESSION['staff'];
 $staff_id=$_GET['staffID'];
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 if(isset($_POST['create'])!="")
 {
     $descrptin=$_POST['grpdescrptn'];
     $grpname=$_POST['grpname'];
     if($grpname!="" && $descrptin!="")
     {
         $sql= mysqli_query($mysqli, "select * from groups");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         $grpDate= date('ymd');
         $grpID="grp-".$grpDate."-".$sn;
         $date= date('Y-m-d');
         if($grpname!=$total['name'])
         {
         $stmt= mysqli_query($mysqli, "insert into groups values('$grpname','$grpID','$descrptin','$staff_id','0','$date')");
         if($stmt)
         {
             $msg="New Group Added";
         }else{
             $msg="Sorry, Couldn't complete the operation ".mysqli_error($mysqli);
         }
         }else{
             $msg="group name already exist";
         }
     }else{
         $msg="fill all fields";
     }
 }
 ?>
<html>
    <?php include 'header_counsellor.php';?>
            <div class="sec" style="background-color:white;">
                <div class="counsel">
                    <div class="login" style=" color:black;">
                  
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
                <div class="sec2" style="height: auto;">
                    <br>
                    <form method="POST">
                    <table border="0" style="height: auto;width: 100%; background-color:  #CCC; color:  #333; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
                    <tr>
                        <th colspan="2" style="border-bottom: 1px dashed #663300;">
                            BSU STUDENT COUNSELLING | ADD NEW GROUP
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-shadow:none;">
                            <?php echo "<font color='red' size='3px'>".$msg."</font>"; ?>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Group Name:
                        </td>
                        <td>
                            <input type="text" name="grpname" required="required">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Desccription:
                        </td>
                        <td>
                            <textarea name="grpdescrptn" rows="5" cols="50" placeholder="<?php echo 'write the group description here' ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <input type="submit" name="create" value="CREATE" style="color:white; width:auto; padding: 5px; background-color: brown;">
                        </th>
                    </tr>
                </table>
                    </form>
                </div>
             </div>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }