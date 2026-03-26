<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Codefrais=$_POST['Codefrais'];
    $NumAb=$_POST['NumAb'];
    $Montp=$_POST['Montp'];
    $Typep=$_POST['Typep'];
    $Datep=$_POST['Datep'];
    $NumMat=$_POST['NumMat'];
    $sql="INSERT INTO paiement(Codefrais,NumAb,Montp,Typep,Datep,NumMat) VALUES(?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefrais,$NumAb,$Montp,$Typep,$Datep,$NumMat]);
    echo "Le paiement à été ajouté avec succès";
}
$data=$pdo->query("SELECT * FROM paiement");

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
    <title>Info des paiements</title>
</head>
<body>
    <h1>Enregistrement des paiements</h1>
    <form action="" method="post">
        <label for="Codefrais">Frais d'abonnement:</label>
        <select name="Codefrais" required>
            <option value="">Choisir le frais</option>
            <?php foreach($fraisab as $codeFrais => $libelle  ): ?>
                <option value="<?php echo $codeFrais; ?>"><?php echo $libelle; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="NumAb">Nom de l'abonné:</label>
        <select name="NumAb" required>
            <option value="">Choisir l'abonné</option>
            <?php foreach($abonne as $numAb => $nomAb): ?>
                <option value="<?php echo $numAb; ?>"><?php echo $nomAb; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="Montp">Montant du paiement:</label>
        <input type="text" name="Montp" placeholder="Saisir le montant du paiement" required><br>
        <label for="Typep">Type de paiement:</label>
        <select name="Typep" required>
            <option value="">Choisir le type de paiement</option>
            <option value="Espèces">Espèces</option>
            <option value="Chèque">Chèque</option>
            <option value="Virement">Virement</option>
        </select><br>
        <label for="Datep">Date de paiement:</label>
        <input type="date" name="Datep" required><br>
        <label for="NumMat">Nom du personnel:</label>
        <select name="NumMat" required>
            <option value="">Nom du personnel</option>
            <?php foreach($personnel as $numMat => $nomAg): ?>
                <option value="<?php echo $numMat; ?>"><?php echo $nomAg; ?></option>
            <?php endforeach; ?>
        </select><br>
        

        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des paiements</h2>
    <table border="1">
        <tr>
            <th>Id paiement</th>
            <th>Code du frais</th>
            <th>Numéro d'abonné</th>
            <th>Montant</th>
            <th>Type de paiement</th>
            <th>Date de paiement</th>
            <th>Numéro de matricule</th>
            <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Idpaye']; ?></td>
            <td><?php echo $row['Codefrais']; ?></td>
            <td><?php echo $row['NumAb']; ?></td>
            <td><?php echo $row['Montp']; ?></td>
            <td><?php echo $row['Typep']; ?></td>
            <td><?php echo $row['Datep']; ?></td>
            <td><?php echo $row['NumMat']; ?></td>
            
            <td>
                <a href="modif.php?Idpaye=<?php echo $row["Idpaye"] ?>">Modifier</a>
                <a href="supprim.php?Idpaye=<?php echo $row["Idpaye"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>