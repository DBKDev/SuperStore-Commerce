<?php

session_start(); // Assurez-vous de démarrer la session sur chaque page qui utilise $_SESSION

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['utilisateur_email'])) {
    // L'utilisateur est connecté

    // Vérifiez si l'utilisateur est administrateur
    if ($_SESSION['utilisateur_est_admin']) {
        echo "Bienvenue, administrateur " . $_SESSION['utilisateur_email'] . "!";
    } else {
        echo "Bienvenue, " . $_SESSION['utilisateur_email'] . "!";
    }
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: ControllerConnexion.php');
    exit();
}

?>