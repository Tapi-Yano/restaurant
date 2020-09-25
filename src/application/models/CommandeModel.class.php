<?php
// sert à effectuer les requetes sql 
    class CommandeModel
    {
        public function createComm(array $values)
        {
            // requête pour inserer la commande de l'user
            $sql='
            INSERT INTO Commande
            (
                IdUser,
                TotalPrice,
                DateOrder
                )VALUES(?,?,NOW()
            )';
            $database = new Database();
            return $database->executeSql($sql,
                [
                    $values['idUser'],
                    $values['TotalPrice']
                ]);
        
                // requête pour inserer les details de la commande de l'user
        } // fin de public function

        public function ligneComm(array $values)
        {
            $sql='
            INSERT INTO LigneCommande
            (
                IdCommande,
                IdMeal,
                Quantites,
                Prix
                )VALUES(?,?,?,?
            )';
            $database = new Database();
            $database->executeSql($sql,
                [
                    $values['idCommande'],
                    $values['IdMeal'],
                    $values['Quantites'],
                    $values['Prix']
                ]);
        
        } // fin du public function

        public function recupComm($idUser)
        {
            $sql='
            SELECT *
            FROM `Commande` WHERE IdUser = ?
            ';
            $database = new Database();
            // recuperation de tous les commandes 
            return $database->query($sql,[$idUser]);


        }

        public function recupLignCom($values)
        {
            $sql='
            SELECT `LigneCommande`.*, `Meal`.`Id`, `Meal`.`Name`
            FROM `LigneCommande`
            LEFT JOIN `Meal` ON `LigneCommande`.`IdMeal` = `Meal`.`Id` 
            WHERE  IdCommande= ?
            ';
            $database = new Database();
            return $database->query($sql,[$values]);
        }

        public function recupAllCom($values)
        {
            $sql='
            SELECT `Commande`.`Id`, `Commande`.*, `Meal`.`Name`, `Meal`.`Id`, `User`.`Nom`, `User`.`Prenom`, `User`.`Id`AS IdUser, `LigneCommande`.*
            FROM `Commande`
            LEFT JOIN `User` ON `Commande`.`IdUser` = `User`.`Id` 
            LEFT JOIN `LigneCommande` ON `Commande`.`Id` = `LigneCommande`.`IdCommande` 
            LEFT JOIN `Meal` ON `LigneCommande`.`IdMeal` = `Meal`.`Id`  
            ';
            $database = new Database();
            return $database->query($sql,[$values]);
            
        }
    }