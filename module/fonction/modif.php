<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codefonc=$_GET["Codefonc"];
    $sql="SELECT * FROM fonction where Codefonc=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codefonc]);
    $fonction=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Codefonc=$_POST["Codefonc"];
        $Libfonc=$_POST["Libfonc"];
        $sql="UPDATE fonction set Codefonc=?, Libfonc=? WHERE Codefonc=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Codefonc, $Libfonc, $Codefonc]);
        
        header("Location: ajoute.php");
        echo "Fonction modifiée avec succès";    
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification des fonctions</title>
</head>
<body>
    <h1>Modification des fonctions</h1>
    <form method="POST">
        <label for="Codefonc">Code de la fonction:</label>
        <input type="text" name="Codefonc" value="<?php echo $fonction['Codefonc']; ?>" required><br>
        <label for="Libfonc">Libellé:</label>
        <input type="text" name="Libfonc" value="<?php echo $fonction['Libfonc']; ?>" required><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour à la liste des fonctions</a>
</body>
</html>