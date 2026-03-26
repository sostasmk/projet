<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Idpaye=$_GET["Idpaye"];
    $sql="SELECT * FROM paiement where Idpaye=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Idpaye]);
    $paiement=$stmt->fetch();

    // supprimer
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM paiement WHERE Idpaye=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Idpaye]);
        echo "Paiement supprimé avec succès";
        header("Location: ajoute.php");
    }
$sql2="SELECT NumAb, Nomab FROM abonnee";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $abonnee=($stmt2->fetch(PDO::FETCH_ASSOC));
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression de paiement</title>
</head>
<body>
    <h1>Suppression du paiement</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer le paiement n° <?php echo $paiement["Idpaye"] . " de l'abonné " . $abonnee["Nomab"]; ?> </p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>