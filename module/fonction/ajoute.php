<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Codefonc=$_POST['Codefonc'];
    $Libfonc=$_POST['Libfonc'];
    $sql="INSERT INTO fonction(Codefonc,Libfonc) VALUES(?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefonc,$Libfonc]);
    echo "La fonction à été ajoutée avec succès";
}
$data=$pdo->query("SELECT * FROM fonction");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Enregistrement des fonctions</title>
</head>
<body>
    <h1>Enregistrement des fonctions</h1>
    <form action="" method="post">
        <label for="Codefonc">Code de la fonction:</label>
        <input type="text" name="Codefonc" placeholder="Saisir le code de la fonction" required><br>
        <label for="Libfonc">Libellé:</label>
        <input type="text" name="Libfonc" placeholder="Saisir le libellé de la fonction" required><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des fonctions</h2>
    <table border="1">
        <tr>
            <th>Code de la fonction</th>
            <th>Libellé</th>
             <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Codefonc']; ?></td>
            <td><?php echo $row['Libfonc']; ?></td>
            <td>
                <a href="modif.php?Codefonc=<?php echo $row["Codefonc"] ?>">Modifier</a>
                <a href="supprim.php?Codefonc=<?php echo $row["Codefonc"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>