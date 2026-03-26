<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codelivre=$_GET["Codelivre"];
    $sql="SELECT * FROM livre where Codelivre=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codelivre]);
    $livre=$stmt->fetch();

    //supprimer
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM livre WHERE Codelivre=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codelivre]);
        echo "Livre a été supprimé avec succès";
        header("Location: ajoute.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression du livre</title>
</head>
<body>
    <h1>Suppression du livre</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer le livre n° <?php echo $livre["Codelivre"] . " " . $livre["Titrelv"] . " de " . $livre["Auteur"]; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>