<?php
// sert à effectuer les requetes sql 
    class UserModel
    {
    public function create(array $values)
    {
        $sql='
            INSERT INTO User
                (Nom,
                Prenom,
                Adresse,
                Date_de_naissance,
                Ville,
                Code_postal,
                Telephone,
                E_mail,
                Mot_de_passe,
                Admin,
                Autorisation)
            VALUES(?,?,?,?,?,?,?,?,?,0,0)
        ';
        $database = new Database();
        $database->executeSql($sql,
            [
            $values['nom'],
            $values['prenom'],
            $values['adresse'],
            $values['date_de_naissance'],
            $values['ville'],
            $values['code_postal'],
            $values['telephone'],
            $values['e_mail'],
            $values['mot_de_passe']
            ]);
    }
    public function recupChamps(array $values)
    {
        $sql='
        SELECT *
        FROM User
        WHERE E_mail=?
        ';
        $database = new Database();
        return $database->queryOne($sql,
    [$values['e_mail']]);
    }

    public function recupAllUsers()
    {
        $sql='
        SELECT *
        FROM User
        ';
        $database = new Database();
        return $database->query($sql); 
    }

    public function autorisationUser($values)
    {
        $sql='
        UPDATE User
        SET Autorisation = ?
        WHERE Id = ?
        ';
        $database = new Database();
        $database->executeSql($sql, $values);
    }
     

}  