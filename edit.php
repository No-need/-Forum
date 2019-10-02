<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯</title>
    <?php
    //$id = $_GET['id'];
    $id =1;
    $mysqli = new mysqli("localhost","root","");
    $mysqli->select_db("work");
    $mysqli->query('SET NAMES utf8');
    $result = $mysqli->query("SELECT * FROM posts where id = '$id'");
    $row = mysqli_fetch_row($result);
    echo $row[0].$row[1].$row[2];
    if(isset($_POST["title"])){
       
        $title = $_POST['title'];
        $content = $_POST['content'];
        $updated_at =date('Y-m-d H:i:s');
        $sql ="update message set title='$title,content=$content,updated_at=$updated_at, where id='$id'";
        $stmt = $mysqli->prepare($sql);
        
        $stmt->execute();
        }
    ?>
</head>
<body>
<form action="edit.php" method="post">
<table border="1">
  <tr>
    <td><font size="2">標題:</font></td>
    <td><input type="text" size="5" name="title" value="<?php echo $row[1]?>"></td>
  </tr>
  <tr>
    <td><font size="2">留言內容:</font></td>
    <td>
       <textarea name="content" rows="4" cols="30" ><?php echo $row[2]?></textarea>
    </td>
  </tr>
  <tr>    
    <td colspan="2" align="center">
    <input type="submit" name="Send" value="更新"/>
  </tr>
</table>    
</body>
</html>