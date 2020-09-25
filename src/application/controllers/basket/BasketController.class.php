<?php
// permet de recuperer et d'afficher le panier de l'utilisateur 
class BasketController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
		if(!isset($_SESSION['admin'])== 1)
		{
			header("location:https://fr.wikiversity.org/wiki/Le_piratage_informatique/Risques_juridiques");
		}

		$new_account = new CommandeModel();
		// la variable $coms servira dans le foreach
		$coms = $new_account->recupComm($_SESSION['id']);

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