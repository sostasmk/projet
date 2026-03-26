<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Numcarte=$_GET["Numcarte"];
    $sql="SELECT * FROM carte where Numcarte=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numcarte]);
    $carte=$stmt->fetch();

    //supprimer
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM carte WHERE Numcarte=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Numcarte]);
        echo "Carte retirée avec succès";
        header("Location: ajoute.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de la carte</title>
</head>
<body>
    <h1>Suppression de la carte</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer la carte n° <?php echo $carte["Numcarte"]; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>