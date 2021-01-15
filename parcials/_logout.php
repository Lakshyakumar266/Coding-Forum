<?php

session_start();
    echo "Loging You Out Pleas Wait...";

session_destroy();
header("Location: /forum/index.php");

?>