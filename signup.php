<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Mini-Projet Web</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <!-- Ajout de Animate.css -->
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

        /* Animation de Changement de Couleur */
        .animated-input.color-change:focus {
            background-color: #f0f0f0; /* Couleur de fond modifiée */
            border-color: #ccc; /* Couleur de bordure modifiée */
        }

        /* Animation de Saut */
        .animated-input.jump:focus {
            animation: jump 0.3s ease;
        }
        @keyframes jump {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        /* Animation de Rotation */
        .animated-input.rotate:focus {
            animation: rotate 0.3s ease;
        }
        @keyframes rotate {
            0% { transform: rotate(0); }
            50% { transform: rotate(5deg); }
            100% { transform: rotate(0); }
        }
    </style>
</head>

<body>
    <div id="auth" class="animate__animated animate__fadeIn">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="animate__animated animate__fadeInLeft">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/kisspng-web-development-e-commerce-logo-electronic-busines-ecommerce-5ad142afc13966.5141508215236635357915.png" style="height: 60px;" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Sign Up</h1>
                    <form action="register_admin.php" method="post" class="animate__animated animate__fadeIn">
                        <?php
                            if (isset($_GET['error'])) {
                                echo '<div class="alert alert-danger" role="alert">
                                Ce nom administrateur existe déjà.!
                                </div>';
                                unset($_GET);
                            }
                        ?>    
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl animated-input zoom-in" placeholder="Username" name="login" autofocus required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl animated-input slide-up" placeholder="Password" name="password"  required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <input type="submit" value="Sign Up" class="btn btn-primary btn-block btn-lg shadow-lg mt-5 animate__animated animate__fadeIn">
                    </form>
                    <div class="mt-3 text-center animate__animated animate__fadeIn">
                        <p>Get Back To <a href="index.php">Log in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" class="animate__animated animate__fadeInRight">
                    <br>
                    <br>
                    <br>
                    <img src="assets/images/login.png" style="height: 600px;" alt="Logo">
                </div>
            </div>
        </div>
    </div>
</body>

</html>


