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
 $error="";
 $counsellorID=$_SESSION['staff'];
 $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
 ?>
<html>
<?php include 'header_counsellor.php';?>
            <div class="sec" style="background-color:white; height: auto;">

                <div class="counsel">
                    <div class="login" style="color:black;">
                   
                        Current Counsellor<br>
                        <div  class="loginUser">
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
<!--                    <br>-->
                    <table border="0" style="text-shadow:none;height: auto; width: 100%;  color:  #333; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
                    <tr>
                        <th colspan="8" style="  background-color:  #CCC;border-bottom: 1px dashed #663300;">
                           COUNSELLING GROUPS
                        </th>
                    </tr> 
                    <tr style=" background-color:  #CCC;">
                        <th style="border-bottom: 1px dashed #663300;">SN</th>
                        <th style="border-bottom: 1px dashed #663300;">Group Name</th>
                        <th style="border-bottom: 1px dashed #663300;">Group ID</th>
                        <th style="border-bottom: 1px dashed #663300;">Description</th>
                        <th style="border-bottom: 1px dashed #663300;">Created By</th>
                        <th style="border-bottom: 1px dashed #663300;">Total Members</th>
                        <th style="border-bottom: 1px dashed #663300;">Date created</th>
                        <th style="border-bottom: 1px dashed #663300;">Options</th>
                    </tr>
                    <?php
                     $k=0;
                     $sql= mysqli_query($mysqli, "select * from groups");
                     $count= mysqli_num_rows($sql);
                     if($count<1){
                          $error='no group available';
                     }else{
                     while ($groups= mysqli_fetch_array($sql))
                     {
                      $k++;
                     ?>
                    <tr>
                        <td style=" border-bottom: 1px dashed #333;"><?php echo $k ?></td>
                        <td style=" border-bottom: 1px dashed #333;"><?php echo $groups['name']?></td>
                        <td style=" border-bottom: 1px dashed #333;"><?php echo $groups['groupID']?></td>
                        <td><textarea rows="5" cols="20" style="border-radius: 1em;"><?php echo $groups['description']?></textarea></td>
                        <td style=" border-bottom: 1px dashed #333;">
                            <?php
                             $crtedby=$groups['authourID'];
                            $aut=mysqli_query($mysqli, "select * from counsellors where staff_id='$crtedby'");
                            $author= mysqli_fetch_array($aut); 
                            echo $author['surname'].", ".$author['fName']." ".$author['mName'];
                            ?>
                        </td>
                        <td style=" border-bottom: 1px dashed #333;"><?php echo $groups['member']?></td>
                        <td style=" border-bottom: 1px dashed #333;"><?php echo $groups['dateCreated']?></td>
                        <td><a href="groupMembers.php?grpID=<?php echo $groups['groupID']; ?>" style="text-decoration: none; border: 1px solid #663300; background-color: brown;color:  white; border-radius: 0.5em;">view</a> 
                            <a href="deleteGroup.php?grpID=<?php echo $groups['groupID']; ?>" style="text-decoration: none; border: 1px solid #663300; background-color: brown;color:  white; border-radius: 0.5em;">Delete</a></td>
                    </tr>
                     <?php }}  ?>
                    <tr>
                        <td colspan="8"><?php echo"<font color='red'>". $error."</font>"; ?></td>
                    </tr>
                    <tr>
                        <th colspan="7">
                            <a href="creatGroup.php?staffID=<?php echo $counsellorID; ?>" style="text-decoration: none; float:right; border: 1px solid #663300; background-color: brown;color:  white; border-radius: 0.5em;">Create New Group</a>
                        </th>
                    </tr>
                </table>
<center>
    <a href="viewGroup.php" style=" color:white; width:auto; padding: 5px;background-color: brown; color: white; border-radius: .5em">Refresh</a> 
</center>
                </div>
             </div>
        </div>
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }