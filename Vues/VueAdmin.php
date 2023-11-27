<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/formUserAdmin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

    <title>SuperStore | Admin</title>
</head>

<body>
    <div id="all-contain">
        <div class="useradmin-container">
            <h1>Formulaire de Saisie de l'utilisateur</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="text" id="email" name="email" placeholder="Saisissez le mail de l'utilisateur" required>
                </div>

                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" placeholder="Saisissez le nom de l'utilisateur">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Saisissez le prenom de l'utilisateur">
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe :</label>
                    <input type="text" id="mdp" name="mdp" placeholder="Saisissez le mot de passe de l'utilisateur">
                </div>

                <div class="form-group">
                    <label for="administrateur">Niveau d'Administration :</label>
                    <input type="number" id="administrateur" name="administrateur" placeholder="Saisissez le niveau de l'administration">
                </div>

                <div class="form-group">
                    <button type="submit" name="ajouter" class="button">Ajouter</button>
                    <button type="submit" name="supprimer" class="button">Supprimer</button>
                    <button type="submit" name="modifier" class="button">Modifier</button>
                </div>
            </form>
        </div>

        <div class="useradmin-container">
            <h1>Formulaire de Saisie du produit</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="idpr">Id produit :</label>
                    <input type="number" id="idpr" name="idpr" placeholder="Id du produit">
                </div>

                <div class="form-group">
                    <label for="nompr">Nom :</label>
                    <input type="text" id="nom" name="nompr" placeholder="Saisissez le nom du produit">
                </div>

                <div class="form-group">
                    <label for="prixpr">Prix :</label>
                    <input type="decimal" id="prixpr" name="prixpr" placeholder="Saisissez le prix du produit">
                </div>

                <div class="form-group">
                    <label for="stockpr">Stock :</label>
                    <input type="number" id="stockpr" name="stockpr" placeholder="Saisissez le stock du produit">
                </div>

                <div class="form-group">
                    <label for="categoriepr">Catégorie :</label>
                    <input type="text" id="categoriepr" name="categoriepr" placeholder="Saisissez la catégorie">
                </div>

                <div class="form-group">
                    <label for="descriptionpr">Description :</label>
                    <input type="text" id="cdescriptionpr" name="descriptionpr" placeholder="Saisissez la description du produit">
                </div>

                <div class="form-group">
                    <label for="imagepr">Image :</label>
                    <input type="file" accept="image/png, image/jpeg" id="imagepr" name="imagepr" title="Insérez l'image du produit">
                </div>

                <div class="form-group">
                    <button type="submit" name="ajouterpr" class="button">Ajouter</button>
                    <button type="submit" name="supprimerpr" class="button">Supprimer</button>
                    <button type="submit" name="modifierpr" class="button">Modifier</button>
                </div>
            </form>
        </div>
    </div>



    <?php

    //Utilisateurs Infos
    echo '<div class="container-tableau">';

    // First table (user)
    echo '<div class="table-container">';
    foreach ($user as $value) {
        echo '<div class="record">';
        echo '<div class="user-row" onclick="fillEmail(\'' . $value["email_user"] . '\')">';
        echo '<div class="record-heading">Utilisateur</div>';
        echo "Email: {$value["email_user"]} <br>";
        echo "Nom: {$value["nom_user"]} <br>";
        echo "Prénom: {$value["prenom_user"]} <br>";
        echo "Mot de passe: {$value["mdp_user"]} <br>";
        echo "Administrateur: {$value["admin_user"]} <br>";
        echo '</div>';
        echo '</div>'; // Close record div
    }
    echo '</div>'; // Close table-container div


    echo '<div class="table-container">';
    foreach ($produit as $value) {
        echo '<div class="record">';
        echo '<div class="user-row" onclick="fillProduit(\'' . $value["id_produit"] . '\')">';
        echo '<div class="record-heading">Produit</div>';
        echo "ID Produit: {$value["id_produit"]} <br>";
        echo "Nom Produit: {$value["nom_produit"]} <br>";
        echo "Prix Produit: {$value["prix_produit"]} <br>";
        echo "Stock Produit: {$value["stock_produit"]} <br>";
        echo "Catégorie Produit: {$value["categorie_produit"]} <br>";
        echo "Description Produit: {$value["description_produit"]} <br>";
        echo "Image Produit: {$value["img_produit"]} <br>";
        echo '</div>';
        echo '</div>';
    }

    echo '</div>'; // Close table-container div
    echo '</div>'; //

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

        if (isset($_POST["ajouter"])) {
            // Extraction des données du formulaire
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mdp = $_POST['mdp'];
            $administrateur = $_POST['administrateur'];

            // Prépare la requête SQL pour insérer des données
            $sql = "REPLACE INTO utilisateurs (email_user, nom_user, prenom_user,mdp_user,admin_user) VALUES (:email, :nom, :prenom, :mdp,:administrateur)";

            // Prépare la requête SQL en utilisant PDO
            $stmt = $conn->prepare($sql);

            // Liaison des valeurs des variables aux paramètres de la requête SQL
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':mdp', $mdp);
            $stmt->bindParam(':administrateur', $administrateur);

            // Exécute la requête SQL, insérant les données dans la table "livre"
            $stmt->execute();
            echo "<script> 
                    Swal.fire({
                    title: 'Super!',
                    text: `L'utilisateur {$nom} {$prenom} a bien été ajouté !`,
                    icon: 'success'
            }).then(function() {
                // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                 
                window.location.href = 'ControllerAdmin.php';
            
            });
            exit();
            </script>";
        } elseif (isset($_POST["supprimer"])) {
            // Extraction de l'ID à supprimer
            $id_user_a_supprimer = $_POST['email'];

            // Prépare la requête SQL pour supprimer une ligne de la table "abonne"
            $sql = "DELETE FROM utilisateurs WHERE email_user = :email";

            // Prépare la requête SQL en utilisant PDO
            $stmt = $conn->prepare($sql);

            // Liaison de l'ID à supprimer au paramètre de la requête SQL
            $stmt->bindParam(':email', $id_user_a_supprimer);

            // Exécute la requête SQL pour supprimer la ligne de la table "abonne"
            $stmt->execute();
            echo "<script> 
                    Swal.fire({
                    title: 'Super!',
                    text: `L'utilisateur {$id_user_a_supprimer} a bien été supprimé !`,
                    icon: 'success'
            }).then(function() {
                // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                 
                window.location.href = 'ControllerAdmin.php';
            
            });
            exit();
            </script>";
        } elseif (isset($_POST["modifier"])) {
            // Extraction des données du formulaire modifié
            $email_user = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mdp = $_POST['mdp'];
            $administrateur = isset($_POST['administrateur']) ? $_POST['administrateur'] : null;

            // Prépare la requête SQL pour mettre à jour l'utilisateur
            $sql_update = "UPDATE utilisateurs SET ";
            $sql_params = array();

            if (!empty($nom)) {
                $sql_params[] = "nom_user = :nom";
            }

            if (!empty($prenom)) {
                $sql_params[] = "prenom_user = :prenom";
            }

            if (!empty($mdp)) {
                $sql_params[] = "mdp_user = :mdp";
            }

            if (isset($administrateur)) {
                $sql_params[] = "admin_user = :administrateur";
            }

            // Construit la partie SET de la requête SQL
            $sql_update .= implode(", ", $sql_params);

            // Ajoute la clause WHERE
            $sql_update .= " WHERE email_user = :email_user";

            // Prépare la requête SQL en utilisant PDO
            $stmt_update = $conn->prepare($sql_update);

            // Liaison des paramètres de la requête SQL aux valeurs mises à jour
            $stmt_update->bindParam(':email_user', $email_user);

            if (!empty($nom)) {
                $stmt_update->bindParam(':nom', $nom);
            }

            if (!empty($prenom)) {
                $stmt_update->bindParam(':prenom', $prenom);
            }

            if (!empty($mdp)) {
                $stmt_update->bindParam(':mdp', $mdp);
            }

            if (isset($administrateur)) {
                $stmt_update->bindParam(':administrateur', $administrateur, PDO::PARAM_INT);
            }

            // Exécute la requête SQL pour mettre à jour l'utilisateur
            $stmt_update->execute();

            echo "<script> 
                Swal.fire({
                title: 'Super!',
                text: `L'utilisateur {$nom} {$prenom} a bien été modifié !`,
                icon: 'success'
              }).then(function() {
                  // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                  window.location.href = 'ControllerAdmin.php';
              });
              exit();
              </script>";

            // Assurez-vous de terminer le script après la redirection

        } else {
        }
    }

    //Produit

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

        if (isset($_POST["ajouterpr"])) {
            // Extraction des données du formulaire
            //$idpr = $_POST["idpr"];
            $nompr = $_POST["nompr"];
            $prixpr = $_POST["prixpr"];
            $stockpr = $_POST["stockpr"];
            $categoriepr = $_POST["categoriepr"];
            $descriptionpr = $_POST["descriptionpr"];
            $imagepr = $_POST["imagepr"];

            // Prépare la requête SQL pour insérer des données
            $sql = "REPLACE INTO produits (nom_produit, prix_produit,stock_produit,categorie_produit, description_produit, img_produit) 
        VALUES (:nompr, :prixpr, :stockpr,:categoriepr, :descriptionpr, :imagepr)";

            // Prépare la requête SQL en utilisant PDO
            $stmt = $conn->prepare($sql);

            // Liaison des valeurs des variables aux paramètres de la requête SQL
            //$stmt->bindParam(':idpr', $idpr);
            $stmt->bindParam(':nompr', $nompr);
            $stmt->bindParam(':prixpr', $prixpr);
            $stmt->bindParam(':stockpr', $stockpr);
            $stmt->bindParam(':categoriepr', $categoriepr);
            $stmt->bindParam(':descriptionpr', $descriptionpr);
            $stmt->bindParam(':imagepr', $imagepr);

            // Exécute la requête SQL, insérant les données dans la table "livre"
            $stmt->execute();
            echo "<script> 
                    Swal.fire({
                    title: 'Super!',
                    text: `Le produit {$nompr} a bien été ajouté !`,
                    icon: 'success'
            }).then(function() {
                // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                 
                window.location.href = 'ControllerAdmin.php';
            
            });
            exit();
            </script>";
        } elseif (isset($_POST["supprimerpr"])) {
            // Extraction de l'ID à supprimer
            $id_produit_a_supprimer = $_POST['idpr'];

            // Prépare la requête SQL pour supprimer une ligne de la table "abonne"
            $sql = "DELETE FROM produits WHERE id_produit = :idpr";

            // Prépare la requête SQL en utilisant PDO
            $stmt = $conn->prepare($sql);

            // Liaison de l'ID à supprimer au paramètre de la requête SQL
            $stmt->bindParam(':idpr', $id_produit_a_supprimer);

            // Exécute la requête SQL pour supprimer la ligne de la table "abonne"
            $stmt->execute();
            echo "<script> 
                    Swal.fire({
                    title: 'Super!',
                    text: `Le produit {$id_produit_a_supprimer} a bien été supprimé !`,
                    icon: 'success'
            }).then(function() {
                // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                 
                window.location.href = 'ControllerAdmin.php';
            
            });
            exit();
            </script>";
        } elseif (isset($_POST["modifierpr"])) {
            // Extraction des données du formulaire modifié
            $idpr = $_POST["idpr"];
            $nompr = $_POST["nompr"];
            $prixpr = $_POST["prixpr"];
            $stockpr = $_POST["stockpr"];
            $categoriepr = $_POST["categoriepr"];
            $descriptionpr = $_POST["descriptionpr"];
            $imagepr = $_POST["imagepr"];

            // Prépare la requête SQL pour mettre à jour le produit
            $sql_update = "UPDATE produits SET ";
            $sql_params = array();

            if (!empty($nompr)) {
                $sql_params[] = "nom_produit = :nompr";
            }

            if (!empty($prixpr)) {
                $sql_params[] = "prix_produit = :prixpr";
            }

            if (!empty($stockpr)) {
                $sql_params[] = "stock_produit = :stockpr";
            }

            if (!empty($categoriepr)) {
                $sql_params[] = "categorie_produit = :categoriepr";
            }

            if (!empty($descriptionpr)) {
                $sql_params[] = "description_produit = :descriptionpr";
            }

            if (!empty($imagepr)) {
                $sql_params[] = "img_produit = :imagepr";
            }

            // Construit la partie SET de la requête SQL
            $sql_update .= implode(", ", $sql_params);

            // Ajoute la clause WHERE
            $sql_update .= " WHERE id_produit = :idpr";

            // Prépare la requête SQL en utilisant PDO
            $stmt_update = $conn->prepare($sql_update);

            // Liaison des paramètres de la requête SQL aux valeurs mises à jour
            $stmt_update->bindParam(':idpr', $idpr);

            if (!empty($nompr)) {
                $stmt_update->bindParam(':nompr', $nompr);
            }

            if (!empty($prixpr)) {
                $stmt_update->bindParam(':prixpr', $prixpr);
            }

            if (!empty($stockpr)) {
                $stmt_update->bindParam(':stockpr', $stockpr);
            }

            if (!empty($categoriepr)) {
                $stmt_update->bindParam(':categoriepr', $categoriepr);
            }

            if (!empty($descriptionpr)) {
                $stmt_update->bindParam(':descriptionpr', $descriptionpr);
            }

            if (!empty($imagepr)) {
                $stmt_update->bindParam(':imagepr', $imagepr);
            }

            // Exécute la requête SQL pour mettre à jour le produit
            $stmt_update->execute();

            echo "<script> 
                Swal.fire({
                title: 'Super!',
                text: `Le produit {$nompr} a bien été modifié !`,
                icon: 'success'
              }).then(function() {
                  // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
                  window.location.href = 'ControllerAdmin.php';
              });
              exit();
              </script>";

            // Assurez-vous de terminer le script après la redirection

        } else {
        }
    }




    ?>

    <!-- Script JavaScript pour remplir l'email dans le formulaire au clic -->
    <script>
        function fillEmail(email) {
            document.getElementById('email').value = email;
        }

        function fillProduit(idProduit) {
            // Remplir le champ d'ID Produit dans le formulaire
            document.getElementById('idpr').value = idProduit;
        }
    </script>
</body>

</html>