<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $username = $_POST['SignupName'];
    $signupPass = $_POST['SignupPassword'];
    $signupCPass = $_POST['SignupCpassword'];

    // check is username exist
    $existsql = "SELECT * FROM `users` WHERE username = `$username`";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    if ($numRows>0) {
        $showError = "Username Alredy in Use";
    } else{
        if ($signupPass == $signupCPass) {
            $hash = password_hash($signupPass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_password`, `timestamp`) VALUES ('$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                header("Location: /forum/index.php?signupsucess=true");
                exit();
            }
        }else{
            $showError = "Passwords do not match";
        }
    }
    header("Location: /forum/index.php?signupsucess=fase&error=$showError");
}

?>