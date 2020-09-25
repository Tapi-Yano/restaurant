<?php
// permet de verifier les information de l'admin et de les utiliser
class AddmealController
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

		
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
	
		$values = array(
			
			"name" => $formFields['nom'],
			"description" => $formFields['description'],
			"photo" => $formFields['photos'],
			"QuantityInStock" => $formFields['prixAchat'],
			"buyPrice" => $formFields['prix'],
			"salePrice" => $formFields['quantites']
		);
					
		$new_account = new MealModel();
		$new_account->create($values);
		
		
		 
		
		
		



    }
}