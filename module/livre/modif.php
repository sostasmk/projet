<?php
    $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
    $Codelivre=$_GET["Codelivre"];
    $sql="SELECT * FROM livre where Codelivre=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Codelivre]);
    $livre=$stmt->fetch();

    //modifier
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $Titrelv=$_POST['Titrelv'];
        $Auteur=$_POST['Auteur'];
        $Categlv=$_POST['Categlv'];
        $Pagelv=$_POST['Pagelv'];
        $sql="UPDATE livre set Titrelv=?, Auteur=?, Categlv=?, Pagelv=? WHERE Codelivre=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$Titrelv, $Auteur, $Categlv, $Pagelv, $Codelivre]);

        header("Location: ajoute.php");
        echo "les informations du livre ont été modifiées avec succès";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Modification des informations du livre</title>
</head>
<body>
    <h1>Modification des informations du livre</h1>
    <form method="POST">
        <label for="Codelivre">Code du livre:</label>
        <input type="text" value="<?php echo $livre['Codelivre']; ?>" disabled><br>
        <label for="Titrelv">Titre:</label>
        <input type="text" name="Titrelv" value="<?php echo $livre['Titrelv']; ?>" required><br>
        <label for="Auteur">Auteur:</label>
        <input type="text" name="Auteur" value="<?php echo $livre['Auteur']; ?>" required><br>
        <label for="Categlv">Catégorie:</label>
        <input type="text" name="Categlv" value="<?php echo $livre['Categlv']; ?>" required><br>
        <label for="Pagelv">Nombre de pages:</label>
        <input type="text" name="Pagelv" value="<?php echo $livre['Pagelv']; ?>" required><br>
        <button type="submit">Modifier</button>
        <a href="ajoute.php">Retour à la liste des livres</a>
    </form>
</body>
</html>