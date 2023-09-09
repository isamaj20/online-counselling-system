<?php 
 include 'DBConnect.php';
 ob_start();
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 if($_SESSION['admin']!="" && $_SESSION['role']=="admin")
 {
   $ID=$_SESSION['admin'];
 $msg="";
 $msg1="";
 $userSql= mysqli_query($mysqli, "select * from users where id='$ID'");
 $user= mysqli_fetch_array($userSql);
 if(isset($_POST['submit'])!="")
{
    //session_start();
     //$sn="";
    $surname=$_POST['surname'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $area=$_POST['area'];
    $image=trim($_FILES["file"]["name"]);
$size=trim($_FILES["file"]["size"]);
$temp=trim($_FILES["file"]["tmp_name"]);
$extension=strtolower(substr($image,strpos($image,".")+1));//converting file extension image name into lower case//strrt()=help to removed image b4 dout//
$ima=time().substr(str_replace(" ","_",$image),5);// to generate  five roundown number first 5 alphabelt name of image//
$locate="../profile/";
$imgpath=$locate.$ima;
    $sex=isset($_POST['sex'])? $_POST['sex']:null;
    if($surname!="" && $fname!="" && $area!="" && $sex!="" && $image!="")
    {
          if(isset($image))
     {
if($extension=="jpg" || $extension=="jpeg" || $extension=="png")
    {
         $sql= mysqli_query($mysqli, "select * from counsellors");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
		 $status="offline";
		 $staff_id="BSU/STDCO/".$sn;
         $stmt = mysqli_query($mysqli, "insert into counsellors values('$sn','$fname','$mname','$surname','$staff_id','$area','$sex','$imgpath','$status')");
         move_uploaded_file($temp,$imgpath);
         if($stmt){
             $msg="New Counsellor Added";
             }else { $msg="sorry, an error Occur, ".mysqli_error($mysqli);}
    }else {$msg="invalid image format ".$extension;  }
    }}
    else{ $msg="Fill all required fields";}
}
 ?>
<html>
   <?php     include 'header.php';?>
<!--            section-->
            <div class="sec"  style="background-color: white;">
<!--                user nav bar-->
                <div class="counsel">
                    <div class="login" style=" color:black;">
                   
                        Current User<br>
                        <div  class="loginUser">
                          <?php echo $user['id'];?>
                            <form method="POST">
                <?php
                 
                  if(isset($_POST['logout'])!="")
                {
                    unset($_SESSION['admin']);
                    unset($_SESSION['role']);
                    session_destroy();
                    header("Location:home.php");
                }
                ?>
                                <br>
                                <center><input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="logout" Value="LOGOUT"></center>
                            </form>
                        </div>
                         <br><br><a href="user.php" style=" color:red;">Change Username/Password</a>
                    </div>
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                </div>
                <div class="sec2">
<!--                    counsellor Registration form, contains table and form inputs-->
                <form method="POST" enctype="multipart/form-data">
                  <table border="0"  cellspacing="5" style=" height: 99%; width: 99%;">
                    <tr>
                        <th colspan="3" style="border-bottom: dashed 1px black;">
                        NEW COUNSELLOR DETAILS
                    </th>
                    </tr>
                     <tr>
                        <td></td>
                        <th colspan="2" style="font-style:  initial; color: red; font-size: large;">
                            <?php echo $msg; ?>
                        </th>
                    </tr>
                    <tr>
          <td colspan="2"><font color="red">*</font><font size='3' color='grey'>Required fields</font></td>
                    </tr>
                    <tr>
                        <td>
                    Surname:
                        </td>
                        <td colspan="2">
                            <input type="text" name="surname" id="surnm" required="required"><font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td>
                    First Name: 
                    </td>
                    <td colspan="2">
                        <input type="text" name="fname" required="required"><font color="red">*</font>
                    </td>
                    </tr>
                    <tr>
                        <td>
                    Middle Name:
                    </td>
                    <td rowspan="1">
                        <input type="text" name="mname">
                    </td>
                    <td></td>
                    </tr>
                      <tr>
                        <td>
                       About:
                        </td>
                        <td>
                            <textarea rows="5" cols="30" name="area" required="required" style="background-color: #EEE;border-radius: 0.5em"></textarea><font color="red">*</font>
                        </td>
                        <td rowspan="2">
                        <img src="<?php echo $imgpath ?>" height="100" width="200" alt="image here" style="border:1px;"><font color="red">*</font>
                    </td>
                    </tr>
                     <tr>
                        <td>
                          Gender:
                        </td>
                        <td>
                            Male<input type="radio" name="sex" value="Male" style="width: 20%;">Female<input type="radio" name="sex" value="Female" style="width: 20%;">
                        <font color="red">*</font> 
                        </td>
                    </tr>
                     <tr>
                        <td></td>
                        <th>
                            <input style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="submit" value="Submit">
                        </th> 
                        <td style="width:2%;">
                            <input type="file" name="file" required="required" style="width: auto; height: auto; background-color: white; border:none;">
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
 <?php }else{
     header('Location:home.php');
 }