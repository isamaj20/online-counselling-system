<?php 
 ob_start();
?>
<?php
 session_start();
 ?>
<html>
    <head>
        <link href="../css/design.css" type="text/css" rel="stylesheet">
<!--             <meta http-equiv="refresh" content="<?php// echo $sec?>; URL='<?php// echo $page?>'">-->
             <title>Home | BSU Counselling System</title>
                          <style>
                 #pop{
                     text-shadow:none;
                     margin: 0 auto;
                     height:65%;;
                     width:77.8%;
                     bottom: 50%;
                     right: 10.5%;
                     top: 27%;
                     position: fixed;
                     padding: 10px;
/*                     border:1px dashed;*/
                     visibility: hidden;
                     background-color:white;
                     border-radius: 0em;
                     box-shadow: 5px 5px 5px  dimgray;
                 }
                 #tab{
                     background-color:  lightgrey;
                     width: 48%;
                     border-radius: 1em 0em 0em 0em;
                     float: left;
                     box-shadow: -5px 0px 5px  dimgray;
                 }
                 #tab table{
                     width: 99%;
                   
                 }
                 #tab table th{
                     background-color:lightblue;
                       color:white;
                 }
                 #tabl{
                     background-color:  lightgrey;
                     width: 50%;
                     border-radius: 0em 1em 0em 0em;
                     float: right;
                 }
                 #tabl table{
                     width: 99%;
                   
                 }
                 #tabl table th{
                     background-color:lightblue;
                       color:white;
                       padding-bottom: 10px;
                 }
                 #close{
                     right: 0px;
                     top: 0px;
                     float: right;
                     background-color:brown;
                 }
                  #about{
                     text-shadow:none;
                     margin: 0 auto;
                     height:65%;;
                     width:77.8%;
                     bottom: 50%;
                     right: 10.5%;
                     top: 27%;
                     position: fixed;
                     padding: 10px;
/*                     border:1px dashed;*/
                     visibility: hidden;
                     background-color:white;
                     border-radius: 0em;
                     box-shadow: -5px 5px 5px  dimgray;
                 }
                 #tabABT{
                     background-color:  lightgrey;
                     width: 95%;
                     border-radius: 1em 0em 0em 0em;
                     float: left;
                     font-size: 16px;
/*                     box-shadow: -5px 0px 5px  dimgray;*/
                 }
                 #closeABT{
                     right: 0px;
                     top: 0px;
                     float: right;
                     background-color:brown;
                 }
                 #services{
                     text-shadow:none;
                     margin: 0 auto;
                     height:65%;;
                     width:77.8%;
                     bottom: 50%;
                     right: 10.5%;
                     top: 27%;
                     position: fixed;
                     padding: 10px;
/*                     border:1px dashed;*/
                     visibility: hidden;
                     background-color:white;
                     border-radius: 0em;
                     box-shadow: -5px 5px 5px  dimgray;
                 }
                 #tabSERV{
                     background-color:  lightgrey;
                     width: 95%;
                     border-radius: 1em 0em 0em 0em;
                     float: left;
                     font-size: 16px;
/*                     box-shadow: -5px 0px 5px  dimgray;*/
                 }
                 #closeServices{
                     right: 0px;
                     top: 0px;
                     float: right;
                     background-color:brown;
                 }
             </style>
 <script language="JavaScript" type="text/javascript">
function popup(showhide){
if(showhide == "show"){
    document.getElementById('pop').style.visibility="visible";
    document.getElementById('pop').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('pop').style.visibility="hidden"; 
}
}
function about(showhide){
if(showhide == "show"){
    document.getElementById('about').style.visibility="visible";
    document.getElementById('about').style.display="block";
}else if(showhide == "hide"){
    document.getElementById('about').style.visibility="hidden"; 
}
}
</script>       
    </head>
    <body onload="document.getElementById('surnm').focus();">
        <div class="container">
            <div class="title">
                <div class="title2" >
                    <div class="logo" style="background-image: url(../images/logo.png); background-repeat: no-repeat; background-size: 100% 100%;">
                    </div> 
                    <div class="logo2">
                  Benue State University, Makurdi
                    </div>
                    <font size="11" color="grey">Student Counseling</font>
                 </div>
                <div class="home">
                <ul>
                     <li>
                         <a href="index.php">HOME</a>
                     </li>
                     <li>
                         <a href="#" onmouseover="document.getElementById('services').style.visibility='visible';" onmouseout="document.getElementById('services').style.visibility='hidden';">SERVICES</a>
                     </li>
                     <li>
                         <a href="javascript:popup('show');" onmouseover="document.getElementById('pop').style.visibility='visible';" onmouseout="document.getElementById('pop').style.visibility='hidden';">CONTACT</a>
                     </li>
                     <li>
                         <a href="javascript:about('show');" onmouseover="document.getElementById('about').style.visibility='visible';" onmouseout="document.getElementById('about').style.visibility='hidden';">ABOUT US</a>
                     </li>
                 </ul>
                </div>
            </div>
            <div class="sec" style="background-color: whitesmoke; text-shadow: none;">
                <div class="problem">
                    <div class="problemPic" style="background: url(../images/needHelp.jpg); background-size: 100% 100%;"></div><br>
                    What's worrying you?
                    <ul>
                        <li>
                            <a href="">Abuse</a>
                        </li>
                        <li>
                            <a href="home.php">Depression</a>
                        </li>
                        <li>
                            <a href="home.php">Relationship Issues</a>
                        </li>
                        <li>
                            <a href="home.php">Academic Issues</a>
                        </li>
                    </ul>
                    <div class="problemMore">
                        <a href="home.php" style="float: right; padding-right: 10px;">More . . .</a>
                    </div>
                </div>
               <div class="clickLogin">
                   Are you a Counsellor or Client? <a href="home.php" >..<u>LOGIN</u>..</a> or <a href="home.php">..<u>SIGN UP</u>..</a><br>  to get Started
                </div> 
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
                <div class="indexMid" >
                    <div class="talk2Sum1"> <center>Talk to someone</center></div>
                    If you want to talk to someone about a relationship and get some support, there are different ways that you can contact one of our counsellors.
                    <div class="liveChat">
                        <a href="home.php">Live Chat with a counsellor</a><br>
                    You can talk to one of our counsellors live online. Live chat lets you send messages in real time.
                    </div>
                    <br>
                    <div class="messageCounsellor">
                        <a href="home.php">Message a Counsellor</a><br>
                    Get expert support from a Relate counsellor by sending messages online.
                    </div>
                    <br>
                    <div class="forum">
                        <a href="home.php">Group Counselling</a><br>
                        Get support from our counsellors and other clients on related issues. 
                    </div>
                    
                </div>
                <div class="confused" style="background: url(../images/counselling3.png); background-repeat: no-repeat;background-size: 100% 100%;">
                Not Sure Where to Start? Click any link on this Page.
                </div>
             </div>
        </div>
        <div class="foot">
            <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy;copyright 2016. BSU Student Counselling System by Isama John Adeyi, Mathematics/Computer Sci Dept</center>
        </div>
    </body>
</html>
