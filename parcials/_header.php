<?php

session_start();
include 'parcials/_dbconnect.php';

echo '

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/forum">iDiscuss</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Top Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                        
                        $sql = "SELECT cactogry_name, cactogry_id  FROM `categorys` LIMIT 4";
                        $result = mysqli_query($conn, $sql);
                        $noRes = true;
                        while($row = mysqli_fetch_assoc($result)){
                        echo ' <li><a class="dropdown-item" href="thredlist.php?catid='. $row['cactogry_id'] .'">'.$row['cactogry_name'].'</a></li>';
                        }
                            echo '
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/forum/index.php">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
                    </li>
                </ul>
                ';
                if(isset($_SESSION['loggdin']) && isset($_SESSION['loggdin']) == true){
                    echo '
                    <form class="d-flex" action="search.php" methd="get">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                    <p class="text-light m-auto mx-4">Welcome: '. $_SESSION['username'].'</p>
                    <a href="/forum/parcials/_logout.php" role="button" class="btn btn-outline-success mx-2">LogOut</a>
                ';
                }

                else{
                    echo '
                    <form class="d-flex" action="search.php" methd="get">
                        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>';
                    echo '
                        <div class="mx-2">
                            <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
                            <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>
                        </div>';
                }

echo '</div>
    </div>
    </nav>
';
if (isset($_GET['signupsucess']) && $_GET['signupsucess']=="true") {
    echo '
    <div class=" my-0 alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> You Can LogIn Now.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
    ';
}
if(isset($_GET['error'])){
    $error = $_GET['error'];
    echo '
    <div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Sorry '.$error.'.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
if (isset($_GET['login']) && $_GET['login']=='false') {
    echo '
        <div class=" my-0 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Sorry Worng Password or Username
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    ';
}
include 'parcials/_loginmodal.php';
include 'parcials/_signupmodal.php'; 
?>