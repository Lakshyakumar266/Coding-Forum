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
</head>

<body>
    <?php
      include 'parcials/_header.php';
      include 'parcials/_dbconnect.php';
    ?>
    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/700x600/?Coding,coding" class="d-block w-100" height="450px"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/crasul-2.jpg" class="d-block w-100 " height="450px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/crawsel-3.jpg" class="d-block w-100 " height="450px" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <div class="container my-3">
        <h2 class="text-center my-4">iDiscuss - Browse Categoryies</h2>

        <!-- catogry container starts hear  -->
        <div class="row">
            <?php
                $sql = "SELECT * FROM `categorys`";   
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['cactogry_id'];
                    $cat = $row['cactogry_name'];
                    $desc = $row['cactogry_description'];
                    echo '
                        <div class="col-md-4 my-2">
                        <div class="card " style="width: 18rem;">
                            <img src="https://source.unsplash.com/600x400/?Coding,'.$cat.'code" class="card-img-top"
                                alt="image">
                            <div class="card-body">
                            <h5 class="card-title"><a class="navbar-brand" href="thredlist.php?catid='. $id .'">'.$cat.'</a></h5>
                                <p class="card-text">'.substr($desc, 0, 60).'...</p>
                                <a href="thredlist.php?catid='. $id .'" class="btn btn-primary">View Threads</a>
                            </div>
                        </div>
                    </div>';
                }
            ?>

        </div>
    </div>

    <?php include 'parcials/_footer.php'?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>

</html>