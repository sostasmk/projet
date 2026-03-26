<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Numemp=$_GET["Numemp"];
    $sql="SELECT * FROM emprunt where Numemp=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numemp]);
    $emprunt=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Numemp=$_POST['Numemp'];
        $Dateemp=$_POST['Dateemp'];
        $Datert=$_POST['Datert'];
        $Etat=$_POST['Etat'];
        $NumAb=$_POST['NumAb'];
        $NumMat=$_POST['NumMat'];
        $Codelivre=$_POST['Codelivre'];
        $sql="UPDATE emprunt set Numemp=?, Dateemp=?, Datert=?, Etat=?, NumAb=?, NumMat=?, Codelivre=? WHERE Numemp=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Numemp, $Dateemp, $Datert, $Etat, $NumAb, $NumMat, $Codelivre, $Numemp]);
        
        header("Location: ajoute.php");
        echo "Emprunt modifié avec succès";    
        }
$sql2="SELECT NumAb, Nomab FROM abonnee";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $abonne=[];
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        $abonne[$row["NumAb"]] = $row["Nomab"];
    }
$sql3="SELECT Nummat, Nomag FROM personnel";
    $stmt3=$pdo->prepare($sql3);
    $stmt3->execute();
    $personnel=[];
    while ($row=$stmt3->fetch(PDO::FETCH_ASSOC)) {
        $personnel[$row["Nummat"]] = $row["Nomag"];
    }
$sql4="SELECT Codelivre, Titrelv FROM livre";
    $stmt4=$pdo->prepare($sql4);
    $stmt4->execute();
    $livre=[];
    while ($row=$stmt4->fetch(PDO::FETCH_ASSOC)) {
        $livre[$row["Codelivre"]] = $row["Titrelv"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification du emprunt</title>
</head>
<body>
    <h1>Modification du emprunt</h1>
    <form method="POST">
        <label for="Numemp">Numéro d'emprunt:</label>
        <input type="text" name="Numemp" value="<?php echo $emprunt['Numemp']; ?>" disabled><br>
        <label for="Dateemp">Date de délivrance:</label>
        <input type="date" name="Dateemp" value="<?php echo $emprunt['Dateemp']; ?>" required><br>
        <label for="Datert">Date de retour:</label>
        <input type="date" name="Datert" value="<?php echo $emprunt['Datert']; ?>" required><br>
        <label for="Etat">État du livre:</label>
        <select name="Etat" required>
            <option value="Bonne" <?php echo ($emprunt['Etat'] == 'Bonne') ? 'selected' : ''; ?>>Bon</option>
            <option value="Lamentable" <?php echo ($emprunt['Etat'] == 'Lamentable') ? 'selected' : ''; ?>>Lamentable</option>
            <option value="Impéccable" <?php echo ($emprunt['Etat'] == 'Impéccable') ? 'selected' : ''; ?>>Impéccable</option>
            <option value="Assez bon" <?php echo ($emprunt['Etat'] == 'Assez bon') ? 'selected' : ''; ?>>Assez bon</option>
            <option value="Médiocre" <?php echo ($emprunt['Etat'] == 'Médiocre') ? 'selected' : ''; ?>>Médiocre</option>
        </select><br>

        <label for="NumAb">Numéro d'abonné:</label>
        <select name="NumAb" >
            <?php foreach($abonne as $numAb => $nomAb): ?>
                <option value="<?php echo $numAb; ?>" <?php echo ($numAb == $emprunt['NumAb']) ? 'selected' : ''; ?>><?php echo $nomAb; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="NumMat">Numéro de matricule:</label>
        <select name="NumMat" required>
            <?php foreach($personnel as $numMat => $nomAg): ?>
                <option value="<?php echo $numMat; ?>" <?php echo ($numMat == $emprunt['NumMat']) ? 'selected' : ''; ?>><?php echo $nomAg; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="Codelivre">Code du livre:</label>
        <select name="Codelivre" required>
            <?php foreach($livre as $codeLivre => $titreLv): ?>
                <option value="<?php echo $codeLivre; ?>" <?php echo ($codeLivre == $emprunt['Codelivre']) ? 'selected' : ''; ?>><?php echo $titreLv; ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour vers la liste des personnel</a>
    </form>
</body>
</html>