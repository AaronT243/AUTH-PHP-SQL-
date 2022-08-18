<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location: connexion.php");
    exit;
}
// on supprime la variable session avec la fonction unset
unset($_SESSION["user"]);
header("location: index.php");
?>
