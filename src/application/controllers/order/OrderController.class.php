<?php
class OrderController
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
		}else
		{
			$mealProduct = new OrderModel();
				$products = $mealProduct->listAll();
				// il va recuperer chaque ligne de la table restaurant(Meal) et le mettre dans un tableau 
				return ['products'=> $products];
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
		/* Etape à suivre: 
		1-recuperer le contenu du post
		2- tester si ma session existe
			=> creér s'il existe pas
		3- ajoiuter les données récupérer dans ma session
		4- returne ma liste		
		*/
		if(!isset($formFields['idSupp']))
		{

		// 1- recuperer le contenu		
			$idProd= $formFields['idProd'];
			
			$name= $formFields['name'];

			$prixT= $formFields['prixT'];

			$qttProd= $formFields['qttProd'];

			$prixTotal= $qttProd*$prixT;

			$product = array
			(
				"idProd" => $idProd,
				"name" => $name,
				"prixT" => $prixTotal,
				"qttProd" => $qttProd,
				// "prixTotal" => $prixTotal,
			);
			// tableau qui va sauvergarder tout mes produits avec la qttProd
			$saveTabPanier = array();

			if(isset($_SESSION['panier']))
			{
				$saveTabPanier = $_SESSION["panier"];
			}

				$verifUpdateprod = false;
			// on verifie que l'idProd n'existe pas dans mon panier
			for($i = 0; $i < count($saveTabPanier); $i++)
			{
				// recuperer un produit(id+qtt)
				$prod = $saveTabPanier[$i];

				// tester si l'idProd envoyer a partir du webservice est le meme que celui de la cellule
				if($prod['idProd']== $idProd)
				{
					// methode1
					$prod["qttProd"] += $qttProd;
					$prod["prixT"] += $prixTotal;

					$saveTabPanier[$i] = $prod;
					// methode2
					// $saveTabPanier[$i]["qttProd"] += $qttProd;
					$verifUpdateprod = true;
				}
			}


			if($verifUpdateprod == false)
			{
				array_push($saveTabPanier, $product);
			}
				
	
	
				$_SESSION["panier"] = $saveTabPanier;
	

				// die permet d'arreter le chargement de la page une fois les paramètre verifier entre les ()
	
				die(json_encode($saveTabPanier)); // pk die :
			
		
		}
		else
		{
			$idSupp = $formFields['idSupp'];

			$saveTabPanier = array();

				if(isset($_SESSION['panier']))
				{
					$saveTabPanier = $_SESSION["panier"];
				}

				$newPanier = array();

				for($i = 0; $i < count($saveTabPanier); $i++)
				{
						$prod = $saveTabPanier[$i];
					if($prod['idProd'] != $idSupp)
					{
						array_push($newPanier,$prod);
					}
				
				}	 // fin for	

			$_SESSION["panier"] = $newPanier;

				if(count($newPanier)==0)
				{
					unset($_SESSION["panier"]);
				}

			die(json_encode($newPanier));
		}
	}
}