<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Codefrais=$_POST['Codefrais'];
    $Libelle=$_POST['Libelle'];
    $Montant=$_POST['Montant'];
    $Dureeab=$_POST['Dureeab'];
    $sql="INSERT INTO fraisab(Codefrais,Libelle,Montant,DureeAb) VALUES(?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefrais,$Libelle,$Montant,$Dureeab]);
    echo "Le frais d'abonnement à été ajouté avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM fraisab");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Enregistrement des frais d'abonnement</title>
</head>
<body>
    <h1>Enregistrement des frais d'abonnement</h1>
    <form action="" method="post">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p style="color: green;">Le frais d'abonnement a été ajouté avec succès.</p>
    <?php endif; ?>
        <label for="Codefrais">Code du frais:</label>
        <input type="text" name="Codefrais" placeholder="Saisir le code du frais" required><br>
        <label for="Libelle">Libellé:</label>
        <select name="Libelle" required>
            <option value="">Choix du Type d'abonnement</option>
            <option value="Standard">Standard</option>
            <option value="VIP / Premium">VIP / Premium</option>
            <option value="Etudiant">Etudiant</option>
        </select><br>
        <label for="Montant">Montant:</label>
        <input type="text" name="Montant" placeholder="Saisir le montant du frais" required><br>
        <label for="Dureeab">Durée d'abonnement:</label>
        <select name="Dureeab" required>
            <option value="">Choisir la durée de l'abonnement</option>
            <option value="1 mois">1 mois</option>
            <option value="3 mois">3 mois</option>
            <option value="6 mois">6 mois</option>
            <option value="1 an">1 an</option>
        </select><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des frais d'abonnement</h2>
    <table border="1">
        <tr>
            <th>Code du frais</th>
            <th>Libellé</th>
            <th>Montant</th>
            <th>Durée d'abonnement</th>
             <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Codefrais']; ?></td>
            <td><?php echo $row['Libelle']; ?></td>
            <td><?php echo $row['Montant']; ?></td>
            <td><?php echo $row['Dureeab']; ?></td>
            <td>
                <a href="modif.php?Codefrais=<?php echo $row["Codefrais"] ?>">Modifier</a>
                <a href="supprim.php?Codefrais=<?php echo $row["Codefrais"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>