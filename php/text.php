 <?php
  include 'DBConnect.php';
  session_start();
  $clientID=$_SESSION['ccounselClient'];
  $counsellorID=$_SESSION['staff'];
  ?>
<html>
    <head>
        <meta http-equiv="refresh" content="5" />
        <title>hh</title></head>
    <body>
        <?php
      $stmt1= mysqli_query($mysqli, "select * from messages where clientID='$clientID' && counsellorID='$counsellorID'");
       while($message= mysqli_fetch_array($stmt1))
       { 
           if($message['sender']=="counsellor")
         {
            echo'<textarea name="CTmsg" rows="3" cols="60" style="color:#333;border:0px;border-radius:0em 5em 1em 0em; float: right; background-color:wheat;">'.$message['time'].":--->".$message['message'].'</textarea><br><br><br>';
          } else 
          {
          echo'<textarea name="CRmsg" rows="3" cols="60" style="color:white;border:0px;border-radius:1em 0em 0em 5em; float:left; background-color:#333;">'.$message['time'].":--->".$message['message'].'</textarea><br><br><br>';
       }}
   ?>  
    </body>
</html>