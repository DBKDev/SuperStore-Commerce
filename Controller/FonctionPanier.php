<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Démarrer la session
session_start();

// Fonction pour ajouter un produit au panier
function ajouterAuPanier($id_produit, $quantite) {
    // Vérifier si le panier existe dans la session
    if (!isset($_SESSION['panier'])) {
        // Si le panier n'existe pas, le créer
        $_SESSION['panier'] = array();
    }

    // Vérifier si le produit existe déjà dans le panier
    if (isset($_SESSION['panier'][$id_produit])) {
        // Si le produit existe, mettre à jour la quantité
        $_SESSION['panier'][$id_produit] += $quantite;
    } else {
        // Si le produit n'existe pas, l'ajouter au panier
        $_SESSION['panier'][$id_produit] = $quantite;
    }
}

// Fonction pour enregistrer le panier dans une table (exemple)
function enregistrerPanierEnBaseDeDonnees($user_email) {
    // Connexion à la base de données (à adapter selon votre configuration)
    $connexion = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

    // Parcourir le panier et insérer les produits dans la table appropriée
    foreach ($_SESSION['panier'] as $id_produit => $quantite_produit) {
        // À adapter selon votre schéma de base de données
        $requete = $connexion->prepare("INSERT INTO panier (email_user, id_produit, quantite_produit) VALUES ('$user_email', '$id_produit', '$quantite_produit')");
        $requete->execute([$user_email, $id_produit, $quantite_produit]);
    }

    // Effacer le panier après l'avoir enregistré en base de données (vous pouvez également choisir de le conserver)
    unset($_SESSION['panier']);
}

// Exemple d'utilisation
$user_email = 1; // Vous devrez obtenir l'ID de l'utilisateur à partir de la session ou d'une autre source
$id_produit = 123; // ID du produit à ajouter au panier
$quantite_produit = 2; // Quantité du produit à ajouter

// Ajouter le produit au panier
ajouterAuPanier($id_produit, $quantite_produit);

// Enregistrer le panier en base de données
enregistrerPanierEnBaseDeDonnees($user_email);
?>
</body>
</html>