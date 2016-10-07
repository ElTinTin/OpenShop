<?php
session_start();

include 'utile.php';
include 'connexion.php';

//Vérifier l'existence de la session panier :
if (!isset($_SESSION['panier'])) {
 $_SESSION['panier'] = array();   
}

//Vérifier si on vient de vue_produit.php
if (isset($_POST['send'])) {
    if (isset($_POST['id-article']) && isset($_POST['qte'])) {
        $article = array("id-article" => $_POST['id-article'],
                        "qte" => $_POST['qte']);
    }

    //Vérification si l'article existe dans le panier
    $articleExiste=false;
    $numArticle=0;
    foreach($_SESSION['panier'] as $key => $val) {
        if (array_search($article['id-article'],$val)!=NULL) {
            $articleExiste=true;
            $numArticle=$key;
        }
    }
    
    //Insertion selon l'existance de l'article
    if ($articleExiste == false) {
        array_push($_SESSION['panier'], $article);
    }
    else {
        $_SESSION['panier'][$numArticle]['qte']=$_SESSION['panier'][$numArticle]['qte']+$_POST['qte'];
    }
    header("location:panier.php");
}


if (!empty($_GET['sup'])) {
    foreach ($_SESSION['panier'] as $key => $val) {
        if (array_search($_GET['sup'],$val)!=NULL) {
            unset($_SESSION['panier']["$key"]);
        }
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

    <?php

    require('header.php');

?>
    
    <section>
            <header>
                <h2>Mon Panier</h2>
            </header>
            <?php
            $total_achat = 0;
            if (!empty($_SESSION['panier'])) {
            ?>
           
           <table id="cart-table">
				<thead>
				    <th>désignation</th>
					<th>quantité</th>
					<th>prix unitaire</th>
					<th>prix total</th>
					<th>supprimer</th>
				</thead>
				<tbody>
				<?php
                    $compteur = 0;
                    foreach($_SESSION['panier'] as $value) {
                    $requete ="SELECT designation, prix FROM article WHERE id_article =".$value['id-article'].";";
                    $rep=$connexion->query($requete);
                    $ligne=$rep->fetch(PDO::FETCH_OBJ);
                    $prixTotal = $value['qte'] * $ligne -> prix;
                    echo "<tr>";
					echo "<td>".$ligne -> designation."</td>";
					echo "<td>".$value['qte']."</td>";
					echo "<td>".$ligne -> prix."</td>";
					echo "<td>".$prixTotal."</td>";
					echo "<td><a href='panier.php?sup=".$value['id-article']."'><img src='images/cross.png' alt='Supprimer'/></a></td>";
                    echo "</tr>";
                    $compteur = $compteur + 1;
                    $total_achat = $total_achat + $prixTotal;
                    }
                        ?>
				
				
	
			</tbody>
		    </table>
          <p id="total-achat">
				Prix total HT : <strong><?php echo round($total_achat, 2) . " &euro;" ; ?></strong><br />
				TVA : <strong>	<?php
									$tva = round(( $total_achat * 0.196), 2);
									echo $tva . " &euro;" ;
								?></strong><br />
				Prix total TTC : <strong>	<?php
									$ttc = round( ($total_achat + $tva), 2);
									echo $ttc . " &euro;" ;
								?></strong>
			</p>
			<form id="form-panier" action="commande.php" method="post" enctype="multipart/form-data">
				<p>
					<input value="Valider votre commande »" type="submit"  />
				</p>
		    </form>
			<?php
			
				} else {
					
			?>
						
			
			<div id="empty-cart">
				<p><img src="images/poubelle.png" alt="vide" /></p>
				<p>Votre panier est vide</p>
			</div>
			
			<?php
				} 
					
			?>
			
			

	</section>
    
<?php

require('footer.php');

?>


</body>
</html>