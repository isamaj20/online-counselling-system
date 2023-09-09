<?php
 ob_start();
  include 'DBConnect.php';
?>
<?php
 session_start();
   $msg=""; 
   $length="";
                                            //comment: Creating New User
if(isset($_POST['create']))
{
    $newUser=$_POST['user'];
    $newPass=$_POST['pass'];
    $newPass2=$_POST['pass2'];
    $id=$_POST['id'];
    if($newUser!="" && $newPass!="" && $newPass2!="" && $id!="")//comment: check if any required input field is empty
    {
    if($newPass!=$newPass2)//comment: check if the password matches
    {
        $msg="Error, password mismatched";
    }else{
       if(strlen($newPass)<6)
        {
            $msg="password length too short (min 6 charaters)";
        }else{
			if(preg_match('/[A-Za-z]/', $newPass) && preg_match('/[0-9]/', $newPass))
			{
                            $usernSQL= mysqli_query($mysqli, "select * from users where username='$newUser'");
                            $userResult=mysqli_num_rows($usernSQL);
                            if($userResult<1)
                            {
        $us= mysqli_query($mysqli,"select * from users where id='$id'");
        $cnt= mysqli_num_rows($us);
        if($cnt<1)
        {   
                                       //comment: checking if the ID is valid i.e either client or counsellor
        $checkStaffID= mysqli_query($mysqli, "select * from counsellors where staff_id='$id'");
        $detailsID= mysqli_fetch_array($checkStaffID);
        if($detailsID['staff_id']==$id)
        {
        $serial= mysqli_query($mysqli, "select * from users");
         $total= mysqli_fetch_array($serial);
         $totalCount= mysqli_num_rows($serial);
         $sn=$totalCount+1;
         $role="counsellor";
         $_SESSION['role']=$role;
       $sql1= mysqli_query($mysqli, "insert into users values('$sn','$newUser','$newPass','$id','$role')"); 
       $msg="Done!!!, click <a href='home.php'>HERE</a> to login now";
        }else{
        $checkClientID= mysqli_query($mysqli, "select * from clients where matNo='$id'");
        $detailsID2= mysqli_fetch_array($checkClientID);
           if($detailsID2['matNo']==$id)
           {
          $serial= mysqli_query($mysqli, "select * from users");
         $total= mysqli_fetch_array($serial);
         $totalCount= mysqli_num_rows($serial);
         $sn=$totalCount+1;
         $role="client";
         $_SESSION['role']=$role;
       $sql1= mysqli_query($mysqli, "insert into users values('$sn','$newUser','$newPass','$id','$role')"); 
       $msg="Done!!!, click <a href='home.php'>HERE</a> to login now";   
           }else{
               $msg="invalid id";
           }
        }
        }else{
            $update= mysqli_query($mysqli, "update users set username='$newUser', password='$newPass' where id='$id'");
            $msg="Updated!!!, click <a href='home.php'>HERE</a> to login now";
        }
                        }else{$msg="Username already existed !";}	}else{$msg="password must contain both Alphabet and atleast one Number.";}}}
  }else{
      $msg="fill all required fields";
  }
}
?>
<html>
    <?php include 'header.php';?>
            <div class="sec" >
                <div class="counsel" style=" background-color: whitesmoke;">
<?php
                include 'services.php';
                include 'contactUs.php';
                include 'about.php';
?>
                </div>
                <div class="sec2" >
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <table border="0"  cellspacing="5" style="height: 90%; width: 90%; ">
                    <tr>
                    <th colspan="2" style="border-bottom: 1px dashed #333;">
                        <font color="grey"> NEW USER | LOGIN DETAILS </font> 
                    </th>
                    </tr>
					<tr>
					<th colspan="2"><font color='grey' size='5'><i>Password Hint: Combination of Alphabets and atleast one number</i></font></th>
					</tr>
                     <tr>
                        <th colspan="2" style="font-style:  initial; color: red; font-size: large;">
                            <?php echo $msg; ?>
                        </th>
                    </tr>
                    <tr>
          <td colspan="2"><font color="red">*</font><font size='3' color='grey'>Required fields</font></td>
                    </tr>
                    <tr>
                        <td>
                            Username:
                        </td>
                    <td>
                        <input type="text" name="user" placeholder="username" id="creUS" style=" width:60%; height: auto;"><font color="red">*</font>
                    </td>
                    <tr>
                    <td>
                    Password:
                    </td>
                    <td>
                        <input type="password" name="pass" placeholder="password" style=" width:60%; height: auto;"><font color="red">*</font>
						<font color='grey' size='5'><i>minimum of six(6) charaters.</i></font>
                    </td>
                      <tr>
                        <td>
                           Confirm Password: 
                        </td>
                    <td>
                        <input type="password" name="pass2" placeholder="re-type password" style=" width:60%; height: auto;"><font color="red">*</font>
                    </td>
                    </tr>
                    <tr>
                        <td>
                            Your ID
                        </td>
                        <td>
                            <input type="text" name="id" placeholder="your id" style=" width:60%; height: auto;"><font color="red">*</font>
                        </td>
                    </tr>
                     <tr>
                         <th colspan="2">
                            <input id="cre" style="color:white; width:auto; padding: 5px; background-color: brown;" type="submit" name="create" value="Create">
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


