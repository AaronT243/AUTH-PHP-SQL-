<?php
// on demarre la session
session_start();
if(isset($_SESSION["user"])){
    header("location: profil.php");
    exit;
}
require_once "navbar.php";

// on verifie si le formulaire a été envoyé
if(!empty($_POST)){
  //var_dump($_POST);
  // le formulaire a été envoyé
  // verifier si tous les champs requis sont remplis 
  if(isset($_POST["nickname"], $_POST["email"], $_POST["pass"])
  && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
    //formulaire bien rempli
    // on récupère les données en le protegeant
    //strip_tags enlève les balises html dans une chaine de caractère 
    $pseudo = strip_tags($_POST["nickname"]);
    $email =($_POST["email"]);
    $pass =($_POST["pass"]);
    // hasher le password
    $pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
    // verifier si l'email en est un 
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      die("Email incorrecte");

    }

// insertion en bdd
require_once "bdd.php";
$sql = " INSERT INTO `MEMBRES` (`pseudo`,`email`,`pass`) VALUES (:pseudo, :email, '$pass')";
$query = $db->prepare($sql);
$query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
$query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
$query->execute();
// on recupère l'id du nouvau utilisateur
$id = $db->lastInsertId();

// on connecte l'utilisateur après s'etre inscrit grace à sa session 

            // on stocke dans $_session les informations de l'utilisateur 
            $_SESSION["user"] = [
              "id" => $id,
              "pseudo"=> $_POST["nickname"],
              $user["pseudo"],
              "email"=> $_POST["email"],
            ];
            //var_dump($_SESSION);

            //on redirige l'utilisateur vers la page de profil
            header("location: profil.php");

}else{
    die("le formulaire est incomplet");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AUTH</title>
</head>
<body>
  <form method="POST">
    <div>
      <label for="pseudo"> Pseudo</label>
      <input type="text" name="nickname" id="pseudo">
    </div>
    <div>
      <label for="email"> Email</label>
      <input type="email" name="email" id="email">
    </div>
    <div>
      <label for="pass">Mot de passe</label>
      <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">M'inscrire</button>
  </form>
</body>
</html>