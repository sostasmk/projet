<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codefrais=$_GET["Codefrais"];
    $sql="SELECT * FROM fraisab where Codefrais=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefrais]);
    $fraisab=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Codefrais=$_POST["Codefrais"];
        $Libelle=$_POST["Libelle"];
        $Montant=$_POST["Montant"];
        $Dureeab=$_POST["Dureeab"];
        $sql="UPDATE fraisab set Codefrais=?, Libelle=?, Montant=?, Dureeab=? WHERE Codefrais=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codefrais, $Libelle, $Montant, $Dureeab, $Codefrais]);
        
        header("Location: ajoute.php");
        echo "Frais d'abonnement modifié avec succès";    
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification des frais d'abonnement</title>
</head>
<body>
    <h1>Modification des frais d'abonnement</h1>
    <form method="POST">
        <label for="Codefrais">Code du frais:</label>
        <input type="text" name="Codefrais" value="<?php echo $fraisab['Codefrais']; ?>" required><br>
        <label for="Libelle">Libellé:</label>
        <select name="Libelle" required>
            <option value="">Choix du Type d'abonnement</option>
            <option value="Standard" <?php if ($fraisab['Libelle'] == 'Standard') echo 'selected'; ?>>Standard</option>
            <option value="VIP / Premium" <?php if ($fraisab['Libelle'] == 'VIP / Premium') echo 'selected'; ?>>VIP / Premium</option>
            <option value="Etudiant" <?php if ($fraisab['Libelle'] == 'Etudiant') echo 'selected'; ?>>Etudiant</option>
        </select><br>
        <label for="Montant">Montant:</label>
        <input type="text" name="Montant" value="<?php echo $fraisab['Montant']; ?>" required><br>
        <label for="Dureeab">Durée d'abonnement:</label>
        <select name="Dureeab" required>
            <option value="">Choisir la durée de l'abonnement</option>
            <option value="1 mois" <?php if ($fraisab['Dureeab'] == '1 mois') echo 'selected'; ?>>1 mois</option>
            <option value="3 mois" <?php if ($fraisab['Dureeab'] == '3 mois') echo 'selected'; ?>>3 mois</option>
            <option value="6 mois" <?php if ($fraisab['Dureeab'] == '6 mois') echo 'selected'; ?>>6 mois</option>
            <option value="1 an" <?php if ($fraisab['Dureeab'] == '1 an') echo 'selected'; ?>>1 an</option>
        </select><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour à la liste des frais d'abonnement</a>
</body>
</html>