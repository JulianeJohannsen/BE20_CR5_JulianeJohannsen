<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: /BE20_CR5_JulianeJohannsen/users/login.php");
}

require_once "../components/db_connect.php";
require_once "../components/navbar.php";

$sql = "SELECT a.name, a.location, a.description, a.size, a.age, a.species, a.breed, a.vaccinated, a.picture FROM `animals` a JOIN `user_pet` up ON a.id = up.fk_pet_id JOIN `user` u ON up.fk_user_id = u.id WHERE u.id = $_SESSION[user]";
$result = mysqli_query($connect, $sql);
$card = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $card .= "
        <div class='p-2'>
        <div class='card detailsCard bg-warning-subtle'>
            <img src='../pictures/$row[picture]' class='card-img-top object-fit-cover' alt='media-image'>
            <div class='card-body table-responsive'>
                <h3 class='card-title ps-2 pb-2 text-center'>$row[name]</h3>
                <table class='table table-borderless'>  
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
                </table>                 
            </div>
        </div>
        </div>
        ";
    }
} else {
    $card = "<p>No pets adopted yet</p>";
}

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adopted</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
</head>
<body>
<?= $navbar ?>
<div class="container mt-5">
    <?= (mysqli_num_rows($result) === 1)?"<h2 class='text-center'>Your new family member</h2>" : "<h2 class='text-center'>Your new family members</h2>" ?>
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
        <?= $card ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>