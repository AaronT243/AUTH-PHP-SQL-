<?php
session_start();
if(isset($_SESSION["user"])){
  header("location: profil.php");
  exit;
}
require_once "navbar.php";
// on verifie si le formulaire a été envoyé
if(!empty($_POST)){
    if(isset($_POST["email"], $_POST["pass"])
    // verifier que les champs sont pas vides 
    && !empty($_POST["email"] && !empty($_POST["pass"]))
    ){
    $email =($_POST["email"]);
    $pass =($_POST["pass"]);
        // verifier que c'est bien un email
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            die("Email incorrecte");
            }
            //connexion bdd
            // verifier si l'email existe dans la bdd
            //require_once "index.php";
            require_once "bdd.php";
             $sql = "SELECT * FROM `MEMBRES` WHERE `email` = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
            $query->execute();
            $user = $query->fetch();
            // si l'utilisateur n'existe pas on renvoi ce message 
            if(!$user){
              die("l'utilisateur ou le mot de pass est incorrecte");
            } // password_verify verifie si le bon mot de passe existe dans la bdd (colonne "pass")
            if(!password_verify($_POST["pass"], $user["pass"])){
              die("l'utilisateur et/ou le mot de passe est incorrect");
            };

            // si l'utilisateur et le mot de pass sont corrects (on ouvre la session php pour l'utilisateur)
            
            // on stocke dans $_session les informations de l'utilisateur 
            $_SESSION["user"] = [
              "id" => $user["id"],
              "pseudo"=> $user["pseudo"],
              "email"=> $user["email"],
            ];
            //var_dump($_SESSION);
//on redirige l'utilisateur vers la page de profil
            header("location: profil.php");

};
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>connexion</title>
</head>
<body>
  <form method="POST">
    <div>
      <label for="email"> Email</label>
      <input type="email" name="email" id="email">
    </div>
    <div>
      <label for="pass">Mot de passe</label>
      <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Me connecter</button>
  </form>
</body>
</html>