<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Idpaye=$_GET["Idpaye"];
    $sql="SELECT * FROM paiement where Idpaye=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Idpaye]);
    $paiement=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Codefrais=$_POST['Codefrais'];
        $NumAb=$_POST['NumAb'];
        $Montp=$_POST['Montp'];
        $Typep=$_POST['Typep'];
        $Datep=$_POST['Datep'];
        $NumMat=$_POST['NumMat'];
        $sql="UPDATE paiement set Codefrais=?, NumAb=?, Montp=?, Typep=?, Datep=?, NumMat=? WHERE Idpaye=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codefrais, $NumAb, $Montp, $Typep, $Datep, $NumMat, $Idpaye]);

        header("Location: ajoute.php");
        echo "Paiement modifié avec succès";    
        }
$sql2="SELECT NumAb, Nomab FROM abonnee";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $abonne=[];
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        $abonne[$row["NumAb"]] = $row["Nomab"];
    }
$sql3="SELECT Nummat, Nomag,Codefonc  FROM personnel";
    $stmt3=$pdo->prepare($sql3);
    $stmt3->execute();
    $personnel=[];
    while ($row=$stmt3->fetch(PDO::FETCH_ASSOC)) {
        $personnel[$row["Nummat"]] = $row["Nomag"] . " - " . $row["Codefonc"];
    }
$sql4="SELECT Codefrais, libelle, montant FROM fraisab";
    $stmt4=$pdo->prepare($sql4);
    $stmt4->execute();
    $fraisab=[];
    while ($row=$stmt4->fetch(PDO::FETCH_ASSOC)) {
        $fraisab[$row["Codefrais"]] = $row["libelle"] . " - " . $row["montant"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification du paiement</title>
</head>
<body>
    <h1>Modification du paiement</h1>
    <form method="POST">
        <label for="Idpaye">Numéro de paiement:</label>
        <input type="text" name="Idpaye" value="<?php echo $paiement['Idpaye']; ?>" disabled><br>
        <label for="Codefrais">Code du frais:</label>
        <select name="Codefrais" required>
            <?php foreach($fraisab as $codeFrais => $libelleMontant): ?>
                <option value="<?php echo $codeFrais; ?>" <?php echo ($codeFrais == $paiement['Codefrais']) ? 'selected' : ''; ?>><?php echo $libelleMontant; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="NumAb">Numéro d'abonné:</label>
        <select name="NumAb" required>
            <?php foreach($abonne as $numAb => $nomAb): ?>
                <option value="<?php echo $numAb; ?>" <?php echo ($numAb == $paiement['NumAb']) ? 'selected' : ''; ?>><?php echo $nomAb; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="Montp">Montant du paiement:</label>
        <input type="text" name="Montp" value="<?php echo $paiement['Montp']; ?>" required><br>
        <label for="Typep">Type de paiement:</label>
        <select name="Typep" required>
            <option value="Espèce" <?php echo ($paiement['Typep'] == 'Espèce') ? 'selected' : ''; ?>>Espèce</option>
            <option value="Chèque" <?php echo ($paiement['Typep'] == 'Chèque') ? 'selected' : ''; ?>>Chèque</option>
            <option value="Virement" <?php echo ($paiement['Typep'] == 'Virement') ? 'selected' : ''; ?>>Virement</option>
        </select><br>
        <label for="Datep">Date du paiement:</label>
        <input type="date" name="Datep" value="<?php echo $paiement['Datep']; ?>" required><br>
        <label for="NumMat">Numéro de matricule:</label>
        <select name="NumMat" required>
            <?php foreach($personnel as $numMat => $nomAg): ?>
                <option value="<?php echo $numMat; ?>" <?php echo ($numMat == $paiement['NumMat']) ? 'selected' : ''; ?>><?php echo $nomAg; ?></option>
            <?php endforeach; ?>
        </select><br>

        
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour vers la liste des personnel</a>
    </form>
</body>
</html>