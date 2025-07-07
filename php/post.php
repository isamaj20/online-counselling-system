<?php
 include 'DBConnect.php';
 session_start();
   $log=$_SESSION['log'];
?>
<html>
    <head>
        <meta http-equiv="refresh" content="120" />
        <title>hh</title></head>
    <body>
             <?php
              $newSql= mysqli_query($mysqli,"select * from news_feeds where nFeedID>='$log'");
     $num=mysqli_num_rows($newSql);
$k=0;
?>
        <table border="0" style=" width:100%; height:auto;" cellpadding="5">
<?php
if($num>0)
     {
     while($post=mysqli_fetch_array($newSql))
     {
         $checkClientID= $post['authorID'];
         $authSQL= mysqli_query($mysqli, "select * from counsellors where staff_id='$checkClientID'");
         $name=mysqli_fetch_array($authSQL);
     ?>
            <tr >
        <td style="border-bottom: 1px solid black;">
            <textarea rows="7" cols="45" style=" background-color: #CCC; border: none; border-radius: 1em; "><?php echo $post['post']." ";?></textarea>
                BY:<?php echo" <font color='red'>".$name['surname']." </font>|";?> DATE and TIME:<?php echo"<font color='red'>". $post['date']." </font>";?> | <?php echo"<font color='red'>". $post['time']."</font>";?>
        </td>
    </tr>
     <?php } }else{
         echo "<center><font color='red' size='10px'>no news update</font></center>";
     }?>
</table>
    </body>
</html>
