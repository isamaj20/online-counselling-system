<?php
 include 'DBConnect.php';
 session_start();
                 $day = date('d');
                 $yr=$_SESSION['year'];
                 $mnthFrm=$_SESSION['mnthF'];
                 $mnthTo=$_SESSION['mnthT'];
?>
<html>
    <head>
        <meta http-equiv="refresh" content="120" />
        <title>hh</title></head>
    <body>
             <?php
              $allSQL= mysqli_query($mysqli, "select * from clients");
              $all=mysqli_num_rows($allSQL);
$viewRpt=mysqli_query($mysqli, "SELECT * FROM problems WHERE  month>='$mnthFrm' AND month<='$mnthTo' AND year='$yr'");
$count= mysqli_num_rows($viewRpt);
$k=0;
if($count>0)
{
?>
<table  border="0" style=" width: 88%; height:auto;" cellspacing="5" cellpadding="5">
    <?php 
     while($RptReslt=  mysqli_fetch_array($viewRpt))
    {
  $k++; 
    ?>
           <tr >
    
<!--              <td>
                 <?php // echo $RptReslt['counsellorID']; ?>
              </td> -->
              <td style="border-bottom:1px dashed black; width:30%;">
               <?php echo $RptReslt['clientID'];?>
              </td> 
              <td style="width:15%;">
                 <textarea row="3" cols="20" style="border:none; border-radius:1em; padding:5px; border:1px lightblue solid;"><?php echo $RptReslt['name'];?></textarea>
              </td>
              <td align="right" style="border-bottom:1px dashed black; width:10%;">
                <?php
                $mnth=$RptReslt['month'];
                if($mnth==1){echo "January";}
                else if($mnth==2){echo "February";}
                else if($mnth==3){echo "March";}
                else if($mnth==4){echo "April";}
                else if($mnth==5){echo "May";}
                else if($mnth==6){echo "June";}
                else if($mnth==7){echo "July";}
                else if($mnth==8){echo "August";}
                else if($mnth==9){echo "September";} 
                else if($mnth==10){echo "October";}
                else if($mnth==11){echo "November";}
                else {echo "December";}?>
              </td>
              <td align="right" style="width:10%;">
               <?php echo $RptReslt['year'];?>
              </td>
              <td align="right" style="border-bottom:1px dashed black;width:15%;">
               <?php echo $RptReslt['date'];?>
              </td>
           </tr>
            
          <?php //  $id=$AttReslt['Staff_ID'];
}}else{ echo"<font color='red'>No record found for the selected period</font>";}
           ?>      
</table>
    </body>
</html>
