<?php
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: /BE20_CR5_JulianeJohannsen/index.php");
    }

    require_once "../components/db_connect.php";
    require_once "../components/navbar.php";
    require_once "../components/clean.php";
    require_once "../components/file_upload.php";

    $id = $_SESSION["user"];
        
    $sql = "SELECT * FROM `user` WHERE `id` = $id";
    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);

    $firstNameError = "";
    $lastNameError = "";
    $zipError = "";
    $cityError = "";
    $streetError = "";
    $phoneError = "";
    $emailError = "";


    if(isset($_POST["update"])){
        $first_name = clean($_POST["first_name"]);
        $last_name = clean($_POST["last_name"]);
        $zip = clean($_POST["zip"]);
        $city = clean($_POST["city"]);
        $street = clean($_POST["street"]);
        $phone = clean($_POST["phone"]);
        $email = clean($_POST["email"]);
        $picture = fileUpload($_FILES["picture"]);

        $error = false;

        if(empty($first_name)){
            $error = true;
            $firstNameError = "First name cannot be empty.";
        } elseif(strlen($first_name) < 3){
            $error = true;
            $firstNameError = "First name must have at least 3 characters.";
        } elseif(!preg_match( "/^[a-zA-Z\s]+$/" , $first_name)){
            $error = true ;
            $firstNameError = "First name must contain only letters and spaces." ;
        }

        if(empty($last_name)){
            $error = true;
            $lastNameError = "Last name cannot be empty.";
        } elseif(strlen($last_name) < 3){
            $error = true;
            $lastNameError = "Last name must have at least 3 characters.";
        } elseif(!preg_match( "/^[a-zA-Z\s]+$/" , $last_name)){
            $error = true ;
            $lastNameError = "Last name must contain only letters and spaces." ;
        }

        if(empty($zip)){
            $error = true;
            $zipError = "ZIP cannot be empty.";
        } elseif(strlen($zip) < 4){
            $error = true;
            $zipError = "ZIP must have at least 4 digits.";
        } elseif(!is_numeric($zip)){
            $error = true ;
            $zipError = "ZIP must contain only numbers." ;
        }

        if(empty($city)){
            $error = true;
            $cityError = "City cannot be empty.";
        } elseif(strlen($city) < 3){
            $error = true;
            $cityError = "City must have at least 3 characters.";
        } elseif(!preg_match( "/^[a-zA-Z\s]+$/" , $city)){
            $error = true ;
            $cityError = "City must contain only letters and spaces." ;
        }

        if(empty($street)){
            $error = true;
            $streetError = "Street cannot be empty.";
        } elseif(strlen($street) < 3){
            $error = true;
            $streetError = "Street must have at least 3 characters.";
        }

        if(empty($phone)){
            $error = true;
            $phoneError = "Phone cannot be empty.";
        } elseif(strlen($phone) < 6){
            $error = true;
            $phoneError = "Phone must have at least 6 digits.";
        }

        if(empty($email)){
            $error = true;
            $emailError = "Email cannot be empty.";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Email has the wrong format.";
        }

        if($error === false){
            if($_FILES["picture"]["error"] == 0){
                if($row["picture"] != "avatar.png"){
                    unlink("../pictures/$row[picture]");
                }
                $sql = "UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone` = '$phone',`zip` = '$zip', `city` = '$city', `street` = '$street', `picture` = '$picture[0]' WHERE `id` = $id";
            }else {
                $sql = "UPDATE `user` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `phone` = '$phone',`zip` = '$zip', `city` = '$city', `street` = '$street' WHERE `id` = $id";
            }
            


            $result = mysqli_query($connect, $sql);

            if($result){
                echo "
            <div class='alert alert-success mb-0' role='alert'>
                User data updated!
            </div>";
            }
            else{
                echo "
                <div class='alert alert-danger mb-0' role='alert'>
                    Something went wrong!
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
    <title>Update Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?= $navbar ?>
    <div class="container mt-5 mb-5">
        <h2 class="text-center">Update your profile</h2>
        <form method="POST" enctype= "multipart/form-data">
            <div class="mb-3 mt-3">
               <label for="first_name" class= "form-label">First name:</label>
               <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $row["first_name"] ?>">
               <span class="text-danger"><?= $firstNameError ?></span>
            </div>
            <div class="mb-3 mt-3">
               <label for="last_name" class= "form-label">Last name:</label>
               <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $row["last_name"] ?>">
               <span class="text-danger"><?= $lastNameError ?></span>
            </div>
            <div class="mb-1 mt-3 d-flex justify-content-between">
                <div>
                    <label for="zip" class= "form-label">ZIP:</label>
                    <input type="number" class="form-control" id="zip" name="zip" value="<?= $row["zip"] ?>">
                    <span class="text-danger"><?= $zipError ?></span>
                </div>
                <div style="width: 80%">
                    <label for="city" class= "form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?= $row["city"] ?>">
                    <span class="text-danger"><?= $cityError ?></span>
                </div> 
            </div>
            <div class="mb-3 mt-3">
               <label for="street" class= "form-label">Street:</label>
               <input  type="text" class="form-control" id="street" name="street" value="<?= $row["street"] ?>">
               <span class="text-danger"><?= $streetError ?></span>
            </div>
            <div class="mb-3 mt-3">
               <label for="phone" class= "form-label">Phone number:</label>
               <input  type="tel" class="form-control" id="phone" name="phone" value="<?= $row["phone"] ?>">
               <span class="text-danger"><?= $phoneError ?></span>
            </div>
            <div class="mb-3 mt-3">
               <label for="email" class= "form-label">Email:</label>
               <input  type="email" class="form-control" id="email" name="email" value="<?= $row["email"] ?>">
               <span class="text-danger"><?= $emailError ?></span>
            </div>           
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture:</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>
            <div class="d-flex justify-content-center">
                <button name="update" type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>