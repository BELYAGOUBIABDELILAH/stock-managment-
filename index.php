<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini-Projet Web</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <!-- Ajout de Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #f0f2f5);
            animation: gradientAnimation 15s ease infinite alternate;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .animated-input {
            transition: transform 0.3s ease;
        }

        .animated-input.zoom-in:focus {
            transform: scale(1.05);
        }

        .animated-input.slide-up:focus {
            transform: translateY(-5px);
        }

        .animated-input.color-change:focus {
            background-color: #f0f0f0;
            border-color: #ccc;
        }

        .animated-input.jump:focus {
            animation: jump 0.3s ease;
        }

        @keyframes jump {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animated-input.rotate:focus {
            animation: rotate 0.3s ease;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0);
            }

            50% {
                transform: rotate(5deg);
            }

            100% {
                transform: rotate(0);
            }
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            border-bottom: 2px solid #007bff;
            color: #007bff;
        }

        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .form-check-inline {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-list {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5rem;
        }
        .white-icon {
    color: white;
}

    </style>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="animate__animated animate__fadeInLeft">
                    <div class="auth-logo d-flex justify-content-between align-items-center">
                        <a href="index.php">
                            <img src="assets/images/logo/kisspng-web-development-e-commerce-logo-electronic-busines-ecommerce-5ad142afc13966.5141508215236635357915.png" style="height: 60px;" alt="Logo">
                        </a>
                        <a href="admin_list.php" class="admin-list">
    <i class="bi bi-list-ul white-icon"></i>
</a>

                    </div>

                    <div class="tabs">
                        <div id="login-tab" class="tab active">Log in</div>
                    </div>

                    <div id="login-form" class="form-container active">
                        <h1 class="auth-title">Log in</h1>
                        <form action="Presentation/verifier.php" method="post">
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger" role="alert">Login ou password est incorrect!</div>
                            <?php unset($_GET); endif; ?>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl animated-input zoom-in" placeholder="Username" name="login" autofocus required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl animated-input slide-up" placeholder="Password" name="password" id="loginPasswordField" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                <span class="toggle-password" onclick="togglePasswordVisibility('loginPasswordField')">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="keepLogged" name="keepLogged"> Remember me
                                </label>
                            </div>
                            <input type="submit" value="Log in" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" class="animate__animated animate__fadeInRight">
                    <br><br>
                    <img src="assets/images/login.png" style="height: 600px;" alt="Logo">
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            var passwordField = document.getElementById(fieldId);
            var icon = passwordField.nextElementSibling.querySelector('i');
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
