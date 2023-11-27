<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
function connexion(){
    $bdd = 'mysql:host=localhost;dbname=superstore';
    $util = 'root';
    $mdp = 'root';
    try{$conn=new PDO($bdd, $util, $mdp);
    }catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $conn;
}


function getUser(){
    $conn=connexion();
    $reponse = $conn->query('SELECT * FROM utilisateurs');
    $user = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $user;
}
function getProduits(){
    $conn=connexion();
    $reponse = $conn->query('SELECT * FROM produits');
    $produits = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $produits;
}

function getCommandes(){
    $conn=connexion();
    $reponse = $conn->query('SELECT * FROM commandes');
    $commandes = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $commandes;
}

function getDetails_Commandes(){
    $conn=connexion();
    $reponse = $conn->query('SELECT * FROM details_commandes');
    $D_commandes = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $D_commandes;
}

function getPanier(){
    $conn=connexion();
    $reponse = $conn->query('SELECT * FROM paniers');
    $panier = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $panier;
}
function getConnect(){
    $conn=connexion();
    $reponse = $conn->query('SELECT email_user, mdp_user, admin_user FROM utilisateurs');
    $connect = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $connect;
}

function getInscription(){
    $conn=connexion();
    $reponse = $conn->query('SELECT email_user, nom_user, prenom_user, mdp_user, admin_user FROM utilisateurs');
    $inscription = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $inscription;
}


function getCommandeFinalise(){
    $conn=connexion();
    $reponse = $conn->query('SELECT u.nom_user, u.prenom_user, c.* , p.nom_produit , p.prix_produit,   pa.quantite_produit , sum(p.prix_produit*pa.quantite_produit) as Prix_total
    FROM commandes c
    JOIN devient d  ON d.id_commande = c.id_commande
    JOIN produits p ON p.id_produit = d.id_produit
    JOIN utilisateurs u ON u.email_user = d.email_user
    JOIN paniers pa ON pa.id_panier = d.id_panier
    GROUP BY u.nom_user , u.prenom_user , c.id_commande ;');
    $AffichagePanier = $reponse->fetchAll(PDO::FETCH_ASSOC); // recupère tous les résultats, fetch assoc, crée un tableau associatif.
    return $AffichagePanier;
}

function creerNouveauPanier($emailUser) {
    $conn = connexion();

    // Obtenez l'ID de l'utilisateur
    $requeteUtilisateur = $conn->prepare('SELECT email_user FROM utilisateurs WHERE email_user = :email');
    $requeteUtilisateur->bindParam(':email', $emailUser);
    $requeteUtilisateur->execute();
    $utilisateur = $requeteUtilisateur->fetch(PDO::FETCH_ASSOC);

    // Vérifiez si l'utilisateur existe
    if (!$utilisateur) {
        // L'utilisateur n'existe pas, vous pourriez gérer cela en conséquence
        return false;
    }

    // Insérez une nouvelle ligne dans la table paniers avec l'ID de l'utilisateur
    $requetePanier = $conn->prepare('INSERT INTO paniers (email_user) VALUES (:email_user)');
    $requetePanier->bindParam(':email_user', $utilisateur['email_user']);
    $requetePanier->execute();

    // Retournez l'ID du panier créé
    return $conn->lastInsertId();
}





function obtenirEmail($inscription) {
    $emailUser = array(); 
    foreach ($inscription as $value) {
        $email = $value["email_user"];     
        $emailUser[] = $email;
    }
    return $emailUser ;
}

function obtenirMdp($password) {
    $MdpUser = array(); 
    foreach ($password as $value) {
        $mdp = $value["mdp_user"];     
        $MdpUser[] = $mdp;
    }
    return $MdpUser ;
}

function obtenirAdmin($admin) {
    $AdminUser = array(); 
    foreach ($admin as $value) {
        $adm = $value["admin_user"];     
        $AdminUser[] = $adm;
    }
    return $AdminUser ;
}
?>