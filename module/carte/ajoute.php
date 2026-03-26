<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $Numcarte=$_POST['Numcarte'];
    $Datedelic=$_POST['Datedelic'];
    $Dateexp=$_POST['Dateexp'];
    $Typeab=$_POST['Typeab'];
    $sql="INSERT INTO carte(Numcarte,Datedelic,Dateexp,Typeab) VALUES(?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$Numcarte,$Datedelic,$Dateexp,$Typeab]);
    echo "La carte d'abonnement à été ajoutée avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM carte");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../static/css/style.css">
    <title>Info des cartes d'abonnement</title>
</head>
<body>
    <h1>Enregistrement des cartes d'abonnement</h1>
    <form action="" method="post">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p>La carte d'abonnement a été ajoutée avec succès.</p>
        <?php endif; ?>
        <label for="Numcarte">Numéro de carte:</label>
        <input type="text" name="Numcarte" placeholder="C..." required><br>
        <label for="Datedelic">Date de délivrance:</label>
        <input type="date" name="Datedelic" required><br>
        <label for="Dateexp">Date d'expiration:</label>
        <input type="date" name="Dateexp" required><br>
        <label for="Typeab">Type d'abonnement:</label>
        <select name="Typeab" required>
            <option value="">Choisir le type d'abonnement</option>
            <option value="Standard">Standard</option>
            <option value="VIP / Premium">VIP / Premium</option>
            <option value="Etudiant">Etudiant</option>
        </select><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des cartes d'abonnement</h2>
    <table border="1">
        <tr>
            <th>Numéro de carte</th>
            <th>Date de délivrance</th>
            <th>Date d'expiration</th>
            <th>Type d'abonnement</th>
             <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['Numcarte']; ?></td>
            <td><?php echo $row['Datedelic']; ?></td>
            <td><?php echo $row['Dateexp']; ?></td>
            <td><?php echo $row['Typeab']; ?></td>
            <td>
                <a href="modif.php?Numcarte=<?php echo $row["Numcarte"] ?>">Modifier</a>
                <a href="supprim.php?Numcarte=<?php echo $row["Numcarte"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>