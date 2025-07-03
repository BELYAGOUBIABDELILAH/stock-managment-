<?php
// Récupération des informations de connexion depuis config.php
$config = require 'config.php';

// Extraction des informations de connexion
$dsn = $config['dsn'];
$username = $config['username'];
$password = $config['password'];

// Création de la connexion à la base de données
try {
    $conn = new PDO($dsn, $username, $password);
    // Configuration pour afficher les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST["username_or_email"];
    $new_password = $_POST["new_password"];

    // Requête pour mettre à jour le mot de passe
    $update_query = "UPDATE administrateurs SET password = :password WHERE login = :username";

    // Préparation de la requête
    $stmt = $conn->prepare($update_query);
    
    // Liaison des paramètres
    $stmt->bindParam(':username', $username_or_email);
    $stmt->bindParam(':password', $new_password); // Utiliser directement le mot de passe saisi

    // Exécution de la requête
    try {
        $stmt->execute();
        // Redirection vers index.php après avoir réinitialisé le mot de passe avec succès
        header("Location: index.php");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } catch (PDOException $e) {
        echo "Error updating password: " . $e->getMessage();
    }
}
?>
