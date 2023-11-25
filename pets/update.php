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

$id = $_GET["id"];

$sql = "SELECT * FROM `animals` WHERE `id` = $id";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
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

    if ($_FILES["picture"]["error"] == 0) {
        if ($row["picture"] != "pet.jpg") {
            unlink("../pictures/$row[picture]");
        }
        $sql = "UPDATE `animals` SET `name` = '$name', `location` = '$location', `description` = '$description', `size` = '$size', `age` = $age, `species` = '$species', `breed` = '$breed', `status` = '$status', `vaccinated` = '$vaccinated', `picture` = '{$picture[0]}' WHERE `id` = $id";
    } else {
        $sql = "UPDATE `animals` SET `name` = '$name', `location` = '$location', `description` = '$description', `size` = '$size', `age` = $age, `species` = '$species', `breed` = '$breed', `status` = '$status', `vaccinated` = '$vaccinated' WHERE `id` = $id";
    }



    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "
            <div class='alert alert-success mb-0' role='alert'>
                User data updated!
            </div>";
    } else {
        echo "
            <div class='alert alert-danger mb-0' role='alert'>
                Something went wrong!
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
        <h2 class="text-center">Update pet</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $row["name"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= $row["location"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= $row["description"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label" for="size">Size</label>
                <select class="form-select" name="size" id="size">
                    <option value="Very small" <?= $row["size"] == "very small" ? "selected" : ""; ?>>Very small</option>
                    <option value="Small" <?= $row["size"] == "small" ? "selected" : ""; ?>>Small</option>
                    <option value="Medium" <?= $row["size"] == "medium" ? "selected" : ""; ?>>Medium</option>
                    <option value="Big" <?= $row["size"] == "big" ? "selected" : ""; ?>>Big</option>
                    <option value="Very big" <?= $row["size"] == "very big" ? "selected" : ""; ?>>Very big</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $row["age"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" class="form-control" id="species" name="species" value="<?= $row["species"] ?>">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed</label>
                <input type="text" class="form-control" id="breed" name="breed" value="<?= $row["breed"] ?>">
            </div>
            <div class="mb-3 mt-3">
                <p class="form-label">Status</p>
                <input type="radio" class="form-check-input" name="status" id="available" value="1" <?= $row["status"] == "1" ? "checked" : ""; ?>>
                <label class="form-check-label" for="available">Available</label>

                <input type="radio" class="form-check-input" name="status" id="adopted" value="0" <?= $row["status"] == "0" ? "checked" : ""; ?>>
                <label class="form-check-label" for="adopted">Adopted</label>
            </div>
            <div class="mb-3 mt-3">
                <p class="form-label">Vaccinated</p>
                <input type="radio" class="form-check-input" name="vaccinated" id="yes" value="1" <?= $row["vaccinated"] == "1" ? "checked" : ""; ?>>
                <label class="form-check-label" for="yes">Yes</label>

                <input type="radio" class="form-check-input" name="vaccinated" id="no" value="0" <?= $row["vaccinated"] == "0" ? "checked" : ""; ?>>
                <label class="form-check-label" for="no">No</label>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image</label>
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>
            <div class="d-flex justify-content-center">
                <button name="update" type="submit" class="btn btn-success me-4">Update pet</button>
                <a href="/BE20_CR5_JulianeJohannsen/index.php" class="btn btn-warning ms-4">Back home</a>
            </div>

        </form>
    </div>
</body>

</html>