<?php //
include'DBConnect.php';
?>
<?php
// $clientID="";
// $counsellorID="";
 session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
     //$clientID=$_GET['clientID']; 
     $counsellorID=$_SESSION['staff']; 
      $groupID=$_SESSION['grpID'];
  ?>
     <html>
    <head>
        <meta http-equiv="refresh" content="120" />
        <title>hh</title></head>
    <body>
          <table border="0" style="height: auto; width: 98%; color:  #333;text-shadow:none; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
                        <?php 
                         $sql1= mysqli_query($mysqli, "select * from groups where groupID='$groupID'");
                     $groups= mysqli_fetch_array($sql1);
                     ?>
                    <tr style="background-color:  #CCC;">
                        <th style="border-bottom: 1px dashed #663300;">SN</th>
                        <th style="border-bottom: 1px dashed #663300;">Surname</th>
                        <th style="border-bottom: 1px dashed #663300;">First Name</th>
                        <th style="border-bottom: 1px dashed #663300;">Middle Name</th>
                        <th style="border-bottom: 1px dashed #663300;">Client ID</th>
                        <th style="border-bottom: 1px dashed #663300;">Department</th>
                        <th style="border-bottom: 1px dashed #663300;">Level</th>
                        <th style="border-bottom: 1px dashed #663300;">Phone</th>
                        <th style="border-bottom: 1px dashed #663300;">Gender</th>
                    </tr>
                    <?php
                     $k=0;
                     $sql= mysqli_query($mysqli, "select * from group_members where groupID='$groupID'");
                     while ($members= mysqli_fetch_array($sql))
                     {
                        $id=$members['ID'];
                         $sql2= mysqli_query($mysqli, "select * from clients where matNo='$id'");
                         while($mem= mysqli_fetch_array($sql2))
                         {
                      $k++;
                     ?>
                    <tr>
                        <td><?php echo $k ?></td>
                        <td><?php echo $mem['surname']?></td>
                        <td><?php echo $mem['fName']?></td>
                        <td><?php echo $mem['mName']?></td>
                        <td><?php echo $mem['matNo']?></td>
                        <td><?php echo $mem['dept']?></td>
                        <td><?php echo $mem['level']?></td>
                        <td><?php echo"0". $mem['phoneNo']?></td>
                        <td><?php echo $mem['sex']?></td>
                    </tr>
                     <?php } }?>
                </table>
    </body>
</html>
<?php
       } else {
           header('Location:home.php');
 }
