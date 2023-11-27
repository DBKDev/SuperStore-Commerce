<?php
session_start(); // Assurez-vous de démarrer la session sur chaque page qui utilise $_SESSION
$isAdmin = isset($_SESSION['utilisateur_est_admin']) && $_SESSION['utilisateur_est_admin'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($isAdmin) {
    include('../Controller/HeaderAdmin.php');
} else {
    include('../Controller/HeaderUser.php');
}
include("../Controller/ModeleSuperstore.php");
$connect = getConnect();
include("../Vues/VueConnexion.php");

?>