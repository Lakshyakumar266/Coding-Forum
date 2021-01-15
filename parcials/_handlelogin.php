<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $name = $_POST['loginname'];
    $pass = $_POST['loginpass'];

    // check is username exist
    $sql = "SELECT * FROM users WHERE user_name='$name'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows==1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_password'])) {
            session_start();
            $_SESSION['loggdin'] = true;
            $_SESSION['username'] = $name;
            $_SESSION['id'] = $row['user_id'];
            echo "loggd in ".$name;
            header("Location: /forum/index.php");
        }else{
            header("Location: /forum/index.php?login=false");
        }
    }else{
        header("Location: /forum/index.php?login=false");
    }
}

?>