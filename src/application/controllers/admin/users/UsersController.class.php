<?php
// permet de recuperer les information gerer par l'user et de les affichers
class UsersController
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
		
		if(isset($queryFields['user']))
		{
			$newAut = 0;
			if($queryFields['Autorisation'] == "0")
			{
				$newAut = 1;
			}
			
			$autUser = new UserModel();
			$autUser->autorisationUser([$newAut,$queryFields['user']]);
		}
		


		$new_account = new UserModel();
		$users = $new_account->recupAllUsers();
		 
		return ["users" => $users];
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