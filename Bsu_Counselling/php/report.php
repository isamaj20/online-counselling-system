<?php
 ob_start();
include ('DBConnect.php');
?>
<?php
session_start();
if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
{
    $day = date('d');
                // $yr=$_POST['yr'];
                 $_SESSION['year']="";
//                 $mnthFrm=$_POST['mnthFrom'];
//                 $mnthTo=$_POST['mnthTo'];
                 $_SESSION['mnthF']="";
                 $_SESSION['mnthT']="";
                 
    $counsellorID=$_SESSION['staff'];
  $userSql= mysqli_query($mysqli, "select * from counsellors where staff_id='$counsellorID'");
 $user= mysqli_fetch_array($userSql);
$CurrentMonth=  date('M');
$CurrentYear=date('Y');
?>
<html>
<?php include 'header_counsellor.php';?>
    <link href="../css/report.css" type="text/css" rel="stylesheet">
        <div class="sec" >
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
                        </div><br>
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
<!--                contains code for CONTACT-->             
<?php
        include 'contactUs.php';
//       contains code for ABOUT US       
        include 'about.php';
?>
                </div>
                <div style="height:99.5%; text-shadow:none;" class="sec2">
<!--                    report -->
              <div class="rpt">
<!--                  div-reportHeader contains codes with form data-->
                <div class=" reportHeader">
                    <form method="POST">
                    <div id="reprt" >
                    Generate Client Report:
                    </div>                
                    <div id="submt" >
                        <input type="submit" name="report" value="View" style="color:white; width:auto; padding: 0px; background-color: brown;"><br>
                    </div>
                    <div id="mnthYr" style=" width: auto;" >
                    Month: from <select name="mnthFrom">
                        <option value="">Month</option>
	<?php for ($month = 1; $month <= 12; $month++) { ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?></select>
                     to: <select name="mnthTo">
                      <option value="">Month</option>
	<?php for ($month = 1; $month <= 12; $month++) { ?>
	<option value="<?php echo strlen($month)==1 ? '0'.$month : $month; ?>"><?php echo strlen($month)==1 ? '0'.$month : $month; ?></option>
	<?php } ?>  
                    </select>
                    Year:<select name="yr">
<!--                        <option><?php //echo date('Y')-1;?></option>-->
                         <?php for ($year = date('Y'); $year > date('Y')-100; $year--) { ?>
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<?php } ?>
                    </select>
                    </div>
                    </form>
                </div>
<?php 
// posting data collected from form input and binding them to session variable
 if(isset($_POST['report'])!="")
  {
                 $day = date('d');
                 $yr=$_POST['yr'];
                 $_SESSION['year']=$yr;
                 $mnthFrm=$_POST['mnthFrom'];
                 $mnthTo=$_POST['mnthTo'];
                 $_SESSION['mnthF']=$mnthFrm;
                 $_SESSION['mnthT']=$mnthTo;
              $allSQL= mysqli_query($mysqli, "select * from clients");
              $all=mysqli_num_rows($allSQL);
$viewRpt=mysqli_query($mysqli, "SELECT * FROM problems WHERE  month>='$mnthFrm' AND month<='$mnthTo' AND year='$yr'");
$count= mysqli_num_rows($viewRpt);
$k=0;
?>
<div>
    <table border="0" style=" width:100%; height:5%;" cellspacing="5" cellpadding="5">
      <tr style="background-color: #CCC;">
        <th  colspan="6">
       Client Report From:  <?php echo $mnthFrm."/".$yr."<font color='white'>  -TO- </font>".$mnthTo."/".$yr; ?>
        </th>
      </tr>
             <tr>
                <td colspan="2">
                <b>Period:<?php echo "<font color='red'>".$mnthFrm."/".$yr."</font>-TO- <font color='red'>".$mnthTo."/".$yr."</font>"; ?></b>
                </td>
                <td colspan="3">
                    <b>  Number of issues for this period:<font color="red"><?php echo " ".$count; ?></font></b>
                </td>
                <td>
                    <b>Total Number of Clients:<font color="red"><?php echo " ".$all; ?></font></b>
                </td> 
              </tr>     
              <tr style="background-color: #CCC;">   
<!--                <th>Added by</th>-->
                <th>Client</th>
                <th colspan="2">Problem Description</th>
                <th>Month</th>
                <th>Year</th>
                <th>Date</th>
            </tr>
    </table>
    <iframe src="rept.php" style="height:64%; width: 99.9%; border: none;"></iframe>       
</div>
<?php   }else{
    echo "<font color='red' >select <u>Months</u> and <u>Year</u> then click>></font>VIEW";
}
?>
</div>
</div>
</div>
      </div>
<!--        footer-->
       <?php include 'footer.php';?>
</html>
<?php
$_SESSION['staff']=$counsellorID;
}
else{
    header("Location:Home.php");
}
