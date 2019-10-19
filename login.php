<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登入</title>
    <link rel="stylesheet" type="text/css" href="all_style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    

<?php
if(isset($_POST['login'])){
$mysqli = new mysqli("localhost","root","")
or die("無法與資料庫連接");
$mysqli->select_db("work");
$mysqli->query('SET NAMES utf8');
$account = $_POST['account'];
$password = $_POST['password'];
$result = $mysqli->query("SELECT * FROM user where account = '$account'");
    if(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$password) || !preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$account)){    
        echo "帳號密碼輸入錯誤";    
    }
    else{
        $row = mysqli_fetch_row($result);
        if($account != null && $password != null && $row[1] == $account && $row[2] == $password){
            $_SESSION['account'] = $account;
            header("location: main.php");
        }
    }
}
?>
</head>
<script type="text/javascript">
    var now=0
    function getStates(value){
        key = event.keyCode;
        var show_put=document.getElementById("results");
        show_put.style.display="block";
        var slt=document.getElementsByClassName('list_1');
        var cht=document.getElementById("search");
        var len = slt.length;
        if(key==40){    
            if(now>0 && now<len){
                slt[now-1].style.color="black";
                slt[now-1].style.backgroundColor="white";
                slt[now].style.backgroundColor="rgba(0,0,0,0.5)";
                cht.value = slt[now].innerHTML;
                now++;
            }
            else if(now==len){
                slt[now-1].style.color="black";
                slt[now-1].style.backgroundColor="white";
                now=0;
                slt[now].style.backgroundColor="rgba(0,0,0,0.5)";
                cht.value = slt[now].innerHTML;
                now++;
            }
            else{
                slt[now].style.backgroundColor="rgba(0,0,0,0.5)";
                cht.value = slt[now].innerHTML;
                now++;
            }
        }
        else if(key==38){ //上
            //key.returnvalue=false;
            if(now==1){
                slt[now-1].style.color="black";
                slt[now-1].style.backgroundColor="white";
                slt[len-1].style.backgroundColor="rgba(0,0,0,0.5)";
                cht.value = slt[len-1].innerHTML;
                now=len;
            }
            else{
                now--;
                slt[now].style.color="black";
                slt[now].style.backgroundColor="white";
                slt[now-1].style.backgroundColor="rgba(0,0,0,0.5)";
                cht.value = slt[now-1].innerHTML;
            }
        }
        else if(key==39||key==37){
            
        }
        else{
            $.post("getState.php",{partialState:value},function(data){
                $("#results").html(data);
            });
        }
    }
    function text_on(clk_me){
        var cht=document.getElementById("search");
        cht.value = clk_me.innerHTML;
    }
    function hid_search(){
        //alert("sad");
        var show_put=document.getElementById("results");
        if(show_put.style.display=="block"){
            //alert("sad");
            show_put.style.display="none";
        }
    }
</script>


<body onclick="hid_search()">
<div id="menu">
        <input type="button" value="回首頁" style="" target="change" onclick="location.href='main.php'" >
    
    <form style="display:inline;" method="get" action="search.php"> 
        
        <input type="text" name="thing" onkeyup="getStates(this.value)" id="search" autocomplete="off" >    
        <input type="submit" value="收尋" name="submit"  >

        <div id="results" style="width:200px;background-color: white;display:none;margin-left: 330px; z-index: 300; position: fixed;"><ul></ul></div>    
    </form>
        
    
        <ul class="menulink">
            <li>
            <?php
                if(isset($_SESSION['account'])){
                    echo'<a href="unlogin.php" id="ch_bt">登出</a>';
                    
                }
                else{
                    echo'<a href="login.php" id="ch_bt">登入</a>';
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

    <div class="">
        <?php
        if(!isset($_SESSION['account'])){
        echo '
        <form name="form" method="post" action="login.php">
        <div class="login_s">
            <div class="Data-Content">
                <div class="Data-Title">
                    <div class="AlignRight">
                        <label for="ac"  class="">帳號:</label><br>
                        <label for="ps" class="">密碼:</label><br>
                    </div>
                </div>
                <div class="Data-Items">
                    <input type="text" id="ac" name="account" /> <br>
                    <input type="password" id="ps" name="password" /> 
                    <input type="submit" name="login" value="登入" />
                    <input type="button" name="sign" value="註冊" onclick="location.href=\'sign.php\'" />
                </div>
            </div> 
        </div>
        </form>';
        }
        else{
            header("location: main.php");
        }
        ?>
    </div>
</body>
</html>