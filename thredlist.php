<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>iDiscuss - Coding Forum</title>
    <style>
    #ques {
        min-height: 40vh;
    }
    </style>
</head>

<body>
    <?php
      include 'parcials/_header.php';
      include 'parcials/_dbconnect.php';
    ?>

    <?php
        // SELECT * FROM `categorys` WHERE cactogry_id=4
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categorys` WHERE cactogry_id=$id";   
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['cactogry_name'];
            $catdesc = $row['cactogry_description'];
        }
    ?>
    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            // insert thred into db 
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            
            $th_title = str_replace("<",  "&lt;", $th_title);
            $th_title = str_replace("<",  "&gt;", $th_title);

            $th_desc = str_replace("<",  "&lt;", $th_desc);
            $th_desc = str_replace("<",  "&gt;", $th_desc);
            $sno = $_SESSION['id'];
            $sql = "INSERT INTO `threds` (`thred_title`, `thred_desc`, `thred_cat_id`, `thred_user_id`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp());";   
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
        if($showAlert){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Post Has Been Added Pleas Wait Till anybody Reply .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    ?>

    <div class="container my-3">
        <div class="alert alert-dark">
            <h1 class="display-4">Welcome To <?php echo $catname;?> Forums.</h1>
            <pre class="text-secondary"> Forum Rules:-
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions. 
                Remain respectful of other members at all times.</pre>
            <hr class="my-4">
            <!-- <p class="text-secondary">This forum is for sharing knowledge with each others</p> -->
            <p class="text-secondary"><?php echo substr($catdesc, 0, 250).'...';?></p>
        </div>
    </div>
    <?php
    if (isset($_SESSION['loggdin']) && isset($_SESSION['loggdin']) == true) {
        echo '<div class="container">
            <h3 class="py-2">Start a Discussion</h3>
            <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <div class="mb-3">
                        <label for="title" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Problem Title">
                        <small id="emailHelp" class="form-text text-muted">keep yout title as crisp and short
                            as possible</small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label for="desc" class="form-label">Elleborate Your Problem</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>';
    }
    else{
        echo '
        <div class="container">
            <h4 class="py-2 lead">You Are Not Logged In please login To Start a Discussion...</h4>
        </div>
        ';
    }
    ?>
    <div class="container" id="ques">
        <h2 class="py-2">Browse Questions</h2>

        <?php
            // SELECT * FROM `categorys` WHERE cactogry_id=4
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threds` WHERE thred_cat_id=$id";
            $result = mysqli_query($conn, $sql);
            $noRes = true;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['thred_id'];
                $title = $row['thred_title'];
                $desc = $row['thred_desc'];
                $time = $row['timestamp'];
                $noRes = false;
                
                echo '
                <div class="card border-0 mb-3">
                    <div class="row g-0">
                        <div class="col-md-4" style="width: fit-content!important;">
                            <img src="img/user.png" width="34px" alt="user">
                        </div>
                        <div class="col-md-8" style="padding: 0 10px!important; width: auto;">
                            <div class="card-body">
                                <h5 class="card-title"> <a class="navbar-brand" href="thred.php?thredid=' .$id. '">'.$title.'</a></h5>
                                <p class="card-text">'.substr($desc, 0, 250).'...</p>
                                <small class="text-muted">Last updated on '.$time.'s ago.</small>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            if($noRes){
                echo '
                
                <div class="alert alert-dark" role="alert">
                    <p class="display-5">No Question Found</p>
                    <p class="lead">Aww yeah, You Can Be The First Person to Ask a question.</p>
                </div>
                ';
            }
        ?>

    </div>

    <?php include 'parcials/_footer.php'?>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>

</html>