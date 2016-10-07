<?php include "utile.php"; ?>
<?php include "connexion.php"; ?>

<?php
if(isset($_POST["mail"]) && ($_POST["mdp"]) && ($_POST["nom"]) && ($_POST["prenom"]) && ($_POST["adresse"]) && ($_POST["codepostal"]) && ($_POST["ville"]) && ($_POST["pays"]) && ($_POST["telephone"])) {
    $mail = $_POST["mail"];
    $mdp = hash('sha256',$_POST["mdp"]);
    $civi = $_POST["civi"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = addslashes($_POST["adresse"]);
    $codepostal = $_POST["codepostal"];
    $ville = $_POST["ville"];
    $pays = $_POST["pays"];
    $telephone = $_POST["telephone"];
    
    $test = $connexion->prepare('SELECT COUNT(*) AS nb FROM client WHERE email =:email');
    $test->execute(array('email' => $mail,));
    $result = $test->fetch(PDO::FETCH_OBJ);
    $nb = $result->nb;
    
    if ($nb == 0) {
    $ins = $connexion->prepare('INSERT INTO client(email, mot_de_passe, civilite, nom, prenom, adresse, code_postal, ville, pays, telephone) VALUES (:mail,:mdp,:civi,:nom,:prenom,:adresse,:codepostal,:ville,:pays,:telephone)');
    $ins->execute(array(
        'mail' => $mail,
        'mdp' => $mdp,
        'civi' => $civi,
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'codepostal' => $codepostal,
        'ville' => $ville,
        'pays' => $pays,
        'telephone' => $telephone
        )
        );
        header('location:login.php');
    }
    else {
    echo "<p>Cet email est déjà pris.</p>";
    }
}
else {
    $chaine = " ";
}
?>
<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop</title>
</head>
<body>
    <?php require "header.php"; ?>
    <section>
        <header><h1>Créer un compte</h1></header>
        <form id="creer-compte" method="POST" action="creer_compte.php">
            <fieldset id="credentials">
                <p><label for="edtMail" id="idMail">Email :</label>
                    <input value="<?php if(isset($_POST['mail'])) { echo htmlentities($_POST['mail']);}?>" type="text" id="edtMail" name="mail" required /></p>
                <p><label for="edtmdp" id="idNom">Mot de Passe</label>
                    <input value="<?php if(isset($_POST['mdp'])) { echo htmlentities($_POST['mdp']);}?>" type="text" id="edtmdp" name="mdp" required /></p>
                <p><label for="edtCivi" id="idCivi">Civilité :</label>
                    <select name="civi"><option>Mr</option><option>Mme</option><option>Mlle</option></select></p>
                <p><label for="edtNom" id="idNom">Nom :</label>
                    <input value="<?php if(isset($_POST['mail'])) { echo htmlentities($_POST['mail']);}?>" type="text" id="edtNom" name="nom" required /></p>
                <p><label for="edtPrenom" id="idPrenom">Prénom :</label>
                    <input value="<?php if(isset($_POST['prenom'])) { echo htmlentities($_POST['prenom']);}?>" type="text" id="edtPrenom" name="prenom" required  /></p>
                <p><label for="edtAdre" id="idAdr">Adresse :</label>
                    <input value="<?php if(isset($_POST['adresse'])) { echo htmlentities($_POST['adresse']);}?>" type="text" id="edtAdr" name="adresse" required  /></p>
                <p><label for="edtCP" id="idCP">Code Postal :</label>
                    <input value="<?php if(isset($_POST['codepostal'])) { echo htmlentities($_POST['codepostal']);}?>" type="text" id="edtCP" name="codepostal" required  /></p>
                <p><label for="edtVille" id="idVille">Ville :</label>
                    <input value= "<?php if(isset($_POST['ville'])) { echo htmlentities($_POST['ville']);}?>" type="text" id="edtVille" name="ville" required  /></p>
                <p><label for="edtPays" id="idPays">Pays :</label>
                    <input value= "<?php if(isset($_POST['pays'])) { echo htmlentities($_POST['pays']);}?>" type="text" id="edtPays" name="pays" required  /></p>
                <p><label for="edtTel" id="idTel">Téléphone :</label>
                    <input value= "<?php if(isset($_POST['telephone'])) { echo htmlentities($_POST['telephone']);}?>" type="text" id="edtTel" name="telephone" required  /></p>
                <input type="submit" id="btnSubmit" value="Suivant" name="send" />
            </fieldset>
        </form>
    </section>
    <?php require "footer.php"; ?>
</body>
</html>