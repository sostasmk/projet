<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Numemp=$_GET["Numemp"];
    $sql="SELECT * FROM emprunt where Numemp=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numemp]);
    $emprunt=$stmt->fetch();

    // supprimer
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM emprunt WHERE Numemp=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Numemp]);
        echo "Emprunt supprimé avec succès";
        header("Location: ajoute.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression de emprunt</title>
</head>
<body>
    <h1>Suppression du emprunt</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer l'emprunt n° <?php echo $emprunt["Numemp"] . " de l'abonné " . $abonnee["Prenab"];; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>