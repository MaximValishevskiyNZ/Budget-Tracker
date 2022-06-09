<?php

class Connection {

public PDO $pdo;

public function __construct()
{
   $this->pdo = new PDO("mysql:server=localhost;dbname=budget", 'root', '');
}

public function getBudget()
{
   $statement = $this->pdo->prepare("SELECT * FROM `budget` ORDER BY `date` DESC");
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_ASSOC);
}

public function getBudgetInPeriod($startDate, $endDate) {
   $statement = $this->pdo->prepare("SELECT * FROM `budget` WHERE `date`>:startDate AND `date`<:endDate ORDER BY `date` DESC");
   $statement->bindValue('startDate', $startDate);
   $statement->bindValue('endDate', $endDate);
   $statement->execute();
   return $statement->fetchAll(PDO::FETCH_ASSOC);
}


public function addNote($note) {
   $statement = $this->pdo->prepare("INSERT INTO budget (`name`, `type`, `change`, `date`) VALUES (:name, :type, :change, :date)");
   $statement->bindValue('name',$note['name']);
   $statement->bindValue('type',$note['type']);
   $statement->bindValue('change',$note['change']);
   $statement->bindValue('date',date('Y-m-d H:i:s'));
   return $statement->execute();
}


}

return  new Connection();