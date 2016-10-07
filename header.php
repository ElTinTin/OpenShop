<?php
    if (isset($_SESSION['civi']) && ($_SESSION['nom']) && ($_SESSION['prenom'])) {
    echo "<header>";
	echo '<h1><a href="index.php">Bienvenue sur SiteWebShop !</a></h1>';
	echo '<nav id="menu"><ul><li>Bonjour '.$_SESSION['civi'].' '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</li><li><a href="deconnexion.php">déconnexion</a></li><li><a href="index.php">accueil</a></li><li><a href="login.php">login</a></li><li><a href="creer_compte.php">créer compte</a></li><li><a href="panier.php">panier</a></li></ul></nav>';
	echo '<form id="search" action="recherche.php" method="post" enctype="multipart/form-data">';
    echo '<p><label for="searchText">Rechercher :</label><input id="searchText" name="query" type="text" value="" /><input id ="searchBtn" type="submit" class="bouton" value="OK" /></p></form>';
	echo '<nav id="menu-categorie"><ul><li><a href="categorie.php?cat=all">tous les produits</a></li><li><a href="categorie.php?cat=1">vetements</a></li><li><a href="categorie.php?cat=2">accessoires</a></li><li><a href="categorie.php?cat=3">posters</a></li><li><a href="categorie.php?cat=4">dvd</a></li></ul></nav></header>';
    }
    else {
    echo "<header>";
	echo '<h1><a href="index.php">Bienvenue sur SiteWebShop !</a></h1>';
	echo '<nav id="menu"><ul><li><a href="index.php">accueil</a></li><li><a href="login.php">login</a></li><li><a href="creer_compte.php">créer compte</a></li><li><a href="panier.php">panier</a></li></ul></nav>';
	echo '<form id="search" action="recherche.php" method="post" enctype="multipart/form-data">';
    echo '<p><label for="searchText">Rechercher :</label><input id="searchText" name="query" type="text" value="" /><input id ="searchBtn" type="submit" class="bouton" value="OK" /></p></form>';
	echo '<nav id="menu-categorie"><ul><li><a href="categorie.php?cat=all">tous les produits</a></li><li><a href="categorie.php?cat=1">vetements</a></li><li><a href="categorie.php?cat=2">accessoires</a></li><li><a href="categorie.php?cat=3">posters</a></li><li><a href="categorie.php?cat=4">dvd</a></li></ul></nav></header>';
    }
?>