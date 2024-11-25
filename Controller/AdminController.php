<?php
namespace Controller;
require_once '../config.php';
use config;
use Exception;
use PDO;

class Admin {


    public function listAdmin() {
        $sql = "SELECT * FROM Admin";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function searchAdmin($searchTerm) {
        $db = config::getConnexion();
        try {
            $sql = "SELECT * FROM Admin WHERE nom LIKE :searchTerm OR prenom LIKE :searchTerm OR email LIKE :searchTerm";
            $query = $db->prepare($sql);
            $query->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }



    public function getAdminById($idAdmin) {
        $sql = "SELECT * FROM Admin WHERE idAdmin = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $idAdmin, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    public function updateAdmin($idAdmin, $nom, $prenom, $email, $tel) {
        $sql = "UPDATE Joueur SET nom = :nom, prenom = :prenom, email = :email, tel = :tel WHERE idJoueur = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $idAdmin, PDO::PARAM_INT);
            $query->bindValue(':nom', $nom);
            $query->bindValue(':prenom', $prenom);
            $query->bindValue(':email', $email);
            $query->bindValue(':tel', $tel);
            $query->execute();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function addAdmin($nom, $prenom, $email, $tel) {
        $db = config::getConnexion();
        try {

            $query = $db->prepare("INSERT INTO Admin (nom, prenom, email, tel) VALUES (:nom, :prenom, :email, :tel)");


            $query->bindValue(':nom', $nom);
            $query->bindValue(':prenom', $prenom);
            $query->bindValue(':email', $email);
            $query->bindValue(':tel', $tel);


            $query->execute();
        } catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
    public function deleteAdmin($idAdmin) {
        $sql = "DELETE FROM Joueur WHERE idAdmin = :id";
        $db = config::getConnexion();
        try {

            $query = $db->prepare($sql);
            $query->bindValue(':id', $idAdmin, PDO::PARAM_INT);
            $query->execute(); // Exécution de la requête
        } catch (Exception $e) {

            die('Erreur: ' . $e->getMessage());
        }
    }





}
