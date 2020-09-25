<?php
// permet au client de se connecter ou de se deconnecter
class LoginController
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
			$values['e_mail'] = $formFields['e_mail'];
			$values['mdp'] = $formFields['mdp'];
			$new_account = new UserModel();
			$result = $new_account->recupChamps($values);
			if($result==false)
			{
				echo"Mail ou mot de passe incorrecte";
			}else
			{
				$_SESSION['connexion'] = true;
				$_SESSION['id'] = $result['Id'];
				$_SESSION['admin'] = $result['Admin'];
				$_SESSION['nom'] = $result['Nom'];
				$_SESSION['prenom'] = $result['Prenom'];
				$_SESSION['adresse'] = $result['Adresse'];
				$_SESSION['date_de_naissance'] = $result['Date_de_naissance'];
				$_SESSION['ville'] = $result['Ville'];
				$_SESSION['code_postal'] = $result['Code_postal'];
				$_SESSION['telephone'] = $result['Telephone'];
				$_SESSION['e_mail'] = $result['E_mail'];
				$http->redirectTo('/');
				// $http->redirectTo permet de rediriger la page
			}
			
	}
	
}


