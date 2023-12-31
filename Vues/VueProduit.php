<?php 
// Démarrez la session
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../styles//cardProduit.css">
    <title>Document</title>
</head>
<body>
    
    <?php  
    
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (session_status() == PHP_SESSION_NONE) {
    // Si la session n'est pas active, démarrer la session
    session_start();
}
$produit = getProduits();
echo"<div id='galery'>";

//    foreach ($produit as $produits) {
            
            foreach ($produit as $key => $value) {
                // echo '<p>'.$value.'</p>';
                        // echo '<p>'.$user.'</p>';
            echo '<div class="content-card">';
            
            echo '<div class="taille-img"><img src="../image/' . $value['img_produit'] . '" height="160px"></div>';
            echo '<div class="titre"><h3>'.$value["nom_produit"].'</h3></div>';            
            echo '<div class="text"><p>'.$value["description_produit"].'</p></div>';    
            echo '<h6>'.$value["prix_produit"].'€</h6>';
            echo '<ul class="etoile">';
            for ($i = 0; $i < 5; $i++) {
                echo "<li><i class='bx bxs-star'></i></li>";
            }
            echo '</ul>';
            echo '<form method="get">';
            echo '<input type="hidden" name="id_produit" value="' . $value['id_produit'] . '">';
            echo '<div class="boutonfaitchierceboutondemerde"><input type="submit" class="buy-1" value="Acheter" name="ajouter"></input></div>';
            echo '</form>';
            
            echo '</div>';
            }
            
        
       
            echo"</div>";
    

    // Vérifie si l'ID du produit est passé en paramètre
    if (isset($_GET['ajouter']) && isset($_GET['id_produit'])) {
        $produit_id = $_GET['id_produit'];
    
        // Ajoute le produit au panier (utilisez $_SESSION pour stocker le panier)
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    
        // Vérifie si le produit est déjà dans le panier
        if (!in_array($produit_id, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $produit_id;
            echo "Produit ajouté au panier avec succès.";
        } else {
            echo "Le produit est déjà dans le panier.";
        }
    }
  
    ?>
    
    
</body>
</html>