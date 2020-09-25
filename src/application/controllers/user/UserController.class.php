<?php

	class UserController
	{
		public function httpGetMethod(Http $http, array $queryFields)
		{
			/*
			* Méthode appelée en cas de requête HTTP GET
			*
			* L'argument $http est un objet permettant de faire des redirections etc.
			* L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
			*/
		}

		public function httpPostMethod(Http $http, array $formFields)
		{
			/*
			* Méthode appelée en cas de requête HTTP POST
			*
			* L'argument $http est un objet permettant de faire des redirections etc.
			* L'argument $formFields contient l'équivalent de $_POST en PHP natif.
			*/
			$values = [];
			
			$values['nom'] = $formFields['nom'];
			$values['prenom'] = $formFields['prenom'];
			$values['adresse'] = $formFields['adresse'];
			$values['date_de_naissance'] = $formFields['date_de_naissance'];
			$values['ville'] = $formFields['ville'];
			$values['code_postal'] = $formFields['code_postal'];
			$values['telephone'] = $formFields['telephone'];
			$values['e_mail'] = $formFields['e_mail'];
			$values['mot_de_passe'] = $formFields['mot_de_passe'];

		$new_account = new UserModel();
		$result = $new_account->create($values);
		}
	}