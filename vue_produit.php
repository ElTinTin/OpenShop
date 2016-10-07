<?php
session_start();

include 'utile.php';
include 'connexion.php';
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

    <?php

    require('header.php');

?>
    
    <section>
        
        <?php

                if ( !empty($_GET['article']) ) {               
                $article = $_GET["article"];
                $requete="SELECT * FROM article WHERE article.id_article = ".$article;
                $rep=$connexion->query($requete);
                $ligne=$rep->fetch(PDO::FETCH_OBJ);
                    
                echo '<article id="detail-produit">';
                echo "<header><h2>".$ligne->designation."</h2></header>";
                echo "<p><img src='$ligne->img_article' alt = 'article'/></p>";
                echo "<p>".$ligne->description."</p>";
                echo "<strong>".$ligne->prix." €</strong>";
                echo '<form id="form-produit" method="post" action="panier.php">';
                echo '<label for="id-article"></label>';
                echo '<input type="hidden" id="edtArticle" name="id-article" accesskey="P" value="'.$_GET['article'].'"  />';
                echo '<label for="ajouterpanier">Quantité :</label>';
                echo '<select name="qte"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select>';
                echo '<input type="submit" id="btnSubmit" value="Ajouter au panier" name="send"/>';
                echo '</form>'; 
                echo "</article>";
                } 
                    else {
                    //message de problème
                        echo "<p>Erreur, aucun article n'a été saisi</p>";
               }
                    
            ?>

        
        </section>
    
<?php

require('footer.php');

?>


</body>
</html>