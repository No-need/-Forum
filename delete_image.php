<?php
    
    $mysqli = new mysqli("localhost","root","")
        or die("無法與資料庫連接");
    $mysqli->query('SET NAMES utf8');
    $mysqli->select_db("work");
    $id = $_POST['id'];
    $result = $mysqli->query("SELECT * FROM images WHERE id = $id ");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    unlink("../$row[image]");
    $query= "DELETE FROM images WHERE id=$id ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
?>