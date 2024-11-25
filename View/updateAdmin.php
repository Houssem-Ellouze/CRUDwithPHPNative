<?php

require_once '../Controller/AdminController.php';

use Controller\Admin;


if (isset($_GET['id'])) {
    $idAdmin = $_GET['id'];


    $Admin = new Admin();
    $admin = $Admin->getJoueurById($idAdmin);

    if ($admin) {

        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mettre à jour le admin</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f7f7f7;
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }

                form {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    max-width: 400px;
                    width: 100%;
                }

                label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: bold;
                    color: #333;
                }

                input[type="text"],
                input[type="email"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 20px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                input[type="text"]:focus,
                input[type="email"]:focus {
                    border-color: #4CAF50;
                    outline: none;
                }

                button {
                    width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    font-size: 16px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #45a049;
                }

                .error-message {
                    color: red;
                    margin-bottom: 15px;
                }

            </style>
        </head>
        <body>
        <form action="updateAdmin.php" method="POST">
            <input type="hidden" name="idAdmin" value="<?= htmlspecialchars($admin['idAdmin']) ?>">

            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($admin['nom']) ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($admin['prenom']) ?>" required>

            <label for="email">Email :</label>
            <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required>

            <label for="tel">Téléphone :</label>
            <input type="text" name="tel" value="<?= htmlspecialchars($admin['tel']) ?>" required>

            <button type="submit" name="update">Mettre à jour</button>
        </form>
        </body>
        </html>
        <?php
    } else {
        echo "<p class='error-message'>Admin non trouvé.</p>";
    }
} elseif (isset($_POST['update'])) {

    $idAdmin = $_POST['idAdmin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];


    $Admin = new Admin();
    $Admin->updateAdmin($idAdmin, $nom, $prenom, $email, $tel);

    // Redirection après mise à jour
    header('Location: ListAdmin.php');
    exit();
}
?>
