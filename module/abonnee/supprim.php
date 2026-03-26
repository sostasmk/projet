<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $NumAb=$_GET["NumAb"];
    $sql="SELECT * FROM abonnee where NumAb=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$NumAb]);
    $abonnee=$stmt->fetch();

    //supprimer
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM abonnee WHERE NumAb=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$NumAb]);
        echo "Abonné retiré avec succès";
        header("Location: ajoute.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Supprimer l'abonnée</title>
</head>
<body>
    <h1>Suppression de l'abonnée</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer l'abonnée <?php echo $abonnee["Nomab"]  . " " . $abonnee["Prenab"];?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>

</body>
</html>