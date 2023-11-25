<?php
    session_start();

    require_once "../components/db_connect.php";
    require_once "../components/file_upload.php";
    require_once "../components/navbar.php";

    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM `animals` WHERE `id` = $id";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $card = "
        <div class='card detailsCard bg-warning-subtle'>
            <div class='card-body table-responsive'>
                <h3 class='card-title ps-2 pb-2 text-center'>$row[name]</h3>
                <table class='table table-borderless'>  
                    <tr>
                        <td class='bg-warning-subtle'><b>Status:</b></td>" .
                        (($row["status"] == "1")? "<td class='text-success bg-warning-subtle'>Available</td>" : "<td class='text-danger bg-warning-subtle'>Adopted</td>") . "
                    </tr>    
                    <tr>
                        <td class='bg-warning-subtle'><b>Species:</b></td>
                        <td class='bg-warning-subtle'>$row[species]</a></td>
                    </tr>" .
                    (!empty($row["breed"])?
                    "<tr>
                        <td class='bg-warning-subtle'><b>Breed:</b></td>
                        <td class='bg-warning-subtle'>$row[breed]</td>
                    </tr>" : "") .
                    (!empty($row["description"])?
                    "<tr>
                        <td class='bg-warning-subtle'><b>Description:</b></td>
                        <td class='bg-warning-subtle'>$row[description]</td>
                    </tr>" : "") .                  
                    "<tr>
                        <td class='bg-warning-subtle'><b>Age:</b></td>
                        <td class='bg-warning-subtle'>$row[age]</a></td>
                    </tr>
                    <tr>
                        <td class='bg-warning-subtle'><b>Size:</b></td>
                        <td class='bg-warning-subtle'>$row[size]</a></td>
                    </tr>                    
                    <tr>
                        <td class='bg-warning-subtle'><b>Vaccinated:</b></td>" .
                        (($row["vaccinated"] == "1")? "<td class='bg-warning-subtle'>Yes</td>" : "<td class='bg-warning-subtle'>No</td>") . "
                    </tr>
                    <tr>
                        <td class='bg-warning-subtle'><b>Location:</b></td>
                        <td class='bg-warning-subtle'>$row[location]</td>
                    </tr> 
                </table>" . 
                ((isset($_SESSION["user"]) && $row["status"] == "1")? 
                "<div class='d-flex flex-wrap justify-content-center  bg-warning-subtle'>
                    <a href='/BE20_CR5_JulianeJohannsen/user_pet/adopt.php?id=$row[id]' class='btn btn-warning mb-1 me-4'>Adopt</a>
                </div>" :"") . 
                (isset($_SESSION["adm"])? 
                "<div class='d-flex flex-wrap justify-content-center'>
                    <a href='/BE20_CR5_JulianeJohannsen/pets/update.php?id=$row[id]' class='btn btn-warning mb-1 me-4'>Update</a>
                    <a href='/BE20_CR5_JulianeJohannsen/pets/delete.php?id=$row[id]' class='btn btn-danger mb-1 ms-4'>Delete</a>
                </div>" :"") . 
            "</div>
            <img src='../pictures/$row[picture]' class='card-img-bottom object-fit-cover' alt='media-image'>
        </div>
        ";
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

    <div class="container d-flex justify-content-center mt-5 mb-5">
        <?= $card ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>