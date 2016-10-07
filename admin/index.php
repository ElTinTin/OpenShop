<?php include "../connexion.php" ?>
<?php
    if(isset($_POST['desi']) && !empty($_POST['desi'])
       && ($_POST['desc']) && !empty($_POST['desc'])
       && ($_POST['prix']) && !empty($_POST['prix'])
       && ($_POST['tva']) && !empty($_POST['tva'])
       && ($_POST['cat']) && !empty($_POST['cat'])
       && ($_FILES['img'])) {
        
        $desi = $_POST['desi'];
        $desc = $_POST['desc'];
        $cat = $_POST['cat'];
        $prix = $_POST['prix'];
        $tva = $_POST['tva'];
    
        $test = $connexion->prepare('SELECT COUNT(*) AS nb FROM article WHERE designation =:designation');
        $test->execute(array('designation' => $desi,));
        $result = $test->fetch(PDO::FETCH_OBJ);
        $nb = $result->nb;

        if ($nb == 0) {
        $img = "./images/".basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], ".".$img);
        $ins = $connexion->prepare('INSERT INTO article(id_categorie, designation, prix, tva, description, img_article) VALUES (:id_categorie,:designation,:prix,:tva,:description,:img)');
        $ins->execute(array(
        'id_categorie' => $cat,
        'designation' => $desi,
        'prix' => $prix,
        'tva' => $tva,
        'description' => $desc,
        'img' => $img
        )
        );
        echo "<p>Insérer avec succès !</p>";
        }
    }   
?>

<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="styleAdmin.css" rel="stylesheet" type="text/css" />
	<title>SiteWebShop</title>
</head>
<body>
    <div id="container">
        <h1>Administration du site Openshop</h1>
        <h3>Ajout d'article</h3>
        <form id="ajout_objet" method="POST" action="index.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Ajout d'un article</legend>
                <p><label for="desi" id="desi">Designation :</label>
                    <input value="<?php if(isset($_POST['desi'])) { echo htmlentities($_POST['desi']);}?>" type="text" id="desi" name="desi" required /></p>
                
                <p><label for="desc" id="desc">Description :</label>
                    <input value="<?php if(isset($_POST['desc'])) { echo htmlentities($_POST['desc']);}?>" type="text" id="desc" name="desc" required /></p>
                
                <p><label for="cat" id="cat">Catégorie :</label>
                    <select name="cat" id="cat">
                        <?php
                        $requete="SELECT * FROM categorie";
                        $rep=$connexion->query($requete);
                        $info=$rep->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($info as $element) {
                            echo "<option value='".$element['id_categorie']."'>".$element['nom']."</option>";
                        }
                        ?>
                    </select></p>
        
                <p><label for="prix" id="prix">Prix :</label>
                    <input value="<?php if(isset($_POST['prix'])) { echo htmlentities($_POST['prix']);}?>" type="text" id="prix" name="prix" required /></p>
                
                <p><label for="tva" id="tva">TVA :</label>
                    <input value="<?php if(isset($_POST['tva'])) { echo htmlentities($_POST['tva']);}?>" type="text" id="tva" name="tva" required /></p>
                
                <p><label for="img" id="img">Image :</label>
                    <input type="file" id="img" name="img" required /></p>
            </fieldset>
            <p class="submit">
            <input type="submit" id="btnSubmit" value="Envoyer" name="send" />    
            </p>
        </form>
    </div>
</body>
</html>