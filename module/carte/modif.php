<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Numcarte=$_GET["Numcarte"];
    $sql="SELECT * FROM carte where Numcarte=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numcarte]);
    $carte=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Datedelic=$_POST['Datedelic'];
        $Dateexp=$_POST['Dateexp'];
        $Typeab=$_POST['Typeab'];
        $sql="UPDATE carte set Datedelic=?, Dateexp=?, Typeab=? WHERE Numcarte=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Datedelic, $Dateexp, $Typeab, $Numcarte]);

        header("Location: ajoute.php");
        echo "Carte modifiée avec succès";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification de la carte</title>
</head>
<body>
    <h1>Modification de la carte</h1>
    <form method="POST">
        <label for="Numcarte">Numéro de carte:</label>
        <input type="text" value="<?php echo $carte['Numcarte']; ?>" disabled><br>
        <label for="Datedelic">Date de délivrance:</label>
        <input type="date" name="Datedelic" value="<?php echo $carte['Datedelic']; ?>" required><br>
        <label for="Dateexp">Date d'expiration:</label>
        <input type="date" name="Dateexp" value="<?php echo $carte['Dateexp']; ?>" required><br>
        <label for="Typeab">Type d'abonnement:</label>
        <select name="Typeab" required>
            <option value="">Choisir le type d'abonnement</option>
            <option value="Standard" <?php if ($carte['Typeab'] == "Standard") echo "selected"; ?>>Standard</option>
            <option value="VIP / Premium" <?php if ($carte['Typeab'] == "VIP / Premium") echo "selected"; ?>>VIP / Premium</option>
            <option value="Etudiant" <?php if ($carte['Typeab'] == "Etudiant") echo "selected"; ?>>Etudiant</option>
        </select><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour à la liste des cartes</a>
    </form>
</body>
</html>