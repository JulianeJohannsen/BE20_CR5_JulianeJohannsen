<?php
session_start();

require_once '../components/db_connect.php';
require_once '../components/navbar.php';
require_once '../components/clean.php';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $pet_id = $_GET["id"];
    $pet_sql = "SELECT * FROM `animals` WHERE `id` = $pet_id";
    $pet_result = mysqli_query($connect, $pet_sql);
    $pet_row = mysqli_fetch_assoc($pet_result);

    if (isset($_POST["confirm"])) {
        if (isset($_SESSION["user"])) {
            $user_id = $_SESSION["user"];
            $user_pet_sql = "INSERT INTO `user_pet` (fk_pet_id, fk_user_id) VALUES ($pet_id, $user_id)";
            if (mysqli_query($connect, $user_pet_sql)) {
                $pet_update_sql = "UPDATE `animals` SET `status` = 0 WHERE `id` = $pet_id";
                mysqli_query($connect, $pet_update_sql); 
                echo "
                        <div class='alert alert-success mb-0' role='alert'>
                        You have adopted $pet_row[name]!
                    </div>";
            } else {
                echo "
                        <div class='alert alert-danger mb-0' role='alert'>
                        error found
                    </div>";
            }
        } else {
            echo "
                <div class='alert alert-danger' role='alert'>
                You have to login first.
                </div>";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?= $navbar ?>
    <div class="container mt-5">
        <h2 class="text-center">Do you want to adopt <?= $pet_row["name"] ?>?</h2>
        <img src="<?= "../pictures/$pet_row[picture]" ?>" alt="">
        <form method="POST" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
                <button name="confirm" type="submit" class="btn btn-success me-4">Adopt</button>
                <a href="/BE20_CR5_JulianeJohannsen/index.php" class="btn btn-danger ms-4">Back</a>
            </div>

        </form>
    </div>
</body>

</html>