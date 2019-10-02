<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>登入</title>
<?php
if(isset($_POST['login'])){
$mysqli = new mysqli("localhost","root","")
or die("無法與資料庫連接");
$mysqli->select_db("work");
$mysqli->query('SET NAMES utf8');
$account = $_POST['account'];
$password = $_POST['password'];
$result = $mysqli->query("SELECT * FROM user where account = '$account'");
$row = mysqli_fetch_row($result);
if($account != null && $password != null && $row[1] == $account && $row[2] == $password){
    $_SESSION['account'] = $account;
    echo $_SESSION['account']."登入成功";
    header("main.php");
}else{
    echo "登入失敗";
}
}
?>
</head>
<body>
<?php
if($_SESSION['account']==null){
echo '
<form name="form" method="post" action="login.php">
帳號：<input type="text" name="account" /> <br>
密碼：<input type="password" name="password" /> <br>
<input type="submit" name="login" value="登入" />&nbsp;&nbsp;
</form>';
}else{
    header("location: main.html");
}
?>
</body>
</html>