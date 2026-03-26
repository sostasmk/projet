<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codefonc=$_GET["Codefonc"];
    $sql="SELECT * FROM fonction where Codefonc=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefonc]);
    $fonction=$stmt->fetch();

    //suppression de la fonction
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM fonction WHERE Codefonc=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codefonc]);
        echo "Fonction supprimée avec succès";
        header("Location: ajoute.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression de la fonction</title>
</head>
<body>
    <h1>Suppression de la fonction</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer la fonction n° <?php echo $fonction["Codefonc"] . " " . $fonction["Libfonc"]; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>