<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: /BE20_CR5_JulianeJohannsen/users/login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: /BE20_CR5_JulianeJohannsen/index.php");
}

require_once "../components/db_connect.php";
require_once "../components/navbar.php";

$sql = "SELECT * FROM `user_pet` up JOIN `user` u ON up.fk_user_id = u.id JOIN `animals` a ON up.fk_pet_id = a.id ORDER BY `adopt_date` DESC";
$result = mysqli_query($connect, $sql);

$tableStart = "
<table class='table'>
            <thead>
                <tr>
                    <th scope='col'>Adoption date</th>
                    <th scope='col'>First name user</th>
                    <th scope='col'>Last name user</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Phone</th>
                    <th scope='col'>Pet Name</th>
                    <th scope='col'>Species</th>
                </tr>
            </thead>
            <tbody>";
$table = "";
$tableEnd = "</tbody>
        </table>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $table .= "        
        <tr>
            <td>$row[adopt_date]</td>
            <td>$row[first_name]</td>
            <td>$row[last_name]</td>
            <td>$row[email]</td>
            <td>$row[phone]</td>
            <td>$row[name]</td>
            <td>$row[species]</td>
        </tr>
        ";
    }
}
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
        <?= $tableStart, $table, $tableEnd ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>