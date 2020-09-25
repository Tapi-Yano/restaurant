<?php

class MealController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		if(array_key_exists('id',$queryFields))
		{
			if(ctype_digit($queryFields['id']))
			{
				$mealModel = new MealModel();
				$meal = $mealModel->find($queryFields['id']);
				$http->sendJsonResponse($meal);
			}
		}
		// en cas d'erreur, redirection vers la page d'accueil.
		$http->redirecTo('/');
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