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
        $id = $_GET['thredid'];
        $sql = "SELECT * FROM `threds` WHERE thred_id=$id";   
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thred_title'];
            $desc = $row['thred_desc'];
            $thred_user_id = $row['thred_user_id'];

            // Query The users table to find out the name of OriginamPoster
            $sql2 = "SELECT user_name FROM `users` WHERE user_id='$thred_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_name'];
        }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            // Insert comment into db
            $comment = $_POST['comment'];
            $comment = str_replace("<",  "&lt;", $comment);
            $comment = str_replace("<",  "&gt;", $comment);
            $sno = $_POST['sno'];

            $sql = "INSERT INTO `comments` ( `comment_content`, `thred_id`, `comment_by`, `timestamp`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
        if($showAlert){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Comment Has Been Added!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    ?>

    <div class="container my-3">
        <div class="alert alert-dark">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="text-secondary"><?php echo $desc;?></p>
            <hr class="my-4">
            <p class="text-secondary"> <b>Forum Rules:- </b>No Spam / Advertising / Self-promote in the forums. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p class="test-dark"><b>Posted By: <?php echo $posted_by;?></b></p>
        </div>
    </div>
    <div class="container" id="ques">
        <h2 class="py-2">Discussion</h2>

        <?php 
        if (isset($_SESSION['loggdin']) && isset($_SESSION['loggdin']) == true) {
            echo '<div class="container">
                <h3 class="py-2">Post a Comment</h3>
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Type Your Comment</label>
                          <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                          <input type="hidden" name="sno" value="'.$_SESSION['id'].'">
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

        <?php
            // SELECT * FROM `categorys` WHERE cactogry_id=4
            $id = $_GET['thredid'];
            $sql = "SELECT * FROM `comments` WHERE thred_id=$id";
            $result = mysqli_query($conn, $sql);
            $noRes = true;
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['comment_id'];
                $title = $row['comment_content'];
                $time = $row['timestamp'];
                $thred_id = $row['comment_by'];
                $noRes = false;
                $sql2 = "SELECT user_name FROM `users` WHERE user_id='$thred_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);  

                echo '
                <div class="card border-0 mb-3">
                    <div class="row g-0">
                        <div class="col-md-4" style="width: fit-content!important;">
                            <img src="img/user.png" width="34px" alt="user">
                        </div>
                        <div class="col-md-8" style="padding: 0 10px!important; width: auto;">
                            <div class="card-body">
                            <b> '.$row2['user_name'].' at: </b> '. $time .'
                            <p> '.$title.' </p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            if($noRes){
                echo '
                <div class="alert alert-dark" role="alert">
                    <p class="display-5">No Comment Found</p>
                    <p class="lead">Aww yeah, You Can Be The First Person to Comment On This Quistion.</p>
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