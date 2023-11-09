<?php

  $serveur = 'localhost';
  $db = 'projet';
  $user = 'root';
  $pass = '';
  $conn = new PDO("mysql:host=$serveur;dbname=$db;charset=utf8", $user, $pass);

?>