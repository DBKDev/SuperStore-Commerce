<?php 
session_start(); // Démarrer une nouvelle session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Affiche le contenu du panier
if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    echo "Contenu du panier : ";

    // Utilisez la fonction getPanier() pour obtenir les détails complets du produit
    $panierDetails = getProduits();

    foreach ($_SESSION['panier'] as $produit_id) {
        // Vérifier si le produit existe dans le panierDetails
        if (isset($panierDetails[$produit_id])) {
            $produit = $panierDetails[$produit_id];
            echo "<p>{$produit['nom_produit']} - {$produit['prix_produit']} €</p>";
            echo "<form method=\"post\">";
            echo "<label for=\"quantite\">Quantité :</label>";
            echo "<select name=\"quantite\" id=\"quantite\">";
            
            // Boucle pour générer les options de 1 à 10
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value=\"$i\">$i</option>";
            }
            
            echo "</select>";
            echo "<br>";
            echo "<input type=\"hidden\" name=\"id_produit\" value=\"$produit_id\">"; // Ajout du champ id_produit
            echo "<input type=\"submit\" value=\"Mettre à jour la quantité\" name=\"MajQuantite\">";
            echo "<br>";
            echo "<input type=\"submit\" value=\"Supprimer du panier\" name=\"supPanier\">";
            echo "</form>";
        } else {
            echo "<p>Produit introuvable.</p>";
        }
    }
} else {
    echo "Le panier est vide.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

    if (isset($_POST['supPanier']) && isset($_POST['id_produit'])) {
        $produit_id = $_POST['id_produit'];

        // Supprime le produit du panier (utilisez array_diff pour retirer l'élément du tableau)
        if (isset($_SESSION['panier']) && in_array($produit_id, $_SESSION['panier'])) {
            $_SESSION['panier'] = array_diff($_SESSION['panier'], array($produit_id));
            echo "Produit retiré du panier avec succès.";
        } else {
            echo "Le produit n'est pas dans le panier.";
        }
    } else {
        echo "ID du produit non spécifié.";
    }
}
?>
</body>
</html>
