<?php
// permet de verifier les information de l'admin et de les utiliser
class TableController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		if($_SESSION['admin'] == 0)
		{
			header("location:https://fr.wikiversity.org/wiki/Le_piratage_informatique/Risques_juridiques");
		}

		 $new_account = new BookingModel();
		 $tables = $new_account->recupTableResa();
		 
		 return ['tables' => $tables];

		
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}