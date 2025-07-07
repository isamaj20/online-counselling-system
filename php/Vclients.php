 <?php
  include 'DBConnect.php';
   session_start();
 if($_SESSION['staff']!="" && $_SESSION['role']=="counsellor")
 {
  ?>
<html>
    <head><title>hh</title></head>
    <body><table border="0" style="height:auto; width:100%; background-color:  #CCC; color:  #333; border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
            
                    <tr>
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
                     $sql= mysqli_query($mysqli, "select * from Clients");
                     while ($clients= mysqli_fetch_array($sql))
                     {
                      $k++;
                     echo" <tr>";
                        echo"<td>".$k."</td>";
                        echo"<td>".$clients['surname']."</td>";
                        echo"<td>".$clients['fName']."</td>";
                        echo"<td>".$clients['mName']."</td>";
                        echo"<td>".$clients['matNo']."</td>";
                        echo"<td>".$clients['dept']."</td>";
                        echo"<td>".$clients['level']."</td>";
                        echo"<td>0".$clients['phoneNo']."</td>";
                        echo"<td>".$clients['sex']."</td>";
                    echo"</tr>";
                    } ?>
        </table>
    </body>
</html>
<?php
} else {
     header('Location:clientHome.php');
 }
