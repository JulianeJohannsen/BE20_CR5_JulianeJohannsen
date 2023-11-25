<?php
    session_start();

    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        header("Location: /BE20_CR5_JulianeJohannsen/index.php");
    }
    
    require_once '../components/db_connect.php';
    require_once '../components/navbar.php';
    require_once '../components/clean.php';

    $emailError = "";
    $passError = "";

    if(isset($_POST["login"])){
        $email = clean($_POST["email"]);
        $pass = clean($_POST["pass"]);

        $error = false;

        if(empty($email)){
            $error = true;
            $emailError = "Email cannot be empty.";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $emailError = "Email has the wrong format.";
        }

        if(empty($pass)){
            $error = true;
            $passError = "Password cannot be empty.";
        }

        if(!$error){
            $pass = hash("sha256", $pass);

            $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `pass` = '$pass'";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                if($row["status"] === "user"){
                    $_SESSION["user"] = $row["id"];
                    header("Location: /BE20_CR5_JulianeJohannsen/index.php");
                } elseif($row["status"] === "adm"){
                    $_SESSION["adm"] = $row["id"];
                    header("Location: /BE20_CR5_JulianeJohannsen/index.php");
                }
            }
            else{
                echo "
                <div class='alert alert-danger mb-0' role='alert'>
                    Either Username or password is wrong!
                </div>";
            }
        }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta  charset="UTF-8">
   <meta name="viewport" content= "width=device-width, initial-scale=1.0">
   <title>Register new user</title>
   <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"  crossorigin="anonymous">
   <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?= $navbar?>
    <div class="container mt-5">
       <h2>Login</h2>
       <form method="POST" enctype= "multipart/form-data">       
            <div class="mb-3 mt-3">
               <label for="email" class= "form-label">Email:</label>
               <input  type="email" class="form-control" id="email" name="email">
               <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3 mt-3">
               <label for="pass" class= "form-label">Password:</label>
               <input  type="password" class="form-control" id="pass" name="pass">
               <span class="text-danger"><?= $passError ?></span>
            </div>                
            <button name="login" type="submit" class="btn btn-primary">Login</button>
        </form>
        <br>
        <table class="table" style="width:300px">
            <thead>
                <tr>
                <th scope="col">Status</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">adm</th>
                <td>jane@email.com</td>
                <td>123123</td>
                </tr>
                <tr>
                <th scope="row">user</th>
                <td>john@email.com</td>
                <td>123123</td>
                </tr>
            </tbody>
        </table>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>