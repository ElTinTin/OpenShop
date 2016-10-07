<?php session_start(); ?>
<?php include "utile.php"; ?>
<?php include "connexion.php"; ?>

<?php
if(isset($_POST["mail"]) && ($_POST["mdp"])) {
    $mail = $_POST["mail"];
    $mdp = hash('sha256',$_POST["mdp"]);
    
    $test = $connexion->prepare('SELECT COUNT(*) AS nb FROM client WHERE email =:email AND mot_de_passe=:mdp');
    $test->execute(array('email' => $mail, 'mdp' =>$mdp,));
    $result = $test->fetch(PDO::FETCH_OBJ);
    $nb = $result -> {'nb'};
    
    if ($nb == 1) {
        $sql = 'SELECT nom, prenom, civilite FROM client';
        $res = $connexion->query($sql);
        $pers = $res->fetch(PDO::FETCH_OBJ);
        $_SESSION['nom'] = $pers->nom;
        $_SESSION['prenom'] = $pers->prenom;
        $_SESSION['civi'] = $pers->civilite;
        //header('location:index.php');
    }
    else {
        echo "<p>Mauvais identifiant ou mot de passe</p>";
    }
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
<!-- DEBUT de la page -->
    <?php require "header.php"; ?>
    <section>
		<header>
					<h1>Identification</h1>
		</header>
        <form id="login" method="POST" action="login.php">
            <fieldset id="credentials">
                <p><label for="edtMail" id="idMail">Email</label>
                    <input type="text" id="edtMail" name="mail" required /></p>
                <p><label for="edtmdp" id="idNom">Mot de Passe</label>
                    <input type="text" id="edtmdp" name="mdp" required /></p>
                <input type="submit" id="btnSubmit" value="Connexion" name="send" />
            </fieldset>
        </form>
	</section>
    <?php require "footer.php"; ?>
</body>
</html>