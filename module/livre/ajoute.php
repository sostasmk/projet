<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Codelivre=$_POST['Codelivre'];
     $Titrelv=$_POST['Titrelv'];
     $Auteur=$_POST['Auteur'];
     $Categlv=$_POST['Categlv'];
     $Pagelv=$_POST['Pagelv'];
    $sql="INSERT INTO livre(Codelivre,Titrelv,Auteur,Categlv,Pagelv) VALUES(?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codelivre,$Titrelv,$Auteur,$Categlv,$Pagelv]);
    echo "Le livre à été ajouté avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM livre");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Info des livres</title>
</head>
<body>
    <h1>Enregistrement des livres</h1>
    <form action="" method="post">
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p style="color: green;">Le livre a été ajouté avec succès.</p>
    <?php endif; ?>
        <label for="Codelivre">Code du livre:</label>
        <input type="text" name="Codelivre" placeholder="Saisir le code du livre" required><br>
        <label for="Titrelv">Titre:</label>
        <input type="text" name="Titrelv" placeholder="Saisir le titre du livre" required><br>
        <label for="Auteur">Auteur:</label>
        <input type="text" name="Auteur" placeholder="Saisir le nom de l'auteur" required><br>
        <label for="Categlv">Catégorie:</label>
        <input type="text" name="Categlv" placeholder="Saisir la catégorie du livre" required><br>
        <label for="Pagelv">Nombre de pages:</label>
        <input type="text" name="Pagelv" placeholder="Saisir le nombre de pages" required><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des livres</h2>
    <table border="1">
        <tr>
            <th>Code du livre</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
            <th>Nombre de pages</th>
             <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Codelivre']; ?></td>
            <td><?php echo $row['Titrelv']; ?></td>
            <td><?php echo $row['Auteur']; ?></td>
            <td><?php echo $row['Categlv']; ?></td>
            <td><?php echo $row['Pagelv']; ?></td>
            <td>
                <a href="modif.php?Codelivre=<?php echo $row["Codelivre"] ?>">Modifier</a>
                <a href="supprim.php?Codelivre=<?php echo $row["Codelivre"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>