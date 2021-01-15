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
    .container {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php
      include 'parcials/_header.php';
      include 'parcials/_dbconnect.php';
    ?>


    <div class="container my-3">
        <h1 class="py-4">Search results for <em>"<?php echo $_GET['search']?>"</em> </h1>


        <?php
            $query = $_GET['search'];
            $sql = "SELECT * FROM `threds` where MATCH (thred_title, thred_desc) against ('$query')";   
            $result = mysqli_query($conn, $sql);
            $nores = true;
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thred_title'];
                $desc = $row['thred_desc'];
                $thred_id = $row['thred_id'];
                $url = "thred.php?thredid=$thred_id";
                $nores = false;

                echo '
                <div class="results">
                    <h3> <a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                    <p>'.$desc.'</p>
                </div>';
            }
            if ($nores) {
                echo '
                <div class="alert alert-dark" role="alert">
                <p class="display-5">No Results Found </p>
                <p class="lead">Suggestions:
                <ul>
               <li> Make sure that all words are spelled correctly.</li>
               <li> Try different keywords.</li>
               <li> Try more general keywords.</li>
                    </ul>
                </p>
            </div>
                ';
            }
        ?>

        <!--<div class="results"> 
                <h3> <a href="/catohghg/jdf" class="text-dark"> cannot install pyaudio </a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae ad eligendi maiores illo aliquam
                commodi quo fugit beatae tempore corporis ducimus sint suscipit labore sapiente ut aliquid magni iure,
                temporibus id impedit quaerat fuga corrupti quisquam. Nihil officia praesentium cupiditate voluptatibus
                illo dolor ipsa nemo commodi assumenda, dolore accusamus dicta, numquam ratione unde quam minima vel
                impedit fugiat eligendi omnis ducimus!</p>
        </div> -->
    </div>

    <?php include 'parcials/_footer.php'?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>

</html>