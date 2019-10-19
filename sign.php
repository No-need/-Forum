<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>註冊</title>

<link rel="stylesheet" type="text/css" href="all_style.css">

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>
<?php 

//require_once("checkEmail.php");

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
<body>

<script>
    function refresh_code(){ 
        document.getElementById("imgcode").src="madecode.php"; 
    } 
</script>
    <div id="menu">
            <input type="button" value="回首頁" style="" target="change" onclick="location.href='main.php'" >
        <form style="display:inline" method="post" action="main.php" > 
            <input type="search" name="thing" id="search">    
            <input type="submit" value="收尋" name="submit">
        </form>
            
        
            <ul class="menulink">
                <li>
                <?php
                    if(isset($_SESSION['account'])){
                        echo'<a href="unlogin.php" id="">登出</a>';
                        
                    }
                    else{
                        echo'<a href="login.php" id="">登入</a>';
                    }
                ?>
                </li>
                <li class="list">
                    <a href="" >功能1</a>
                    <ul>
                        <li><a href="">功能</a> </li>
                        <li><a href="">功能</a> </li>
                    </ul>
                    </li>
                <li class="list">
                    <a href="" >功能</a>
                    <ul>
                        <li><a href="">功能</a> </li>
                        <li><a href="">功能</a> </li>
                        <li><a href="">功能</a> </li>
                    </ul>
                    </li>
                <li class="list">
                    <a href="sell.php" target="change">賣東西</a>
                    </li>
                <li id="menuicon" >
                    <img  src="C:\Users\DELL\Desktop\新增資料夾\64.jpg" style="width: 50px;height: 50px;">
                    <ul style="display:none" class="dropdown">
                        <li>
                            <a href="">touch1</a></li>
                        <li>
                            <a href="">touch2</a></li>
                        <li>
                            <a href="">touch3</a></li>
                    </ul>  
                </li>

            </ul>
    </div>

    <div class="body_1">
        <div class="personal">
            <button1>個人</button1>
            <ul class="ul_1">
                <li><a href="Personal_end.php" id="" onclick="">個人資料</a></li>                
                <li><a href="#" id="" onclick="">動態</a></li>
                <li><a href="#" id="" onclick="">好友</a></li>
                <li><a href="#" id="" onclick="">活動</a></li>
            </ul>
        </div>

        
        <div class="issue">
            <button class="btn">議題</button>
            <ul class="ul_2">
                <li><a href="#" id="" onclick="">學校</a></li>
                <li><a href="#" id="" onclick="">生活</a></li>
                <li><a href="#" id="" onclick="">工作</a></li>
            </ul>
        </div>
    </div>


    <div class="" align="center">
        <form action="sign.php" method="post" class="">
        <div class="sign_s">
            <div class="Data-Content">
                <div class="Data-Title">
                        
                    <div class="AlignRight">
                        <label for="username" class="" >使用者:</label><br>
                        <label for="ac"  class="">帳號:</label><br>
                        <label for="ps" class="">密碼:</label><br>
                        <label for="againps" class="">再次確認密碼:</label><br>
                        <label for="em" class="">信箱:</label><br>
                        <label for="imgcode" class="">驗證碼:</label>
                        
                    </div>
                </div>
                    
                <div class="Data-Items">
                    
                    <input type="text" id="username" name="Name" class=""  value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" ><br>
                    <input type="text" id="ac" class="" name="account" value="<?php echo isset($_POST['account']) ? $_POST['account'] : '' ?>" ><br>
                    <input type="password" id="ps" name="password" class=""><br>
                    <input type="password" id="againps" name="againpassword" class=""><br>
                    <input type="text" id="em" name="email" class="" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" ><br>
                    <input type="text" id="imgcode" class="" name="checkcode">
                    <img id="imgcode" src="madecode.php" ><br>
                    <input type="submit" name="Insert" value="註冊"  class="">
                </div>
            </div>          
        </div>    
            <div class="">
                    
            <!--button onclick="refresh_code()"><img src="change.png" style="height:10px;width:10px;"></button-->
                
                </div>
        </form>
        
    </div>



    <script type="text/javascript">
        $(document).ready(function(){
            $('button1').click(function(){
                $('.ul_1').toggleClass('active1')
                    $('.personal').toggleClass('long1')
            });
                    
            $('button').click(function(){
                    $('.ul_2').toggleClass('active2')
            });

            $("#menuicon").click(function(){
                $(".dropdown").toggle(0);
            });

        })
    </script>
</body>
</html>