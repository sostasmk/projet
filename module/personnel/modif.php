<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Nummat=$_GET["Nummat"];
    $sql="SELECT * FROM personnel where Nummat=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Nummat]);
    $personnel=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Nummat=$_POST["Nummat"];
        $Nomag=$_POST["Nomag"];
        $Postag=$_POST["Postag"];
        $Prenag=$_POST["Prenag"];
        $Emailag=$_POST["Emailag"];
        $phone=$_POST["phone"];
        $sql="UPDATE personnel set Nummat=?, Nomag=?, Postag=?, Prenag=?, Emailag=?, phone=? WHERE Nummat=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Nummat, $Nomag, $Postag, $Prenag, $Emailag, $phone, $Nummat]);
        
        header("Location: ajoute.php");
        echo "Personnel modifié avec succès";    
        }
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
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification du personnel</title>
</head>
<body>
    <h1>Modification du personnel</h1>
    <form method="POST">
        <label for="Nummat">Numéro de matricule:</label>
        <input type="text" name="Nummat" value="<?php echo $personnel['Nummat']; ?>" required><br>
        <label for="Codefonc">Fonction:</label>
        <select type="text" id="Codefonc" name="Codefonc" required>
            <option value="">Sélectionnez une fonction</option>
            <?php foreach($fonction as $code => $libelle): ?>
                <option value="<?= $code ?>" <?= ($code == $personnel['Codefonc']) ? 'selected' : '' ?>><?= $libelle ?></option>
            <?php endforeach; ?>
        </select>

        <label for="Nomag">Nom du personnel:</label>
        <input type="text" name="Nomag" value="<?php echo $personnel['Nomag']; ?>" required><br>
        <label for="Postag">Postnom du personnel:</label>
        <input type="text" name="Postag" value="<?php echo $personnel['Postag']; ?>" required><br>
        <label for="Prenag">Prénom du personnel:</label>
        <input type="text" name="Prenag" value="<?php echo $personnel['Prenag']; ?>" required><br>
        <label for="Emailag">Email du personnel:</label>
        <input type="text" name="Emailag" value="<?php echo $personnel['Emailag']; ?>" required><br>
        <label for="phone">Téléphone du personnel:</label>
        <input type="text" name="phone" value="<?php echo $personnel['phone']; ?>" required><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour vers la liste des personnel</a>
    </form>
</body>
</html>