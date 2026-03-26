<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Numemp=$_POST['Numemp'];
    $Dateemp=$_POST['Dateemp'];
    $Datert=$_POST['Datert'];
    $Etat=$_POST['Etat'];
    $NumAb=$_POST['NumAb'];
    $NumMat=$_POST['NumMat'];
    $Codelivre=$_POST['Codelivre'];
    $sql="INSERT INTO emprunt(Numemp,Dateemp,Datert,Etat,NumAb,NumMat,Codelivre) VALUES(?,?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numemp,$Dateemp,$Datert,$Etat,$NumAb,$NumMat,$Codelivre]);
    echo "L'emprunt à été ajoutée avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM emprunt");

$sql2="SELECT NumAb, Nomab FROM abonnee";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $abonne=[];
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        $abonne[$row["NumAb"]] = $row["Nomab"];
    }
$sql3="SELECT Nummat,Codefonc FROM personnel";
    $stmt3=$pdo->prepare($sql3);
    $stmt3->execute();
    $personnel=[];
    while ($row=$stmt3->fetch(PDO::FETCH_ASSOC)) {
        $personnel[$row["Nummat"]] = $row["Codefonc"];
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
    <title>Info des emprunts</title>
</head>
<body>
    <h1>Enregistrement des emprunts</h1>
    <form action="" method="post">
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p style="color: green;">L'emprunt a été ajouté avec succès.</p>
    <?php endif; ?>
        <label for="Numemp">Numéro d'emprunt:</label>
        <input type="text" name="Numemp" placeholder="Emprunt..." required><br>
        <label for="Dateemp">Date de délivrance:</label>
        <input type="date" name="Dateemp" required><br>
        <label for="Datert">Date de retour:</label>
        <input type="date" name="Datert" required><br>
        <label for="Etat">État du livre:</label>
        <select name="Etat" required>
            <option value="">Choisir l'état du livre</option>
            <option value="Bonne">Bon</option>
            <option value="Lamentable">Lamentable</option>
            <option value="Impéccable">Impéccable</option>
            <option value="Assez bon">Assez bon</option>
            <option value="Médiocre">Médiocre</option>
        </select><br>
        <label for="NumAb">Numéro d'abonné:</label>
        <select name="NumAb" required>
            <option value="">Choisir l'abonné</option>
            <?php foreach($abonne as $numAb => $nomAb): ?>
                <option value="<?php echo $numAb; ?>"><?php echo $nomAb; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="NumMat">Numéro de matricule:</label>
        <select name="NumMat" required>
            <option value="">Choisir le personnel</option>
            <?php foreach($personnel as $numMat => $codeFonc): ?>
                <option value="<?php echo $numMat; ?>"><?php echo $codeFonc; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="Codelivre">Code du livre:</label>
        <select name="Codelivre" required>
            <option value="">Choisir le livre</option>
            <?php foreach($livre as $codeLivre => $titreLv): ?>
                <option value="<?php echo $codeLivre; ?>"><?php echo $titreLv; ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des emprunts</h2>
    <table border="1">
        <tr>
            <th>Numéro d'emprunt</th>
            <th>Date de délivrance</th>
            <th>Date de retour</th>
            <th>État du livre</th>
            <th>Numéro d'abonné</th>
            <th>Numéro de matricule</th>
            <th>Code du livre</th>
            <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Numemp']; ?></td>
            <td><?php echo $row['Dateemp']; ?></td>
            <td><?php echo $row['Datert']; ?></td>
            <td><?php echo $row['Etat']; ?></td>
            <td><?php echo $row['NumAb']; ?></td>
            <td><?php echo $row['NumMat']; ?></td>
            <td><?php echo $row['Codelivre']; ?></td>
            <td>
                <a href="modif.php?Numemp=<?php echo $row["Numemp"] ?>">Modifier</a>
                <a href="supprim.php?Numemp=<?php echo $row["Numemp"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>