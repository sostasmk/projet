<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Nummat=$_GET["Nummat"];
    $sql="SELECT * FROM personnel where Nummat=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Nummat]);
    $personnel=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $sql="DELETE FROM personnel WHERE Nummat=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Nummat]);
        echo "Personnel supprimé avec succès";
        header("Location: ajoute.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Suppression du personnel</title>
</head>
<body>
    <h1>Suppression du personnel</h1>
    <form method="POST">
        <p>Êtes-vous sûr de vouloir supprimer le personnel n° <?php echo $personnel["Nummat"]. " " . $personnel["Nomag"] . " - " . $personnel["Prenag"]; ?> ?</p>
        <button type="submit">Supprimer</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>