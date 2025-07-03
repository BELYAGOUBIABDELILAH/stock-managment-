<?php
// Inclure le fichier de configuration
$config = include('config.php');

$message = ""; // Initialiser la variable $message
$adminFound = false;
$admin = null;

try {
    // Créer une connexion à la base de données
    $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username_or_email'])) {
        // Rechercher un administrateur par son nom ou email
        $usernameOrEmail = $_POST['username_or_email'];

        $stmt = $pdo->prepare("SELECT idAdmin, login FROM administrateurs WHERE login = :login");
        $stmt->execute(['login' => $usernameOrEmail]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $adminFound = true;
        } else {
            $message = "No admin found with this name.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_password'], $_POST['idAdmin'])) {
        // Mettre à jour le mot de passe de l'administrateur
        $newPassword = $_POST['new_password'];
        $idAdmin = $_POST['idAdmin'];

        // Réinitialiser le mot de passe
        $stmt = $pdo->prepare("UPDATE administrateurs SET password = :password WHERE idAdmin = :id");
        $stmt->execute(['password' => $newPassword, 'id' => $idAdmin]);
        $message = "Password reset for ID: " . htmlspecialchars($idAdmin);

        // Redirection vers index.php
        header("Location: index.php");
        exit(); // Assure que le script s'arrête après la redirection
    }
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message d'erreur
    $message = "Erreur: " . $e->getMessage();
}

// Fermer la connexion à la base de données
$pdo = null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Mini-Projet Web</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <!-- Ajouter le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Ajouter les animations animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Ajoutez vos styles personnalisés ici si nécessaire */
        .animated-input {
            transition: transform 0.3s ease;
        }

        /* Animation de Zoom In */
        .animated-input.zoom-in:focus {
            transform: scale(1.05);
        }

        /* Animation de Glissement vers le haut */
        .animated-input.slide-up:focus {
            transform: translateY(-5px);
        }

        /* Ajout de style pour le toggle */
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="animate__animated animate__fadeInLeft">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/kisspng-web-development-e-commerce-logo-electronic-busines-ecommerce-5ad142afc13966.5141508215236635357915.png" style="height: 60px;" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Forgot Password</h1>

                    <!-- Afficher le message -->
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>

                    <?php if ($adminFound): ?>
                        <div class="table-responsive animate__animated animate__fadeIn">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID Admin</th>
                                        <td><?php echo htmlspecialchars($admin['idAdmin']); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Login</th>
                                        <td><?php echo htmlspecialchars($admin['login']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <form action="forgot_password.php" method="post" class="animate__animated animate__fadeIn" id="resetPasswordForm">
                            <input type="hidden" name="idAdmin" value="<?php echo htmlspecialchars($admin['idAdmin']); ?>">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl animated-input zoom-in" placeholder="New Password" name="new_password" id="new_password" autofocus required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                <!-- Toggle pour afficher/masquer le mot de passe -->
                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>

                            <input type="submit" value="Reset Password" class="btn btn-primary btn-block btn-lg shadow-lg mt-5 animate__animated animate__fadeIn">
                        </form>
                    <?php else: ?>
                        <form action="forgot_password.php" method="post" class="animate__animated animate__fadeIn">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl animated-input slide-up" placeholder="Username" name="username_or_email" autofocus required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>

                            <input type="submit" value="Search Admin" class="btn btn-primary btn-block btn-lg shadow-lg mt-5 animate__animated animate__fadeIn">
                        </form>
                    <?php endif; ?>
                    <div class="mt-3 text-center">
                        <!-- Remplacement de la ligne "Remember your password?" -->
                        <p><a href="index.php"><i class="bi bi-arrow-left"></i> Back to Login</a></p>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" class="animate__animated animate__fadeInRight">
                    <br>
                    <br>
                    <img src="assets/images/login.png" style="height: 600px;" alt="Logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Ajouter les scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.querySelector('#new_password');
            var icon = document.querySelector('.toggle-password i');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordField.type = "password";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>

</html>






