<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="/GESBLIO/static/css/menu.css">
</head>
<body>
    <div class="menu_container">
        <h1>Menu</h1>
        <div class="menuBox">
            <a href="/GESBLIO/module/Abonnee/ajoute.php" class="buttonlink">Abonnés</a>
            <a href="/GESBLIO/module/personnel/ajoute.php" class="buttonlink">Agents</a>
            <a href="/GESBLIO/module/carte/ajoute.php" class="buttonlink" >Carte</a>
            <a href="/GESBLIO/module/emprunt/ajoute.php" class="buttonlink">Emprunt</a>
            <a href="/GESBLIO/module/fonction/ajoute.php" class="buttonlink">fonction</a>
            <a href="/GESBLIO/module/fraisab/ajoute.php" class="buttonlink">Frais</a>
            <a href="/GESBLIO/module/livre/ajoute.php" class="buttonlink">Livre</a>
            <a href="/GESBLIO/module/paiement/ajoute.php" class="buttonlink">Paiement</a>
        </div>
    </div>
</body>
</html>