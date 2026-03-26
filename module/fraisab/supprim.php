<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codefrais=$_GET["Codefrais"];
    $sql="SELECT * FROM fraisab where Codefrais=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefrais]);
    $fraisab=$stmt->fetch();

    //suppression du frais d'abonnement
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM fraisab WHERE Codefrais=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codefrais]);
        echo "Frais d'abonnement supprimé avec succès";
        header("Location: ajoute.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression du frais d'abonnement</title>
</head>
<body>
    <h1>Suppression du frais d'abonnement</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer le frais d'abonnement n° <?php echo $fraisab["Codefrais"] . " " . $fraisab["Libelle"]; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>