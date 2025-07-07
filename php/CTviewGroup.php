<?php 
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
 $msg="";
 $msg1="";
 $staff_id="";
 $clientID=$_GET['clientID'];
 $userSql= mysqli_query($mysqli, "select * from clients where matNo='$clientID'");
 $user= mysqli_fetch_array($userSql);
 ?>
<html>
    <?php include 'header_client.php';?>
            <div class="sec" style="background-color: whitesmoke;">
                <div class="counsel">
                    <div class="login" style=" color:black;">
                     
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
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                </div>
                <div class="sec2" style="height: auto;">
                    <br>
                    <table border="0" style="height: auto; width: 100%; background-color:  #CCC; color:  #333; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
                    <tr>
                        <th colspan="8" style="border-bottom: 1px dashed #663300;">
                            BSU STUDENT COUNSELLING GROUPS
                        </th>
                    </tr>
                    <tr>
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
                     while ($groups= mysqli_fetch_array($sql)){
                      $k++;
                     ?>
                    <tr>
                        <td style="border-bottom: 1px dashed #663300;"><?php echo $k ?></td>
                        <td style="border-bottom: 1px dashed #663300;"><?php echo $groups['name']?></td>
                        <td style="border-bottom: 1px dashed #663300;"><?php echo "******"?></td>
                        <td><textarea rows="5" cols="20"><?php echo $groups['description']?></textarea></td>
                        <td style="border-bottom: 1px dashed #663300;">
                            <?php 
                            $crtedby=$groups['authourID'];
                            $aut=mysqli_query($mysqli, "select * from counsellors where staff_id='$crtedby'");
                            $author= mysqli_fetch_array($aut); 
                            echo $author['surname'].", ".$author['fName']." ".$author['mName'];
                            ?>
                        </td>
                        <td><?php echo $groups['member']?></td>
                        <td><?php echo $groups['dateCreated']?></td>
                        <?php $grpID=$groups['groupID']; ?>
                      <td><?php echo "<a href='joinGroup.php?grpID=".$grpID."&clientID=".$clientID."' style='text-decoration: none; border: 1px solid #663300; background-color:brown;color:  white;'>Join</a>"; ?></td>
                    </tr>
                     <?php } ?>
                </table>
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
