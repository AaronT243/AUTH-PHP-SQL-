<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "AUTH");
// definition data source name
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;
try{
  // connexion bdd
  $db = new PDO($dsn, DBUSER, DBPASS);
  // definition charset à utf8
  $db->exec("SET NAMES utf8");
  // methode récuperation de données avec (fetch)
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
  die($e->getMessage());

}
?>