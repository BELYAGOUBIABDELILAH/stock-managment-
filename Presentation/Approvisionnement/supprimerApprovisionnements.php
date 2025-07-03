<?php
include_once("C:xampp\htdocs\Mini\DAO\DAO.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $dao = new DAO();
    $dao->deleteApprovis($id);

    // Redirect to another page (replace 'new_page.php' with the desired page)
    header("Location: afficherApprovisionnements.php");
    exit(); // Make sure to exit after the header redirect to prevent further execution
} else {
    echo "Invalid request. Please provide a valid ID.";
}
?>