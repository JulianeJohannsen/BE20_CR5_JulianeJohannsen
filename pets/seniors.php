<?php
    session_start();

    require_once "../components/db_connect.php";
    require_once "../components/navbar.php";

    $sql = "SELECT * FROM `animals` WHERE `age` > 8";    
    $result = mysqli_query($connect, $sql);

    $cards = "";

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            if(isset($_SESSION["adm"])){
                $cards .= "
                <div class='p-2'>
                    <div class='card bg-warning-subtle'>
                        <img src='../pictures/{$row["picture"]}' class='card-img-top'  alt='...' >
                        <div class= 'card-body text-center'>
                            <h5 class='card-title'>{$row["name"]}</h5>
                            <p class='card-text'>{$row["species"]}</p>
                            <p class='card-text'>Age: {$row["age"]}</p>
                            <div class='d-flex justify-content-around'>
                                <a href='/BE20_CR5_JulianeJohannsen/pets/details.php?id={$row["id"]}' class='btn btn-success'>Details</a>
                                <a href='/BE20_CR5_JulianeJohannsen/pets/update.php?id={$row["id"]}' class='btn btn-success'>Update</a>
                                <a href='/BE20_CR5_JulianeJohannsen/pets/delete.php?id={$row["id"]}' class='btn btn-danger'>Delete</a>
                            </div>
                        </div>
                    </div>
                </div>";
            }else {
                $cards .= "
                <div class='p-2'>
                    <div class='card bg-warning-subtle'>
                        <img src='../pictures/{$row["picture"]}' class='card-img-top'  alt='...' >
                        <div class= 'card-body text-center'>
                            <h5 class='card-title'>{$row["name"]}</h5>
                            <p class='card-text'>{$row["species"]}</p>
                            <p class='card-text'>Age: {$row["age"]}</p>
                            <div class='d-flex justify-content-around'>
                                <a href='/BE20_CR5_JulianeJohannsen/pets/details.php?id={$row["id"]}' class='btn btn-success'>Details</a>
                                <a href='/BE20_CR5_JulianeJohannsen/#.php?id={$row["id"]}' class='btn btn-success'>Adopt</a>
                            </div>
                        </div>
                    </div>
                </div>"; 
            }
            
        }
    } else {
        $cards = "<p>Currently no senior pets available</p>";
    }

    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?= $navbar ?>
    <div class="container mt-5">
        <h2 class="text-center">Our senior pets</h2>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $cards ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>