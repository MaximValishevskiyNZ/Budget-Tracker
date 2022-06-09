<?php

session_start();

$connection = require_once("classes/connection.php");

if (isset($_SESSION['period'])) {
   $budget = $_SESSION['period'];
   session_destroy();
} else {
   $budget = $connection->getBudget();
}

$account = '0';
foreach($budget as $note) {
   $account = $account + $note['change'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   <title>Document</title>
</head>

<body>
   <header class="navbar bg-warning text-white">
      <div class="container">
         <h1>myBudget</h1>
      </div>
   </header>
   <div class="container">
      <form action="includes/periodSet.php" method="post" class="mt-3">
         <p>Show period:</p>
         <input type="date" name="startDate" id="">
         <input type="date" name="endDate" id="">
         <button type="submit" class="btn btn-primary">Set period</button>
      </form>
      <form action="includes/newStatement.php" method="post">
         <div class="mt-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="" list="typeList">
            <datalist id="typeList">
               <option value="Groceries">
               <option value="Salary">
               <option value="Savings">
               <option value="Eating out">
               <option value="Personal care">
               <option value="Entertainment">
               <option value="Insurance">
               <option value="Car payments">
               <option value="Mortgage payments or rent">
               <option value="Transportation costs">
            </datalist>
            <label for="change">Change</label>
            <input type="number" name="change" id="change" class="">
            <button type="submit" class="btn btn-primary opacity-75">New statement</button>
         </div>
      </form>
      <table class="table mt-3">
         <thead>
            <tr class="table-primary">
               <th>Name</th>
               <th>Type</th>
               <th>Date</th>
               <th>Change</th>
            </tr>
         </thead>
         <?php foreach($budget as $note) { ?>
         <tr class="table-secondary">
            <th><?=$note['name']?></th>
            <th><?=$note['type']?></th>
            <th><?=$note['date']?></th>
            <th><?=$note['change']?></th>
         </tr>
         <?php } ?>
         <div class="card mt-3 p-2">
            <p>On account: <?=$account?></p>
         </div>

      </table>
   </div>
</body>

</html>