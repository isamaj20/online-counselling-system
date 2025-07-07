<?php 
  ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 $mat="";
 $password="";
 $msg="";
 $msg1="";

                                           //comment: getting new client data
 if(isset($_POST['submit'])!="")
{
    //session_start();
    $surname=$_POST['surname'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $dept=$_POST['dept'];
    $mat=$_POST['matNo'];
    $level=$_POST['level'];
    $sex=isset($_POST['sex'])? $_POST['sex']:null;
    $phone=$_POST['phone'];
    if($surname!="" && $fname!="" && $dept!="" && $level!="" && $mat!="" && $sex!="" && $phone!="") {
     $stmt= mysqli_query($mysqli, "select * from clients where matNo='$mat' && phoneNo='$phone'");
     $all= mysqli_fetch_array($stmt);
     $count= mysqli_num_rows($stmt);
     $_SESSION['client']=$mat;
     if($all['matNo']==$mat)//comment: checking is client is actually new
     { 
         $msg="Successfully registered, Click <a href='user.php'>HERE</a> to create login details";
     }else{
         $sql= mysqli_query($mysqli, "select * from clients");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         
         //inserting new client
         $status="offline";
         $logRef="not set";
         $logTime="not set";
$stmt = mysqli_query($mysqli, "insert into clients values('$sn','$fname','$mname','$surname','$mat','$dept','$level','$phone','$sex','$status','$logRef','$logTime')");
         
         if($stmt){
             
             //adding client to problem table
         $sql1= mysqli_query($mysqli, "select * from problems");
         //$total= mysqli_fetch_array($sql);
         $totalCount1= mysqli_num_rows($sql1);
         $sn1=$totalCount1+1;
                              $mnth=date('m');
                              $yr=date('Y');
                              $date= date('Y-m-d');
                              $prbm="nothing yet";
                              $counsellor_ID="none yet";
              $prblmSQL= mysqli_query($mysqli, "insert into problems values('$sn1','$prbm','$mat','$counsellor_ID','$mnth','$yr','$date')");
             $msg="Successfully registered, Click <a href='user.php'>HERE</a> to create login details";
         }else{
             $msg="error: ".mysqli_error($mysqli);
         }
     }
    }
    else{
        $msg="fill all required fields";
    }
}

 ?>
<html>
   <?php     include 'header.php';?>
            <div class="sec" >
                <div class="counsel" style=" background-color: whitesmoke;">
<?php
 include 'services.php';
 include 'contactUs.php';
 include 'about.php';
?>
                </div>
                <div class="sec2" >
                   <form method="POST">
                        <table border="0"  cellspacing="5" style="height: 100%; width: 70%;">
                    <tr>
                        <th colspan="3" style="border-bottom: 1px dashed #333;">
                        <font color="grey"> CLIENT DATA CAPTURE FORM </font>| NEW CLIENT 
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
                        <td >
                            <input type="text" name="surname" id="snm" required="required"><font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                        <td>
                    First Name: 
                    </td>
                    <td >
                        <input type="text" name="fname" required="required"><font color="red">*</font>
                    </td>
                    <tr>
                        <td>
                    Middle Name:
                    </td>
                    <td >
                        <input type="text" name="mname">
                    </td>
                    </tr>
                    <tr>
                        <td>
                    Department:
                    </td>
                    <td >
                        <input type="text" name="dept" required="required"><font color="red">*</font>
                    </td>
                      <tr>
                        <td>
                            Matric. No:
                        </td>
                        <td >
                            <input type="text" name="matNo" required="required"><font color="red">*</font>
                        </td>
                    </tr>
                    <tr>
                    <td>
                    Level: 
                    </td>
                    <td >
                        <select name="level" style=" width:auto; " required="required">
                            <option value="">--level--</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                    </select><font color="red">*</font>  
                    </td>
                    </tr>
                    <tr>
                        <td>
                          Gender:
                        </td>
                        <td >
                            Male<input type="radio" name="sex" value="Male" style="width: 10%;">
                            Female<input type="radio" name="sex" value="Female" style="width: 10%;">
                            <font color="red">*</font>  
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone Number:
                        </td>
                        <td >
                            <input type="number" name="phone" required="required"><font color="red">*</font>
                        </td>
                    </tr>
                     <tr>
                        <th colspan="2" >
                            <input id="sub" style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="submit" value="Submit">
                        </th>
                    </tr>
            </table>
            </form>
                </div>
             </div>
        </div>
<?php    include 'footer.php';?>
    </body>
</html>
