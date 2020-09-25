<?php
class OrderModel
{
    public function listAll()
  {
      $sql='
      SELECT *
      FROM Meal
      ';
      $database = new Database();
      // recuperation de tous les produits alimentaires.
      return $database->query($sql);
  }
}