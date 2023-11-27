<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/formConnexion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <title>Connexion</title>
</head>


<body>
    <div class="container-co-in">
        <div class="container-co">
            <div class="heading">Connexion</div>
            <form action="" class="formulaire" method="POST">
                <input ALT="Champ dans la partie Connexion pour votre Adresse E-mail" required class="input"
                    type="email" name="email" id="email" placeholder="E-mail" />
                <input ALT="Champ dans la partie Connexion pour votre Mot de passe" required class="input" type="text"
                    name="password" id="password" placeholder="Password" />
                <span class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </span>
                <input class="login-button" type="submit" value="Se Connecter" name="connexion"
                    ALT="Bouton Du formulaire de connexion vous connecter" />
            </form>
        </div>

        <div class="bordure">

        </div>
        <!-- INSCRIPTION UTILISATEURS -->
        <!-- <hr class="separation"> -->

        <div class="container-co">
            <div class="heading">Inscription</div>
            <form action="" class="formulaire" method="POST">
                <input ALT="Champ dans la partie Inscription pour votre adresse E-mail" required class="input"
                    type="email" name="email" id="email" placeholder="E-mail" />
                <input ALT="Champ dans la partie Inscription pour votre mot de passe" required class="input" type="text"
                    name="password" id="password" placeholder="Password" />
                <input ALT="Champ dans la partie Inscription pour votre nom" required class="input" type="text"
                    name="nom" id="nom" placeholder="Votre Nom" />
                <input ALT="Champ dans la partie Inscription pour Votre prénom" required class="input" type="text"
                    name="prenom" id="prenom" placeholder="Votre Prénom" />
                <input class="login-button" type="submit" value="S'inscrire" name="inscription"
                    ALT="Bouton Du formulaire d'inscription pour valider votre inscription" />
            </form>
        </div>
    </div>



    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

        if (isset($_POST["inscription"])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifier si l'e-mail existe déjà dans la base de données
            $existingEmailCheck = $conn->prepare("SELECT * FROM utilisateurs WHERE email_user = :email_user");
            $existingEmailCheck->bindParam(':email_user', $email);
            $existingEmailCheck->execute();

            if ($existingEmailCheck->rowCount() > 0) {
                // L'e-mail existe déjà, afficher un message d'erreur
                echo '<script>alert("Cette adresse est déjà existante, Veuillez en saisir une autre")</script>';
                echo '<script>
                    Swal.fire({
                    icon: "error",
                    title: "Email déjà utilisé",
                    text: "Cet email est déjà utilisé"
                    })
                </script>';
            } else {
                // L'e-mail n'existe pas, procéder à l'insertion ou à la mise à jour
                $sql = "REPLACE INTO utilisateurs (email_user, nom_user, prenom_user, mdp_user) VALUES (:email_user, :nom_user, :prenom_user, :mdp_user)";

                // Prépare la requête SQL en utilisant PDO
                $stmt = $conn->prepare($sql);

                // Lie les valeurs des variables aux paramètres de la requête SQL
                $stmt->bindParam(':email_user', $email);
                $stmt->bindParam(':nom_user', $nom);
                $stmt->bindParam(':prenom_user', $prenom);
                $stmt->bindParam(':mdp_user', $password);


                // Exécute la requête SQL, insérant ou mettant à jour les données dans la table "abonne"
                $stmt->execute();

                // Afficher un message de succès ou effectuer d'autres actions nécessaires
                echo '<script> 
                    Swal.fire({
                    title: "Super!",
                    text: "Vous êtes maintenant inscrit!",
                    icon: "success"
            })
            </script>';
            }
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO('mysql:host=localhost;dbname=superstore', 'root', 'root');

        if (isset($_POST["connexion"])) {
            $email = $_POST['email'];
            $motDePasse = $_POST['password'];


            // Vérifier si l'e-mail existe dans la base de données
            $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email_user = :email_user");
            $stmt->bindParam(':email_user', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // L'e-mail existe, vérifier le mot de passe
                $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
                $motDePasseStocke = $utilisateur['mdp_user'];

                // Vérifier si le mot de passe correspond
                if ($motDePasse === $motDePasseStocke) {
                    // Mot de passe correct, l'utilisateur est connecté
                    echo "Connexion réussie !";
                    echo "<script> 
        Swal.fire({
            title: 'Super!',
            text: 'Vous êtes maintenant connecté!',
            icon: 'success'
        }).then(function() {
            // Rediriger l'utilisateur vers une page de succès ou accueil après le clic sur le bouton 'OK'
             
            window.location.href = 'ControllerConnexion.php';
        
        });
    </script>";

                    // Stocker des informations de l'utilisateur en session
                    $_SESSION['utilisateur_email'] = $utilisateur['email_user'];

                    // Vérifier si l'utilisateur est administrateur et stocker cette information en session
                    $_SESSION['utilisateur_est_admin'] = $utilisateur['admin_user'];


                } else {
                    // Mot de passe incorrect
                    echo "Mot de passe incorrect.";
                    echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops ...",
                        text: "Mot de passe incorrect"
                    })
                </script>';
                }
            } else {
                // L'e-mail n'existe pas dans la base de données
                echo "Aucun utilisateur trouvé avec cet e-mail.";
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops",
                    text: "Aucun utilisateur avec cette adresse mail"
                })
            </script>';
            }
        }
    }


    ?>



</body>

</html>