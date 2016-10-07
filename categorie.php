<?php
    session_start();
    include 'connexion.php';
    include 'utile.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <title>Catégorie</title>
    </head>
    <body>
        <!-- DEBUT de la page -->
        <?php require 'header.php'; ?>
        <?php
            echo '<section>';
            if($_GET["cat"]=='all'){
                //Si catégorie == toutes
                $requete="SELECT * FROM article";
                $rep=$connexion->query($requete);
                echo '<header><h2>Tous les produits</h2></header>';
                echo '<ul id="product-list">';
                while ($ligne=$rep->fetch(PDO::FETCH_OBJ)) {
                    echo "<li class='product'>";
                    echo '<h3>' . $ligne->designation . '</h3>';
                    echo "<p><img src='$ligne->img_article'/></p>";
                    echo '<h3>' . $ligne->prix . ' €</h3>';
                    echo '<p>' . tronquer_texte($ligne->description) . '</p>';
                    echo '<p><a href="vue_produit.php?article=' . $ligne->id_article . '"> Voir les détails</a></p>';
                }
            }
            elseif($_GET["cat"]=='1'){
                //Si catégorie == 1
                $requete="SELECT * FROM article WHERE id_categorie=1";
                $rep=$connexion->query($requete);
                echo '<header><h2>Tous les vêtements</h2></header>';
                echo '<ul id="product-list">';
                while ($ligne=$rep->fetch(PDO::FETCH_OBJ)){
                    echo "<li class='product'>";
                    echo '<h3>'.$ligne->designation.'</h3>';
                    echo "<p><img src='$ligne->img_article'/></p>";
                    echo '<h3>'.$ligne->prix.' €</h3>';
                    echo '<p>'.tronquer_texte($ligne->description).'</p>';
                    echo '<p><a href="vue_produit.php?article='.$ligne->id_article.'"> Voir les détails</a></p>';
                }
            }
            elseif($_GET["cat"]=='2'){
                //Si catégorie == 2
                $requete="SELECT * FROM article WHERE id_categorie=2";
                $rep=$connexion->query($requete);
                echo '<header><h2>Tous les accessoires</h2></header>';
                echo '<ul id="product-list">';
                while ($ligne=$rep->fetch(PDO::FETCH_OBJ)){
                    echo "<li class='product'>";
                    echo '<h3>'.$ligne->designation.'</h3>';
                    echo "<p><img src='$ligne->img_article'/></p>";
                    echo '<h3>'.$ligne->prix.' €</h3>';
                    echo '<p>'.tronquer_texte($ligne->description).'</p>';
                    echo '<p><a href="vue_produit.php?article='.$ligne->id_article.'"> Voir les détails</a></p>';
                }
            }
            elseif($_GET["cat"]=='3'){
                //Si catégorie == 3
                $requete="SELECT * FROM article WHERE id_categorie=3";
                $rep=$connexion->query($requete);
                echo '<header><h2>Tous les posters</h2></header>';
                echo '<ul id="product-list">';
                while ($ligne=$rep->fetch(PDO::FETCH_OBJ)){
                    echo "<li class='product'>";
                    echo '<h3>'.$ligne->designation.'</h3>';
                    echo "<p><img src='$ligne->img_article'/></p>";
                    echo '<h3>'.$ligne->prix.' €</h3>';
                    echo '<p>'.tronquer_texte($ligne->description).'</p>';
                    echo '<p><a href="vue_produit.php?article='.$ligne->id_article.'"> Voir les détails</a></p>';
                }
            }
            elseif($_GET["cat"]=='4'){
                //Si catégorie == 4
                $requete="SELECT * FROM article WHERE id_categorie=4";
                $rep=$connexion->query($requete);
                echo '<header><h2>Tous les dvd</h2></header>';
                echo '<ul id="product-list">';
                while ($ligne=$rep->fetch(PDO::FETCH_OBJ)){
                    echo "<li class='product'>";
                    echo '<h3>'.$ligne->designation.'</h3>';
                    echo "<p><img src='$ligne->img_article'/></p>";
                    echo '<h3>'.$ligne->prix.' €</h3>';
                    echo '<p>'.tronquer_texte($ligne->description).'</p>';
                    echo '<p><a href="vue_produit.php?article='.$ligne->id_article.'"> Voir les détails</a></p>';
                }
            }
            echo '</li>';
            echo '</ul>';
            echo '</section>';
        ?>
        <?php require 'footer.php'; ?>
    </body>
</html>