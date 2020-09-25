<?php

class ValidationController
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
			die();
		}
		// on recupère le session du panier
		$newPanier = $_SESSION['panier'];

		// on initialise la valeur du tableau
		$TotalPrice = 0;
		

		$new_account = new MealModel();
		// boucle for pour parcourir la session du panier
		for($i = 0; $i < count($newPanier); $i++)
		{
			// on recupere le prix de chaque produit du panier par rapport à son id
			$price = $new_account->getPriceById($newPanier[$i]['idProd']);
			// puis on calcule la valeur de tout les prix recuperer 
			$TotalPrice += $price * $newPanier[$i]['qttProd'];
		}
		
		// on passe sur la partie database on va inserer la session du panier dans la base de données
		$new_account = new CommandeModel();

		$datas = [
			"idUser" => $_SESSION['id'],
			"TotalPrice" => $TotalPrice
		];
		// on commence par tout les informations concernant le client
		$idCommande = $new_account->createComm($datas);// voir CommandeModel

		for($i = 0; $i < count($newPanier); $i++)
		{
			// sauvegarde des elements de la commande dans la table lignecommande
			$ligneDatas = 
			[
				"idCommande" => $idCommande,
				"IdMeal" => $newPanier[$i]['idProd'],
				"Quantites" => $newPanier[$i]['qttProd'], // qttProd regarde OrderController
				"Prix" => $newPanier[$i]['prixT']
			];
			// Puis on envoie toutes les informations concernant les produits commander
			$new_account->ligneComm($ligneDatas);// voir CommandeModel
			
		}
		// et on retourne le panier
		return ["newPanier" => $newPanier, "total"=>$TotalPrice];
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