<?php
    session_start();

    unset($_SESSION["user"]);
    unset($_SESSION["adm"]);

    session_unset();
    session_destroy();

    header("Location: /BE20_CR5_JulianeJohannsen/user/login.php");