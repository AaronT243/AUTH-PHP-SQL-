<?php
session_start();
require_once "navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profile</title>
</head>
<body>
  <h1> profile de <?= $_SESSION["user"]["pseudo"] ?></h1>
  <p> Pseudo: <?= $_SESSION["user"]["pseudo"] ?></p>
  <p>Email : <?= $_SESSION["user"]["email"] ?></p>
</body>
</html>