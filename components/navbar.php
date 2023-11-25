<?php
$navbar = "
<nav class='navbar navbar-expand-lg bg-warning-subtle'>
    <div class='container-fluid'>";
        if(isset($_SESSION["user"])){
            $sql = "SELECT * FROM `user` WHERE `id` = $_SESSION[user]";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $navbar .= "           
            <a class='navbar-brand' href='#'>
            <img src='/BE20_CR5_JulianeJohannsen/pictures/$row[picture]' alt='Profile picture' width='50' height='50' class='d-inline-block align-text-center' id='profilePic'>
            Hi $row[first_name]
            </a>      
            ";
        }elseif(isset($_SESSION["adm"])){
            $sql = "SELECT * FROM `user` WHERE `id` = $_SESSION[adm]";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            $navbar .= "           
            <a class='navbar-brand' href='#'>
            <img src='/BE20_CR5_JulianeJohannsen/pictures/$row[picture]' alt='Profile picture' width='50' height='50' class='d-inline-block align-text-center' id='profilePic'>
            Hi $row[first_name]
            </a>      
            ";
        }else {
            $navbar .=
        "<a class='navbar-brand' href='/BE20_CR5_JulianeJohannsen/index.php'>MyPet</a>";
        }
        $navbar .= "
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='/BE20_CR5_JulianeJohannsen/index.php'>Home</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/pets/seniors.php'>Senior pets</a>
            </li>";
        if(isset($_SESSION["adm"])){
            $navbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/pets/create.php'>New pet</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user_pet/tableadmin.php'>Adoptions</a>
            </li>";
        }
        if(isset($_SESSION["user"])){
            $navbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user_pet/tableuser.php'>Your Adoptions</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user/update.php'>Update Profile</a>
            </li>";
        }
        if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
            $navbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user/register.php'>Register</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user/login.php'>Login</a>
            </li>";
        } else {
            $navbar .= "
            <li class='nav-item'>
                <a class='nav-link' href='/BE20_CR5_JulianeJohannsen/user/logout.php'>Logout</a>
            </li>";
        }

        $navbar .= "
        </ul>
        </div>
    </div>
</nav>
";