<?php
// Include the configuration file
$config = include('config.php');

try {
    // Create a PDO instance
    $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Check if the login already exists
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM administrateurs WHERE login = ?");
        $stmt_check->execute([$login]);
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Redirect back with an error message if the login already exists
            header("Location: signup.php?error=login_exists");
            exit();
        }

        // If the login does not exist, proceed with insertion
        $stmt_insert = $pdo->prepare("INSERT INTO administrateurs (login, password) VALUES (?, ?)");
        $stmt_insert->execute([$login, $password]);

        // Redirect to dashboard.php on success
        header("Location: Presentation/dashboard.php");
        exit(); // Ensure no further code is executed
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;

?>
