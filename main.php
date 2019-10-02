<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="frame_style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>
    <div id="menu">
        <input type="button" value="回首頁" style="" target="change" onclick="location.href='main.php'">
        <input type="seach" id="search">    
        <input type="submit" value="search" onclick="">
        <ul class="menulink">
            <li>
                <a id="login" href="login.php" target="change">登入</a>
                </li>
            <li class="list">
                <a href="" >功能1</a>
                <ul>
                    <li><a href="">功能</a> </li>
                    <li><a href="">功能</a> </li>
                </ul>
                </li>
            <li class="list">
                <a href="" >功能222222</a>
                <ul>
                    <li><a href="">功能</a> </li>
                    <li><a href="">功能</a> </li>
                    <li><a href="">功能</a> </li>
                </ul>
                </li>
            <li class="list">
                <a href="" >功能3</a>
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
        <script type="text/javascript">
            $(document).ready(function(){
              $("#menuicon").click(function(){
              $(".dropdown").toggle(0);
              });
            });
        </script>
    </div>
    
    <iframe src="A_menu.html" frameborder="0" class="iframe_1" ></iframe>
    <iframe src="Login_screen.php" name="change" frameborder="0"  class="iframe_2"></iframe>

</body>
</html>