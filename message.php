<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>message</title>
    <?php
    echo "helloworld";/*
    $con = mysqli_connect('localhost','root','','test');//主機,帳號,密碼,資料庫/server,id,password,database
    if($con){
        echo "connect success";
    }
    if (!$con)
      {
      die('Could not connect: ' . mysqli_error());
      }
    mysqli_query($con , "set names utf8");
    if(isset($_POST["name"])){
        
        $name = $_POST['name'];
        $number = $_POST['number'];
        $message = $_POST['message'];
        // some code
        $sql = "INSERT INTO test1 ".
        "(name,number,message) ".
        "VALUES".
        "('$name','$number','$message')";
        mysqli_select_db( $con, 'test' );
        $retval = mysqli_query( $con, $sql );
        if(! $retval )
        {
          die('无法插入数据: ' . mysqli_error($con));
        }
          echo "数据插入成功\n";
          mysqli_close($con);
    }
*/
    echo  $_SESSION['account'];
    $mysqli = new mysqli("localhost","root","",'work');
    $mysqli->query("SET NAMES utf8"); 
    $sql ="INSERT INTO posts (title,content,account,views,created_at,updated_at) VALUES(?,?,?,?,?,?)";
    if(isset($_POST["title"])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $account =  $_SESSION['account'];
    $views = 0;
    $created_at = date('Y-m-d H:i:s');
    $updated_at =date('Y-m-d H:i:s');
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssssss',$title,$content,$account,$views, $created_at,$updated_at);
    $stmt->execute();
    }
    ?>

</head>
<body>
<form action="message.php" method="post">
<table border="1">
  <tr>
    <td><font size="2">title:</font></td>
    <td><input type="text" size="5" name="title"/></td>
  </tr>
  <tr>
    <td><font size="2">留言內容:</font></td>    
    <td>
       <textarea name="content" rows="4" cols="30"></textarea>
    </td>
  </tr>
  <tr>    
    <td colspan="2" align="center">
    <input type="submit" name="Send" value="送出留言"/>
    <input type="reset" name="Reset" value="重設欄位"/></td>
  </tr>
</table>
</form>
</body>
</html>