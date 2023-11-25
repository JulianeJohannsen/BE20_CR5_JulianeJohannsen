<?php
    session_start();

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){ 
        header("Location: /BE20_CR5_JulianeJohannsen/user/login.php");
    }
  
    if(isset($_SESSION["user"])){
        header("Location: /BE20_CR5_JulianeJohannsen/.indexphp");
    }

    require_once "../db_connect.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM `animals` WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row["picture"] != "pet.jpg"){ 
        unlink("../pictures/$row[picture]");
    }
    
    $delete = "DELETE FROM `animals` WHERE id = $id";

    if(mysqli_query($connect, $delete)){
        echo "
            <div class='alert alert-success mb-0' role='alert'>
                Deleted!
            </div>";
        header("Location: index.php");
    }else {
        echo "
        <div class='alert alert-danger mb-0' role='alert'>
            Something went wrong!
        </div>";
    }
    
    mysqli_close($connect);