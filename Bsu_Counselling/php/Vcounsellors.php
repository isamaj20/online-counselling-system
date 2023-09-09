 <?php
   ob_start();
  include 'DBConnect.php';
  ?>
<?php 
 session_start();
 if($_SESSION['client']!="" && $_SESSION['role']=="client")
 {
     $ava="";
  ?>
<html>
    <?php include 'header_client.php';?><br>
                    <?php
                     $clientID=$_SESSION['client'];
                     $stmt= mysqli_query($mysqli,"select * from counsel_session where clientID='$clientID'");
                    $count= mysqli_num_rows($stmt);
                    if($count<1)
                    {
                     ?>
                <table border="0" style="height:auto; text-shadow:none; width:100%; background-color:  #CCC; color:  #333;padding-left:10px;  border-radius: 0em 0.5em 0em 0em;" cellspacing="5" cellpadding="5">
               <tr>
                        <th style="border-bottom: 1px dashed #663300;">
                            <font color="white">BSU STUDENT COUNSELLING</font> | COUNSELLORS' PROFILE
                        </th>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px dashed #663300;">
                            AVAILABLE COUNSELLORS
                        </th>
                    </tr>
                <?php 
                     $qry=  mysqli_query($mysqli," SELECT * from counsellors where status='online'");
                     $cnt=mysqli_num_rows($qry);
                     if($cnt>0)
                     {
                     while($result=  mysqli_fetch_array($qry))
                     {
                     
                     echo"<tr>";
                     echo "<td>";
                       echo 'Name:  <font size="18px">'.$result['surname'].", ".$result['fName']." ".$result['mName'];
                       echo"</td>";
                       echo '<td rowspan="3">';
                        echo '<img src="'.$result['image'].'" height="250" width="250" alt="counsellor\'s image">';
                        echo "</td>";
                   echo "</tr>";
                   echo "<tr>";
                      echo"<td> ";
                          echo "Gender:".$result['sex'];
                       echo"</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td>";
                         echo 'About:<br><textarea rows="10" cols="60" style="background-color: #EEE;border-radius: 0.5em">'.$result['specialty'].'</textarea>';
                      echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                       echo ' <td align="center" style="border-bottom:1px dashed #333;">';
                           echo '<a href="ClientMessage.php?counsellorID='.$result['staff_id'].' "style="color: #000; border:1px groove black; text-decoration:none; background-color:brown;">SELECT</a>';
                        echo "</td>";
                    echo "</tr>";
                      }
                     }else{
                        $ava= "sorry, no counsellor is available at the moment.";
                     }
                ?>
        </table>
       <?php
                    }else{
                        echo "You have an active session with a counsellor, please click back to CONTINUE or TERMINATE session.";
                        ?>
                    <a href="clientHome.php" style="color: green;">BACK</a>
                    <?php
                    }
        ?>
                    <div id="pop">
                        <button id="close" onclick="document.getElementById('pop').style.display='none'">X</button>
                        <div id="tab">
                            <div id="tab1" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>UNIVERSITY ADDRESS</th>
                            </tr>
                            <tr>
                                <td>Km 1, Gboko Road, Makurdi, Benue State, Nigeria.</td>  
                            </tr>
                            <tr>
                                <td><b>Tel:</b> +234 - 7033326160 </td>
                            </tr>
                            <tr>
                                <td><b>Email:</b> info@bsum.edu.ng </td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab2" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>ICT DIRECTORATE</th>
                            </tr>
                            <tr>
                                <td>Tel: +234 - 7032163353</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b>directorict@bsum.edu.ng</td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab3" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>ACADEMIC OFFICER</th>
                            </tr>
                            <tr>
                                <td>Tel: +234 - 8154975559</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b>academicofficer@bsum.edu.ng</td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab4">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>SPECIAL ASSISTANT TO THE VC</th>
                            </tr>
                            <tr>
                                <td>Tel:+234 - 8035972825</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b> vicechancellor@bsum.edu.ng</td>
                            </tr>
                        </table>
                        </div>
                        </div>
                        <div id="tabl">
                           <div id="tab11" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>VC'S PROTOCOL OFFICER</th>
                            </tr>
                            <tr>
                                <td><b>Tel:</b>  +234 - 8034128580</td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab22" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>THE REGISTRAR'S SECRETARY</th>
                            </tr>
                            <tr>
                                <td>Tel: +234 - 8036761864</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b>registrar@bsum.edu.ng</td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab33" style="border-bottom:10px solid white;">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>THE UNIVERSITY PRO</th>
                            </tr>
                            <tr>
                                <td>Tel: +234 - 7033326160</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b>info@bsum.edu.ng</td>
                            </tr>
                        </table>
                            </div>
                            <div id="tab44">
                        <table border="0" cellpadding="2" cellspacing="5">
                            <tr>
                                <th>THE BURSAR</th>
                            </tr>
                            <tr>
                                <td>Tel:+234 - 8036941821</td>  
                            </tr>
                            <tr>
                                <td><b>Email:</b>bursar@bsum.edu.ng</td>
                            </tr>
                        </table>
                        </div> 
                        </div >
                    </div>
                    <div id="about">
                    <button id="closeABT" onclick="document.getElementById('about').style.display='none'">X</button>
                    <div id="tabABT" style="padding: 10px; text-shadow:none;">
                        <div style="background-color: #333;"><center><font color='white'>About</font></center></div><br>
                    BSU student online counselling is an online counseling and emotional 
                    support platform designed to foster academic and personal social problems.
                    It anonymously connects you with the right expert consisting of counselors, life coaches and people with rich and deep life experience, who understand 
                    you and guide you through completely
                    confidential individual sessions (through online chats).
                    Through personalized guidance, our Experts can help you in your<p>
                    i.	Academic and study problems.<br>
                    ii.	Personal – social problems.<br>
                    iii.	Vocational problems.<br>
                    iv.	Family, Marital and sex related relationship problems.<br>
                    v.	Financial problems.<br>
                    vi.	Adjustment problems.<br>
                    vii.	Emotional problems and<br>
                    viii.	Religious problems.</p>

                    <div style="background-color: #333;"><center><font color='white'>Aim and Objectives</font></center></div><br>
               The followings are the objectives of this online system:<br>
               i.	to give give client direct access to specific and required information that will help the clientt.<br>
               ii.	Be a system that will help clientt in information referencing for quick decision taking.<br>
               iii.	A system that will  help cclients to have direct access to previous discussion between a cclient and a counselor

                    </div>
                   </div>
                    <div id="services">
                    <button id="closeServices" onclick="document.getElementById('about').style.display='none'">X</button>
                    <div id="tabSERV" style="padding: 10px; text-shadow:none;">
                        <div style="background-color: #333; width:90%;"><center><font color='white'>SERVICES</font></center></div><br>
                    BSU online student counselling offers the following services among others:<br><br>
                    <div style="float: left;">
                    <div style="height: 20%; width: 50%; border:1px dashed white; padding: 10px; border-radius: 1em 1em 0em 0em; ">
                 <div style="background-color: #333; width:100%;border-radius: 0em 1em 0em 0em;"><font color='white'>Individual Counselling</font></div>
                  This online system offer client an expert support from a relate counsellor through completely
                  confidential individual sessions by sending messages online (through online chats).<br>
                    </div>
                     <div style="height: 20%; width: 50%; border:1px dashed white; padding: 10px;">
                  <div style="background-color: #333; width:100%;"><font color='white'>Group Counselling</font></div>
                  This system also provides an online forum where client can get support from our counsellors and other clients on related issues. <br>
                     </div>
                     <div style="height: 20%; width: 50%; border:1px dashed white; padding: 10px;">
                  <div style="background-color: #333; width:100%;"><font color='white'>Client-Counsellor management</font></div>
                  the system manages clients and thier counsellor by keeping track of thier login, status, and making sure a client gets one available counsellor per session.
                  The counsellor as well can get as many clients as he/she can handle and the system keeps track of all of these counsellor's clients.
                    </div>
                    </div>
                   </div>
                   </div>
                    <?php echo"<font color='red'>". $ava."</font>";?>
        </div>
    </body>
</html>
<?php
 } else {
     header('Location:home.php');
 }
