<?php 
 ob_start();
 include 'DBConnect.php';
// $page = $_SERVER['PHP_SELF'];
//$sec = "10";
?>
<?php
 session_start();
 $msg="";
 $msg1="";
 $clientID=$_SESSION['client'];
 $counsellorID=$_SESSION['staff'];
 $msgID="";
 if(isset($_POST['send'])!="")
 {
  $mess=$_POST['mess'];
  date_default_timezone_set('Africa/Lagos');
$date= date('Y-m-d');
 $time= date('h:i:a',time());
  if($mess!="")
  {
      $sql= mysqli_query($mysqli, "select * from messages");
         $total= mysqli_fetch_array($sql);
         $totalCount= mysqli_num_rows($sql);
         $sn=$totalCount+1;
         $stmt= mysqli_query($mysqli, "insert into messages values('$sn','$clientID','$counsellorID','$mess','$msgID','$date','$time')");
         if($stmt)
         {

         } else{
             $msg="sorry, message failed due to ". mysqli_error($mysqli);
         }
           } else {
      $msg="write your message here ";
  }
 }
 ?>
<html>
    <head>
             <link href="css/design.css" type="text/css" rel="stylesheet">
             
<style type="text/css">
    #viewMessage{
/*    margin: 0; 
margin-left: 40%; 
margin-right: 40%;
*/
box-shadow: -2px 2px 2px #FBFBFF;
margin-top: -20px; 
/*padding-top: 10px; */
opacity:40;
/*opacity:.95;*/
display:none;
position:fixed;
/*background-color:#313131;*/
overflow:auto;
width:66%; 
height:66%;
position: absolute; 
background: #FBFBF0; 
z-index: 9; 
visibility: hidden;
/*border: 1px solid #660000;*/
}
</style>
<script language="JavaScript" type="text/javascript">
function viewMessage(showhide){
if(showhide == "show"){
    document.getElementById('viewMessage').style.visibility="visible";
    document.getElementById('viewMessage').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('viewMessage').style.visibility="hidden"; 
}
</script>
<title>Home | BSU Counselling System</title>
    </head>
    <body bgcolor="#333" style="height: auto;">
        <div style="height: auto;" class="container">
            <div class="title">
                <div class="title2">
                  <div class="logo" style="background-image: url(images/logo.png); background-repeat: no-repeat; background-size: 100% 100%;">
                      
                    </div> 
                    <div class="logo2">
                  BSU STUDENT COUNSELLING
                    </div>>
                 </div>
                <div class="home">
                <ul>
                     <li>
                         <a href="#">HOME</a>
                     </li>
                     <li>
                         <a href="#">SERVICES</a>
                     </li>
                     <li>
                         <a href="#">CONTACT</a>
                     </li>
                     <li>
                         <a href="#">ABOUT US</a>
                     </li>
                 </ul>
                </div>
            </div>
            <div class="sec">
                <div class="counsel">
                    <div class="login">
                   <form method="POST">
                        <table >
                            <tr>
                                <th>
                                    Staff Login
                                </th>
                            </tr>
                            <tr>
                                <th style="font-style:  initial; color: red; font-size: large;">
                            <?php echo $msg1; ?>
                        </th>
                            </tr>
                            <tr>
                                <td>
                                   Staff ID:
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <input style="color:  #663300;" type="submit" name="login" Value="login">
                                </th>
                            </tr>
                        </table>
                    </form>
                    </div>
                </div>
                <div style="height: auto;" class="sec2">
                    <br>
                    <form method="POST">
                     Individual Counselling Session |<a href="CTviewGroup.php?clientID=<?php echo $clientID; ?>" style="text-decoration: none; border: 1px solid #663300; background-color: #cccccc;color:  #333;">View Groups</a>
                       <?php
      $stmt= mysqli_query($mysqli, "select * from messages");
      $message= mysqli_fetch_array($stmt);
      $count=mysqli_num_rows($stmt);
      if($count<1)
      { }else{
           ?>
           <iframe src="text.php" style="height:50%; width: 99%;" frameborder="1" scrolling="yes"></iframe>
          <?php 
               }
                ?>
                           <textarea name="mess" rows="3" cols="111" placeholder="<?php echo $msg ?>"></textarea>
                           <send style="float:right;"><br></send><input style="width: 70px;" type="submit" name="send" value="Send">
                        </form>
                    </div>
             </div>
        </div>
         <div class="foot">
            <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy;copyright 2016. BSU Student Counselling System by Isama John Adeyi, Mathematics/Computer Sci Dept</center>
         </div>
    </body>
</html>