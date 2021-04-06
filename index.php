<?php
// Missing session_start()
session_start();
require('includes/application_top.php');
$error = "";
$page_title='Login!';
if(isset($_SESSION['uniqueId']))   
// Checking whether the session is already there or not if 
// true then header redirect it to the home page directly 
 {
    header("Location:index.php"); 
 }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($freshKickz_conn, $_POST['username']);
    $mypassword = mysqli_real_escape_string($freshKickz_conn, $_POST['password']);
    $_SESSION['uniqueId'] = $myusername;
    $sql = "SELECT fName FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result =mysqli_query($freshKickz_conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $activate = $row['active'];

    $count = mysqli_num_rows($result);

    if($count == 1) {
         header("location: index.php");
    } else {
     $error = "Your Cedentails were Incorrect";
}

}
require('includes/site_header.php');
?>

<style>
<?php
require('css/login.css');
?>
</style>

<br>
<br>
<br>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                            <!-- Icon -->
                    <div class="fadeIn first">
                      <br>
                      <h3> Login! </h3>
                    </div>
                    <br>
                    <!-- Login Form -->
                    <form id="login_form" action="" method="post">
                      <input type="text" class="fadeIn second" id="username" name="username" placeholder="Username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" maxlength="100" />
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" />
                      <input type="submit" class="fadeIn fourth" name="action" value="Login"/>
                    </form>
                     <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                    <!-- Remind Passowrd -->
                    <div id="formFooter">
                      <a class="underlineHover" href="#">Forgot Password?</a>
                    </div>
                   
                 </div>
            </div>
        </div>
        <?= $_SESSION['uniqueId']?>
<?php
require('includes/application_bottom.php');
require('includes/site_footer.php');
?>