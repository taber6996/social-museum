<?php
    session_start();
    if(isset($_SESSION['login'])){
        unset($_SESSION['login']);
    }
    else echo "<p>Esto no deberia pasar </p>";
    session_destroy();
    header('Location: index.php');
?>