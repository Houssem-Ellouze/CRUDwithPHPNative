<?php

use Controller\Admin;

require_once '../Controller/AdminController.php';


if (isset($_GET['id'])) {
    $idAdmin = $_GET['id'];

    $Admin = new Admin();
    $Admin->deleteAdmin($idAdmin);

    // Redirection vers la liste des joueurs après suppression
    header('Location: ListAdmin.php');
    exit();
} else {
    echo "ID du Admin non spécifié.";
}

