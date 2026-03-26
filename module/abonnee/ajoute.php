<?php
 $pdo=new PDO("mysql:host=localhost;dbname=gesblio","root","");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $NumAb=$_POST['NumAb'];
    $Numcarte=$_POST['Numcarte'];
    $Nomab=$_POST['Nomab'];
    $Postnomab=$_POST['Postnomab'];
    $Prenab=$_POST['Prenab'];
    $Sexab=$_POST['Sexab'];
    $Typeab=$_POST['Typeab'];
    $Adresab=$_POST['Adresab'];
    $Emailab=$_POST['Emailab'];
    $Phoneab=$_POST['Phoneab'];
    $sql="INSERT INTO abonnee(NumAb,Numcarte,Nomab,Postnomab,Prenab,Sexab,Typeab,Adresab,Emailab,Phoneab) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$NumAb,$Numcarte,$Nomab,$Postnomab,$Prenab,$Sexab,$Typeab,$Adresab,$Emailab,$Phoneab]);
    echo "l'Abonné à été ajouté avec succès";
    header("Location: ajoute.php?msg=success");
    exit();
}
$data=$pdo->query("SELECT * FROM abonnee");
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
    <title>Info des abonnée</title>
</head>
<body>
    <h1>Enregistrement des abonnée</h1>
    <form action="" method="post">
        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
        <p style="color: green;">L'abonné a été ajouté avec succès.</p>
    <?php endif; ?>
        <label for="NumAb">Numéro d'abonné:</label>
        <input type="text" name="NumAb" placeholder="Saisir le numéro d'abonné" required><br>
        <label for="Numcarte">Numéro de carte:</label>
        <select name="Numcarte" required>
            <option value="">Choisir le numéro de carte</option>
            <?php foreach($Numcarte as $numCarte => $dateDelic): ?>
                <option value="<?php echo $numCarte; ?>"><?php echo "N°" . $numCarte . " delivré le " . $dateDelic; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="Nomab">Nom:</label>
        <input type="text" name="Nomab" placeholder="Saisir le nom de l'abonné" required><br>
        <label for="Postnomab">Postnom:</label>
        <input type="text" name="Postnomab" placeholder="Saisir le postnom de l'abonné" required><br>
        <label for="Prenab">Prénom:</label>
        <input type="text" name="Prenab" placeholder="Saisir le prénom de l'abonné" required><br>
        <label for="Sexab">Sexe:</label>
        <select name="Sexab" required>
            <option value="">Choix du Sexe</option>
            <option value="Masculin">M</option>
            <option value="Féminin">F</option>
        </select><br>
        <label for="Typeab">Type d'abonnement:</label>
        <select name="Typeab" required>
            <option value="">Choix du Type d'abonnement</option>
            <option value="Standard">Standard</option>
            <option value="VIP / Premium">VIP / Premium</option>
            <option value="Etudiant">Etudiant</option>
        </select><br>
        <label for="Adresab">Adresse:</label>
        <input type="text" name="Adresab" placeholder="Saisir l'adresse de l'abonné" required><br>
        <label for="Emailab">Email:</label>
        <input type="text" name="Emailab" placeholder="Saisir l'email de l'abonné" required><br>
        <label for="Phoneab">Téléphone:</label>
        <input type="text" name="Phoneab" placeholder="Saisir le téléphone de l'abonné" required><br>
        <button type="submit">Enregistrer</button>
        <a href="../../public/index.php">Retour vers le menu principal</a>
    </form>
    <h2>Liste des abonnés</h2>
    <table border="1">
        <tr>
            <th>Numéro d'abonné</th>
            <th>Numéro de carte</th>
            <th>Nom</th>
            <th>Postnom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Type d'abonnement</th>
            <th>Adresse</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach($data as $row): ?>
        <tr>
            <td><?php echo $row['NumAb']; ?></td>
            <td><?php echo $row['Numcarte']; ?></td>
            <td><?php echo $row['Nomab']; ?></td>
            <td><?php echo $row['Postnomab']; ?></td>
            <td><?php echo $row['Prenab']; ?></td>
            <td><?php echo $row['Sexab']; ?></td>
            <td><?php echo $row['Typeab']; ?></td>
            <td><?php echo $row['Adresab']; ?></td>
            <td><?php echo $row['Emailab']; ?></td>
            <td><?php echo $row['Phoneab']; ?></td>
            <td>
                <a href="modif.php?NumAb=<?php echo $row["NumAb"] ?>">Modifier</a>
                <a href="supprim.php?NumAb=<?php echo $row["NumAb"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>