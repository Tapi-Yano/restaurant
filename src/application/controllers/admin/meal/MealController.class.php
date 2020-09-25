<?php
// permet d'afficher le menu de la carte
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

		$new_account = new CommandeModel();
		// la variable $coms servira dans le foreach
		$coms = $new_account->recupAllCom($_SESSION['id']);
		
		for($i = 0; $i<count($coms); $i++)
		{
			// on récupère l'id de la commande
			$idCom = $coms[$i]["Id"];
			// puis on utilise une requête sql pour recuperer les info par rapport a l'id de la commande
			$tab = $new_account->recupLignCom($idCom);
			// on va stocker chaque details par rapport a l'id du produit dans une nouvelle du tableau $coms
			$coms[$i]["prod"]= $tab;

		}

		// il va recuperer chaque ligne de la table restaurant (Commande, User,LigneCommande) et le mettre dans le tableau $coms
		return ['coms'=> $coms];
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