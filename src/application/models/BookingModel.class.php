<?php
// sert à effectuer les requetes sql 
    class BookingModel
    {
        public function create(array $values)
        {
            $sql='
            INSERT INTO Booking
            (
                Date_de_reservation,
                Heure_de_reservation,
                Nombre_de_couverts,
                User_Id
                )VALUES(?,?,?,?
            )';
            $database = new Database();
            $database->executeSql($sql,
                [$values['date'],
                $values['time'],
                $values['couvert'],
                $values['id'],
                ]);
        }

        public function recupTableResa()
        {
            $sql= '
            SELECT `Commande`.`Id`, `User`.`Nom`, `User`.`Prenom`, `User`.`Id`AS IdUser, `Booking`.*
            FROM `Commande`
            LEFT JOIN `User` ON `Commande`.`IdUser` = `User`.`Id` 
            LEFT JOIN `Booking` ON `User`.`Id` = `Booking`.`User_Id` 
            LEFT JOIN `LigneCommande` ON `Commande`.`Id` = `LigneCommande`.`IdCommande` 
            ';
            $database = new Database();
            return $database->query($sql);
        }
}