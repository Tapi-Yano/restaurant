<?php
// permet de faire les reservation
class BookingController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		
		if(!isset($_SESSION['e_mail']))
		{
			header("location:https://fr.wikiversity.org/wiki/Le_piratage_informatique/Risques_juridiques");
		}
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
		
				$values['date'] = $formFields['date'];
				$values['time'] = $formFields['time'];
				$values['couvert'] = $formFields['couvert'];
				$values['id'] = $_SESSION['id'];
				
				$new_account = new BookingModel();
				$new_account->create($values);


    }
}