<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $NumAb=$_GET["NumAb"];
    $sql="SELECT * FROM abonnee where NumAb=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$NumAb]);
    $abonnee=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Numcarte=$_POST["Numcarte"];
        $Nomab=$_POST["Nomab"];
        $Postnomab=$_POST["Postnomab"];
        $Prenab=$_POST["Prenab"];
        $Sexab=$_POST["Sexab"];
        $Typeab=$_POST["Typeab"];
        $Adresab=$_POST["Adresab"];
        $Emailab=$_POST["Emailab"];
        $Phoneab=$_POST["Phoneab"];
        $sql="UPDATE abonnee set Numcarte=?, Nomab=?, Postnomab=?, Prenab=?, Sexab=?, Typeab=?, Adresab=?, Emailab=?, Phoneab=? WHERE NumAb=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Numcarte, $Nomab, $Postnomab, $Prenab, $Sexab, $Typeab, $Adresab, $Emailab, $Phoneab, $NumAb]);
        
        header("Location: ajoute.php");
        echo "Abonné modifié avec succès";    
        }
        $sql2="SELECT Numcarte, Datedelic FROM carte";
    $stmt2=$pdo->prepare($sql2);
    $stmt2->execute();
    $Numcarte=[];
    while ($row=$stmt2->fetch(PDO::FETCH_ASSOC)) {
        $Numcarte[$row["Numcarte"]] = $row["Datedelic"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification</title>
</head>
<body>
    <h1>Modification de l'abonné</h1>
    <form method="POST">
        <label for="Numcarte">Numéro de carte:</label>
        <select name="Numcarte" required>
            <option value="">Choisir le numéro de carte</option>
            <?php foreach($Numcarte as $numCarte => $dateDelic): ?>
                <option value="<?php echo $numCarte; ?>" <?php if ($abonnee['Numcarte'] == $numCarte) echo 'selected'; ?>>
                    <?php echo $numCarte . " - " . $dateDelic; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Nomab">Nom de l'abonné:</label>
        <input type="text" name="Nomab" value="<?php echo $abonnee['Nomab']; ?>" required><br>
        <label for="Postnomab">Postnom de l'abonné:</label>
        <input type="text" name="Postnomab" value="<?php echo $abonnee['Postnomab']; ?>" required><br>
        <label for="Prenab">Prénom de l'abonné:</label>
        <input type="text" name="Prenab" value="<?php echo $abonnee['Prenab']; ?>" required><br>
        <label for="Sexab">Sexe:</label>
        <select name="Sexab" required>
            <option value="">Choisir le sexe</option>
            <option value="Masculin" <?php if ($abonnee['Sexab'] == 'Masculin') echo 'selected'; ?>>Masculin</option>
            <option value="Féminin" <?php if ($abonnee['Sexab'] == 'Féminin') echo 'selected'; ?>>Féminin</option>
        </select><br>
        <label for="Typeab">Type d'abonnement:</label>
        <select name="Typeab" required>
            <option value="">Choisir le type d'abonnement</option>
            <option value="Standard" <?php if ($abonnee['Typeab'] == 'Standard') echo 'selected'; ?>>Standard</option>
            <option value="VIP / Premium" <?php if ($abonnee['Typeab'] == 'VIP / Premium') echo 'selected'; ?>>VIP / Premium</option>
            <option value="Etudiant" <?php if ($abonnee['Typeab'] == 'Etudiant') echo 'selected'; ?>>Etudiant</option>
        </select><br>
        <label for="Adresab">Adresse de l'abonné:</label>
        <input type="text" name="Adresab" value="<?php echo $abonnee['Adresab']; ?>" required><br>
        <label for="Emailab">Email de l'abonné:</label>
        <input type="text" name="Emailab" value="<?php echo $abonnee['Emailab']; ?>" required><br>
        <label for="Phoneab">Téléphone de l'abonné:</label>
        <input type="text" name="Phoneab" value="<?php echo $abonnee['Phoneab']; ?>" required><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Annuler</a>
    </form>
</body>
</html>