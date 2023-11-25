<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: /BE20_CR5_JulianeJohannsen/users/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: /BE20_CR5_JulianeJohannsen/index.php");
}

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";
require_once "../components/navbar.php";

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $species = $_POST["species"];
    $breed = $_POST["breed"];
    $status = $_POST["status"];
    $vaccinated = $_POST["vaccinated"];
    $picture = fileUpload($_FILES["picture"], "pet");

    $sql = "INSERT INTO `animals` (name, location, description, size, age, species, breed, status, vaccinated, picture) VALUES ('$name', '$location','$description', '$size', $age, '$species', '$breed', '$status', '$vaccinated', '{$picture[0]}')";
    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success mb-0' role='alert'>
           New pet has been added, {$picture[1]}
         </div>";
        header("refresh: 3; url= /BE20_CR5_JulianeJohannsen/index.php");
    } else {
        echo "<div class='alert alert-danger mb-0' role='alert'>
           error found, {$picture[1]}
         </div>";
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?= $navbar ?>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Add a new pet</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3 mt-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <div class="mb-3 mt-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label" for="size">Size</label>
                <select class="form-select" name="size" id="size">
                    <option value="Very small">Very small</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Big">Big</option>
                    <option value="Very big">Very big</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3 mt-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" class="form-control" id="species" name="species">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" class="form-control" id="breed" name="breed">
            </div>
            <div class="mb-3 mt-3">
                <p class="form-label">Status</p>
                <input type="radio" class="form-check-input" name="status" id="available" value="1" checked>
                <label class="form-check-label" for="available">Available</label>

                <input type="radio" class="form-check-input" name="status" id="adopted" value="0">
                <label class="form-check-label" for="adopted">Adopted</label>
            </div>
            <div class="mb-3 mt-3">
                <p class="form-label">Vaccinated</p>
                <input type="radio" class="form-check-input" name="vaccinated" id="yes" value="1" checked>
                <label class="form-check-label" for="yes">Yes</label>

                <input type="radio" class="form-check-input" name="vaccinated" id="no" value="0">
                <label class="form-check-label" for="no">No</label>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image</label>
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>
            <div class="d-flex justify-content-center">
                <button name="create" type="submit" class="btn btn-success me-4">Add pet</button>
                <a href="/BE20_CR5_JulianeJohannsen/index.php" class="btn btn-warning ms-4">Back home</a>
            </div>
        </form>
    </div>
</body>

</html>