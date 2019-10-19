<?php
        $id =$_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $updated_at =date('Y-m-d H:i:s');

        $mysqli = new mysqli("localhost","root","");
        $mysqli->select_db("work");
        $mysqli->query('SET NAMES utf8');
        $sql ="UPDATE posts SET title=?,content=?,updated_at=? where id=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sssi',$title,$content,$updated_at,$id);
        $stmt->execute();
        $row = mysqli_fetch_row($result);

?>