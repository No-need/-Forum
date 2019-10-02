<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="form.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<title>註冊</title> 
</head>
<?php 
session_start();


require_once("checkEmail.php");
if (isset($_POST["Insert"])){
    $mysqli = new mysqli("localhost","root","")
        or die("無法與資料庫連接");
    $mysqli->select_db("work");
    $mysqli->query('SET NAMES utf8');

    $sql ="INSERT INTO user (username,account,passwords,email) VALUES(?,?,?,?)";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("ssss",$name,$account,$password,$email);
        $name = $_POST['Name'];
        $account = $_POST['account'];
        $password = trim($_POST['password']);
        $agpassword = trim($_POST['againpassword']);
        $email = $_POST['email'];  
        
        $result1 = $mysqli->query("SELECT username FROM user WHERE username='$name'");
        $count1 = $result1->num_rows;

        $result2 = $mysqli->query("SELECT account FROM user WHERE account='$account'");
        $count2 = $result2->num_rows;
        if($account==''||$name==''||$password==''){
            echo "帳號密碼ID不能為空格";
        }        
        elseif($count1>0){
            echo "ID已有人註冊";
        }
        elseif($count2>0){
            echo "帳號已有人註冊";
        }
        elseif($account==$password){
            echo "帳號密碼請勿相同";
        }
        
        elseif(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$password) || !preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$account)){    
            echo "帳號密碼必須由字母數字組合";    
        }
        elseif(strlen($password)<=8 || strlen($account)<=8){
            echo "帳號密碼長度請大於8";
        }
        elseif($password != $agpassword){
            echo '密碼配對不正確';   
        }         
        elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
            echo "email格式錯誤";
        }
        elseif(checkemail("$email") == false) {
            echo "您輸入的email不正確";
        }
        elseif($_SESSION['check_code'] != $_POST['checkcode']){
            echo '驗證碼輸入錯誤';
        }else
        {
            
            $stmt->execute();

            echo '<script>alert("註冊成功")</script>';
            
        }
        $stmt->close();
        
    }
    else{
        exit("註冊失敗");
    }
    $mysqli->close();
}
?>
<body style="align:center;">
<script>
    function refresh_code(){ 
        document.getElementById("imgcode").src="madecode.php"; 
    } 
</script>

<div class="card-body">
    <form action="sign.php" method="post" class="">

    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right" >使用者:</label>
        <div class="col-md-3">
            <input type="text" id="username" name="Name" class="form-control"  value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" >
        </div>
    </div>

    <div class="form-group row">
        <label for="ac"  class="col-md-4 col-form-label text-md-right">帳號:</label>
        <div class="col-md-3">
        <input type="text" id="ac" class="form-control" name="account" value="<?php echo isset($_POST['account']) ? $_POST['account'] : '' ?>" >

        </div>
    </div>

    <div class="form-group row">
        <label for="ps" class="col-md-4 col-form-label text-md-right">密碼:</label>
        <div class="col-md-3">
        <input type="password" id="ps" name="password" class="form-control">
        </div>
    </div>


    <div class="form-group row">
         <label for="againps" class="col-md-4 col-form-label text-md-right">再次確認密碼:</label>
        <div class="col-md-3">
        <input type="password" id="againps" name="againpassword" class="form-control">
        </div>
    </div>

    

    <div class="form-group row">
        <label for="em" class="col-md-4 col-form-label text-md-right">信箱:</label>
        <div class="col-md-3">
        <input type="text" id="em" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" >
        </div>
    </div>
    
    <div class="form-group row">
        <label for="em" class="col-md-4 col-form-label text-md-right">驗證碼:</label>
        
        <div class="col-md-3">
           <input type="text" class="form-control" name="checkcode"> 
           <div class="col-md-8 offset-md-4">
 <img id="imgcode" src="madecode.php" >
        <!--button onclick="refresh_code()"><img src="change.png" style="height:10px;width:10px;"></button-->
    
           </div>
              </div>
    </div>


<input type="submit" name="Insert" value="註冊"  class="col-md-2 offset-md-4">



</form>
</div>

</body>
</html>