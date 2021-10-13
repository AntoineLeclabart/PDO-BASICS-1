<!doctype html>
<html lang="en">
<form method= POST>

    <label for="firstname">firstname</label>
    <input type="text" name="firstname" id="firstname">

    <label for="lastname">lastname</label>
    <input type="text" name="lastname" id="lastname">

    <button type="submit">submit</button>

</form>


<?php

require_once '.gitignore\connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

 if($_SERVER["REQUEST_METHOD"] === "POST")
 {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $pdo->prepare($query);

    $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);

    $statement->execute();
 }

 foreach($friends as $friends)
 {
     echo "<br>Firstname: ".$friends['firstname']." Lastname :" .$friends['lastname']; 
 }
?>