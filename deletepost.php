<?php
$id = $_POST['id'];
$mysqli = new mysqli("localhost","root","");
$mysqli->select_db("work");
$mysqli->query('SET NAMES utf8');
    $sql ="DELETE FROM posts WHERE id=$id";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();



    
?>


