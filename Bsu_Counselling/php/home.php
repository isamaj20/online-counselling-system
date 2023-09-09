<?php
ob_start();
require 'DBConnect.php';
session_start();
$msg1 = "";                                           //comment: user Login section
if (isset($_POST['login']) != "") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //echo $username;
    if ($password != "" && $username != "") {
        $check0 = mysqli_query($mysqli, "select * from users where password='$password'");
        $details0 = mysqli_fetch_array($check0);
        if (($details0['password'] == $password) && ($details0['username'] == $username)) {
            if ($details0['role'] == "admin") {
                session_start();
                $_SESSION['admin'] = $details0['id'];
                $_SESSION['role'] = $details0['role'];
                header('Location:addCounsellor.php');
            } else {
                $user_id = $details0['id'];
                $check1 = mysqli_query($mysqli, "select * from counsellors where staff_id='$user_id'");
                $details2 = mysqli_fetch_array($check1);
                $count = mysqli_num_rows($check1);
                if ($count >= 1) {
                    session_start();
                    $counsellorID = $details2['staff_id'];
                    $stmt = mysqli_query($mysqli, "update counsellors set status='online' where staff_id='$counsellorID'");
                    $_SESSION['staff'] = $counsellorID;
                    $_SESSION['role'] = $details0['role'];
                    header('Location:counsellorHome.php');
                } else if ($count < 1) {//                $user_id=$details0['id'];
                    $check3 = mysqli_query($mysqli, "select * from clients where matNo='$user_id'");
                    $details3 = mysqli_fetch_array($check3);
                    session_start();
                    $clientID = $details3['matNo'];
                    $stmt = mysqli_query($mysqli, "update clients set status='online' where matNo='$clientID'");
                    $_SESSION['client'] = $clientID;
                    $_SESSION['role'] = $details0['role'];
                    header('Location:clientHome.php');
                } else {
                    $msg1 = "user does not exist";
                }
            }
        } else {
            $msg1 = "invalid username/password ";
        }
    } else {
        $msg1 = "all fields are required";
    }
}
?>
<html>
<?php include 'header.php'; ?>
<div class="sec" style="background-color: whitesmoke; text-shadow: none;">
    <div class="problem">
        <div class="problemPic" style="background: url(../images/needHelp.jpg); background-size: 100% 100%;"></div>
        <br>
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
        Are you a counsellor or client? LOGIN or <a href="reg.php">..<u>SIGN UP</u>..</a> to get Started
        <form method="POST">
            <table style="text-shadow: none; width: 100%;" border="0">
                <!--                            <tr>
                                                <th>
                                                    <font color="wheat">  Not New Here? <br>Login to Continue</font>
                                                </th>
                                            </tr>-->
                <tr>
                    <th style="font-style:  initial; color: red; font-size: large;">
                        <?php echo $msg1; ?>
                    </th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="username" placeholder="username" required="required" id="us"
                               style="width:48%; height:35px;">
                        <input type="password" name="password" placeholder="password" required="required"
                               style="width:48%; height:35px;">
                    </td>
                </tr>
                <tr>
                    <th>
                        <input id="log" style="color:white; width:auto; padding: 5px; background-color: brown;"
                               type="submit" name="login" Value="Login">
                    </th>
                </tr>
            </table>
            <br> New counsellor? Click <a href="user.php"><u>HERE</u></a>
        </form>
    </div>
    <?php
    include 'contactUs.php';
    include 'about.php';
    include 'services.php';
    ?>
    <div class="indexMid">
        <div class="talk2Sum1">
            <center>Talk to someone</center>
        </div>
        If you want to talk to someone about a relationship and get some support, there are different ways that you can
        contact one of our counsellors.
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
    <div class="confused">
    </div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
