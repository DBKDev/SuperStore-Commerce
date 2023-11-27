<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>SuperStore | Shop</title>
    <link rel="stylesheet" href="../styles/Header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <nav>
        <div class="menu-icon">
            <span class="fas fa-bars"></span>
        </div>
        <div class="logo">
            <a href="../Controller/ControllerProduit.php" class="Logo-text">SuperStore</a>
        </div>
        <div class="nav-items">
            <li><a href="../Controller/ControllerProduit.php">Accueil</a></li>
            <li><a href="../Controller/ControllerConnexion.php">Connexion</a></li>
            <li><a href="../Controller/ControllerPanier.php">Panier</a></li>
            <li><a href="../Controller/ControllerCommande.php">Commandes</a></li>
        </div>

        <div class="panier-icon">
            <a href=""><i class='bx bx-cart-download bx-md'></a></i>
            <li> <a href="#" class="Panier">Mon panier</a></li>
        </div>

        <div class="search-icon">
            <span class="fas fa-search"></span>
        </div>
        <div class="cancel-icon">
            <span class="fas fa-times"></span>
        </div>
        <form action="#">
            <input type="search" class="search-data" placeholder="Recherche" required>
            <button type="submit" class="fas fa-search"></button>
        </form>
    </nav>
    <div class="content">
        <header class="space"></header>
        <card class="space text">
        </card>
    </div>
    </div>
    <script>
        const menuBtn = document.querySelector(".menu-icon span");
        const searchBtn = document.querySelector(".search-icon");
        const cancelBtn = document.querySelector(".cancel-icon");
        const items = document.querySelector(".nav-items");
        const form = document.querySelector("form");
        menuBtn.onclick = () => {
            items.classList.add("active");
            menuBtn.classList.add("hide");
            searchBtn.classList.add("hide");
            cancelBtn.classList.add("show");
        }
        cancelBtn.onclick = () => {
            items.classList.remove("active");
            menuBtn.classList.remove("hide");
            searchBtn.classList.remove("hide");
            cancelBtn.classList.remove("show");
            form.classList.remove("active");
            cancelBtn.style.color = "#ff3d00";
        }
        searchBtn.onclick = () => {
            form.classList.add("active");
            searchBtn.classList.add("hide");
            cancelBtn.classList.add("show");
        }
    </script>
</body>

</html>