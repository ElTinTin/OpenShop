<?php session_start(); ?>
<?php include "utile.php"; ?>
<?php include "connexion.php"; ?>

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
				<header>Bienvenue <span class="ss-titre">Nous sommes le ?????? </span></header>
				<p>La boutique en ligne <strong>openSHOP</strong> est un travail réalisé par <em>Thomas Jouannic</em> & <em>Jérome Saunier</em> 
				puis modifié et adapté <strong>au cours de Sites Web Avancés</strong>.</p>
				<p>Dans la partie haute, vous trouverez un moyen pour vous identifiez ou créer un compte si vous n'en n'avez aucun. Le champ de recherche 
				vous permet d'afficher simplement les produits correspondants à ce que vous souhaitez. Vous pouvez aussi naviguer entre les différentes 
				catégorie de produits en cliquant sur celle que vous désirez voir.</p>
				<p>Bonne naviguation !</p>
	</section>
	<section>
		<header>
					<h2>Au hasard...</h2>
		</header>
				<!--Affichage de 3 articles au hasard -->
				<?php
                    $requete="SELECT * FROM article ORDER BY RAND() LIMIT 3";
                    $rep=$connexion->query($requete);
                    echo "<ul id='product-list'>";
                    while ($ligne=$rep->fetch(PDO::FETCH_OBJ)){
                        echo "<li class='product'>";
                        echo "<h3>".$ligne->designation."</h3>";
                        echo "<p><img src='$ligne->img_article' alt='article' /></p>";
                        echo "<h3>".$ligne->prix." €</h3>";
                        echo "<p>".tronquer_texte($ligne->description)."</p>";

                        echo '<p><a href="vue_produit.php?article='.$ligne->id_article.'"> Voir les détails</a></p>';
                    }
                ?>
	</section>
    <?php require "footer.php"; ?>
</body>
</html>