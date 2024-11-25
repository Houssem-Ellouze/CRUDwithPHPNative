<?php

use Controller\Admin;

require_once '../Controller/AdminController.php';

$Admin = new Admin();
$admins = []; // Initialize to an empty array

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $admins = $Admin->searchAdmin($searchTerm); // Assign result of search
} else {
    $admins = $Admin->listAdmin(); // Assign result of player list
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Admins</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 300px;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #5bc0de;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #d9534f; /* Bootstrap danger color */
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Liste des Admins</h1>


<form action="ListAdmin.php" method="GET">
    <input type="text" name="search" placeholder="Rechercher un admin..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <input type="submit" value="Rechercher">
</form>

<!-- Display Player List -->
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>
    <?php if (is_array($admins) && count($admins) > 0) { ?>
        <?php foreach ($admins as $admin) { ?>
            <tr>
                <td><?= htmlspecialchars($admin['idAdmin']) ?></td>
                <td><?= htmlspecialchars($admin['nom']) ?></td>
                <td><?= htmlspecialchars($admin['prenom']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td><?= htmlspecialchars($admin['tel']) ?></td>
                <td class="actions">
                    <a href="deleteAdmin.php?id=<?= htmlspecialchars($admin['idAdmin']) ?>">Supprimer</a> |
                    <a href="updateAdmin.php?id=<?= htmlspecialchars($admin['idAdmin']) ?>">Modifier</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="6">Aucun Admin trouvé.</td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
