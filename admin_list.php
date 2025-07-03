<?php
// Inclure le fichier de configuration
$config = include('config.php');

$admins = []; // Initialiser la variable $admins comme un tableau vide
$message = ""; // Initialisez la variable $message avec une chaîne vide

try {
    // Créer une connexion à la base de données
    $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
        // Supprimer un administrateur
        $deleteId = $_POST['delete_id'];

        $stmt = $pdo->prepare("DELETE FROM administrateurs WHERE idAdmin = :id");
        $stmt->execute(['id' => $deleteId]);
        $message = "Administrateur avec ID $deleteId supprimé avec succès.";
    }

    // Exécuter la requête pour récupérer la liste des administrateurs
    $stmt = $pdo->query("SELECT idAdmin, login FROM administrateurs");
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message d'erreur
    echo "Erreur: " . $e->getMessage();
}

// Fermer la connexion à la base de données
$pdo = null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of administrators</title>
    
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <style>
        .card {
            animation-duration: 1s;
        }

        .action-btn {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            margin: 5px;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }

        .action-btn .icon {
            margin-right: 8px;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .reset-btn {
            background-color: #ffc107;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease-in-out;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Ajout de l'animation pour le bouton de suppression */
        .delete-btn.animate {
            animation-duration: 0.5s;
            animation-name: fadeIn;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
         /* Vos styles CSS existants */
    
    /* Ajout de l'animation pour le bouton de suppression */
    .delete-btn.animate {
        animation-duration: 0.5s;
        animation-name: fadeIn;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    </style>
    <script>
        function resetPassword(adminId) {
            // Soumettre le formulaire de réinitialisation de mot de passe
            const form = document.getElementById(`reset-form-${adminId}`);
            form.submit();
        }

        function confirmDelete(event, adminId) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this administrator?')) {
                const form = document.getElementById(`delete-form-${adminId}`);
                // Ajouter la classe 'animate' pour déclencher l'animation
                const deleteBtn = document.querySelector(`.delete-btn[data-id="${adminId}"]`);
                deleteBtn.classList.add('animate');
                form.submit();
            }
        }

        window.addEventListener('DOMContentLoaded', (event) => {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.classList.add('animate__animated', 'animate__fadeInLeft');
            });

            const buttons = document.querySelectorAll('.action-btn');
            buttons.forEach(button => {
                button.classList.add('animate__animated', 'animate__pulse');
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">List of administrators</h1>

        <div class="mt-3 text-center">
            <a href="index.php" class="action-btn back-login-btn"><i class="bi bi-arrow-left icon"></i>Back to login</a>
            <a href="signup.php" class="action-btn add-admin-btn"><i class="bi bi-person-plus icon"></i>Add Admin</a>

        </div>

        <?php if ($message) : ?>
            <div class="alert alert-info mt-3"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div id="notification" class="alert alert-danger mt-3" style="display: none;"></div>

        <div class="row mt-3">
            <?php if (!empty($admins)) : ?>
                <div class="col-lg-12 mb-4">
                    <h2>Administrators</h2>
                </div>
                <?php foreach ($admins as $admin) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Admin ID: <?php echo htmlspecialchars($admin['idAdmin']); ?></h5>
                                <p class="card-text"><strong>Login:</strong> <?php echo htmlspecialchars($admin['login']); ?></p>
                                <div class="dropdown">
                                    <button class="action-btn reset-btn" onclick="resetPassword('<?php echo htmlspecialchars($admin['idAdmin']); ?>');"><i class="bi bi-key icon"></i>Reset</button>
                                    <!-- Ajout de la classe 'delete-btn' et l'attribut data-id -->
                                    <button class="action-btn delete-btn" onclick="confirmDelete(event, '<?php echo htmlspecialchars($admin['idAdmin']); ?>');" data-id="<?php echo htmlspecialchars($admin['idAdmin']); ?>"><i class="bi bi-trash icon"></i>Delete</button>
                                </div>
                                <form id="delete-form-<?php echo htmlspecialchars($admin['idAdmin']); ?>" action="admin_list.php" method="post" style="display:none;">
                                    <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($admin['idAdmin']); ?>">
                                </form>
                                <form id="reset-form-<?php echo htmlspecialchars($admin['idAdmin']); ?>" action="forgot_password.php" method="post" style="display:none;">
                                    <input type="hidden" name="idAdmin" value="<?php echo htmlspecialchars($admin['idAdmin']); ?>">
                                    <input type="hidden" name="username_or_email" value="<?php echo htmlspecialchars($admin['login']); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center">No administrators found.</p>
                <?php endif; ?>
        </div>
    </div>
    
    <!-- Ajoutez la bibliothèque jQuery et Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Ajoutez le modèle de confirmation JavaScript -->
    <script>
        function confirmDelete(event, adminId) {
            event.preventDefault();
            // Afficher le modèle de confirmation
            $('#confirmation-modal').modal('show');
            // Écouter le clic sur le bouton de confirmation de suppression
            $('#confirm-delete').click(function() {
                const form = document.getElementById(`delete-form-${adminId}`);
                const deleteBtn = document.querySelector(`.delete-btn[data-id="${adminId}"]`);
                deleteBtn.classList.add('animate');
                form.submit();
            });
        }
    </script>
    
    <!-- Ajoutez le modèle de confirmation HTML juste après le corps de votre document -->
    <div id="confirmation-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirm deletion?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
