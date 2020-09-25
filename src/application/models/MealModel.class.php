<?php
// sert à effectuer les requêtes sql
class MealModel
{
  public function create($values)
  {
      $sql='
      INSERT INTO Meal
      (
        Id,
        Name,
        Description,
        Photo,
        QuantityInStock,
        BuyPrice,
        SalePrice
        )VALUES(NULL,?,?,?,?,?,?
      )';
      $database = new Database();
      $database->executeSql($sql,
      [$values['name'],
      $values['description'],
      $values['photo'],
      $values['QuantityInStock'],
      $values['buyPrice'],
      $values['salePrice']
      ]);
  }
  public function find($mealId)
  {
      $sql='
      SELECT 
      Name,
      Description,
      Photo,
      BuyPrice,
      SalePrice
      FROM Meal
      WHERE Id=?
    ';
    $database = new Database();
    $database->queryOne($sql,[$mealId]);
  }
  public function listAll()
  {
      $sql='
      SELECT *
      FROM Meal
      ';
      $database = new Database();
      // recuperation de tous les produits du restau.
      return $database->query($sql);
  }
  public function getPriceById($Idprod)
  {
    $sql='
    SELECT SalePrice
    FROM Meal
    WHERE id=?
    ';
    $database = new Database();
    // recuperation du prix par produit dans la table Meal.
    $resultat = $database->queryOne($sql,[$Idprod]);
    return $resultat['SalePrice'];
  }
}


