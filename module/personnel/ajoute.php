<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Nummat=$_POST['Nummat'];
    $Codefonc=$_POST['Codefonc'];
    $Nomag=$_POST['Nomag'];
    $Postag=$_POST['Postag'];
    $Prenag=$_POST['Prenag'];
    $Emailag=$_POST['Emailag'];
    $phone=$_POST['phone'];
    $sql="INSERT INTO personnel(Nummat,Codefonc,Nomag,Postag,Prenag,Emailag,phone) VALUES(?,?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Nummat,$Codefonc,$Nomag,$Postag,$Prenag,$Emailag,$phone]);
    echo "le personnel à été ajouté avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM personnel");

$sql2="SELECT Codefonc, Libfonc FROM fonction";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $fonction=[];
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        $fonction[$row["Codefonc"]] = $row["Libfonc"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GESBLIO/static/css/style.css">
    <title>Info des personnel</title>
</head>
<body>
    <h1>Enregistrement des personnel</h1>
    <form action="" method="post">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p>Le personnel a été ajouté avec succès.</p>
    <?php endif; ?>
        <label for="Nummat">Numéro de matricule:</label>
        <input type="text" name="Nummat" placeholder="Saisir le numéro de matricule" required><br>
        <label for="Codefonc">Fonction:</label>
        <select type="text" id="Codefonc" name="Codefonc" required>
            <option value="">Sélectionnez une fonction</option>
            <?php foreach($fonction as $code => $libelle): ?>
                <option value="<?= $code ?>"><?= $libelle ?></option>
            <?php endforeach; ?>
        </select>
        <label for="Nomag">Nom:</label>
        <input type="text" name="Nomag" placeholder="Saisir le nom du personnel" required><br>
        <label for="Postag">Postnom:</label>
        <input type="text" name="Postag" placeholder="Saisir le postnom du personnel" required><br>
        <label for="Prenag">Prénom:</label>
        <input type="text" name="Prenag" placeholder="Saisir le prénom du personnel" required><br>
        <label for="Emailag">Email:</label>
        <input type="text" name="Emailag" placeholder="Saisir l'email du personnel" required><br>
        <label for="phone">Téléphone:</label>
        <input type="text" name="phone" placeholder="Saisir le téléphone du personnel" required><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des personnel</h2>
    <table border="1">
        <tr>
            <th>Numéro de matricule</th>
            <th>Code fonction</th>
            <th>Nom</th>
            <th>Postnom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Nummat']; ?></td>
            <td><?php echo $row['Codefonc']; ?></td>
            <td><?php echo $row['Nomag']; ?></td>
            <td><?php echo $row['Postag']; ?></td>
            <td><?php echo $row['Prenag']; ?></td>
            <td><?php echo $row['Emailag']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <a href="modif.php?Nummat=<?php echo $row["Nummat"] ?>">Modifier</a>
                <a href="supprim.php?Nummat=<?php echo $row["Nummat"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>