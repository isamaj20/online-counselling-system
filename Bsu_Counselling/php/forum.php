 <?php
  include 'DBConnect.php';
  ?>
<?php 
 session_start();
// if($_SESSION['client']!="")
// {
  ?>
<html>
    <head>
        <link href="css/design.css" type="text/css" rel="stylesheet">
<!--             <meta http-equiv="refresh" content="<?php// echo $sec?>; URL='<?php// echo $page?>'">-->
             <title>Home | BSU Counselling System</title></head>
    <body>
        <div class="container" style="height: auto;">
                    <div class="title">
                <div class="title2">
                 <div class="logo" style="background-image: url(images/logo.png); background-repeat: no-repeat; background-size: 100% 100%;">
                      
                    </div> 
                    <div class="logo2">
                  BSU STUDENT COUNSELLING
                    </div>
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
                    </div><br>
        
        </div>
    </body>
</html>
<?php
// } else {
//     header('Location:home.php');
// }
 ?>