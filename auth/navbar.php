<nav>
    <h1>TITRE</h1>
    <ul>
        <?php if(!isset($_SESSION["user"])):?>
           <li><a href="/inscription.php"> inscription</a></li>
           <li><a href="/connexion.php"> connexion</a></li>
        <?php else : ?>
            <li> Bonjour <?= $_SESSION["user"]["pseudo"] ?></li>
            <li><a href="/deconnexion.php"> deconnexion</a></li>
            <?php endif;?>
    </ul>
</nav>