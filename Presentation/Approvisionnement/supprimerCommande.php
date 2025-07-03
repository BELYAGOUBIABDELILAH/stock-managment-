<?php
include_once("C:xampp\htdocs\Mini\DAO\DAO.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dao = new DAO();
    $dao->deleteCommande($id);

    // Redirect to another page (replace 'new_page.php' with the desired page)
    header("Location: afficherCommandes.php");
    exit(); // Make sure to exit after the header redirect to prevent further execution
} else {
    echo "Invalid request. Please provide a valid ID.";
}
?>