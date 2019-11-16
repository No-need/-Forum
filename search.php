
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主頁</title>
    <link rel="stylesheet" type="text/css" href="all_style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="search_box.js" type="text/javascript"></script>
</head>

<body onclick="hid_search()">
<div id="menu">
    
        <input type="button" value="回首頁" style="" target="change" onclick="location.href='main.php'" >
    
    <form style="display:inline;" method="get" action="search.php" > 
        
        <input type="text" name="thing" onkeyup="getStates(this.value)" id="search" autocomplete="off" >    
        <input type="submit" value="收尋" name="submit"  >

        <div id="results" style="width:200px;background-color: white;display:none;margin-left: 330px; z-index: 300; position: fixed;"><ul></ul></div>    
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
                <a href="sell.php">賣東西</a>
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
<div class="search_s">
<div>
<?php


    if(isset($_GET['thing'])){
        
        $db = mysqli_connect("localhost","root","","work");

        mysqli_query($db,"SET NAMES utf8");    
        $thing=$_GET['thing'];
        $result = mysqli_query($db,"SELECT * FROM sell where sellname LIKE \"%$thing%\"");
                
        while($row = mysqli_fetch_array($result)){
            echo "<div>".$row['sellname']."</div>";
            echo "<div>";
                echo "<img src='../".$row['graph']."'class=\"ph\"".">";
            echo "</div>";
            echo "<div>".$row['seller']."</div>";
            echo "<div>";    
                echo "<div>".$row['content']."</div>";
            echo "</div>";
        }
        echo'<div style="margin-top:100px;"></div>';
    }
    ?>
</div>
</div>
</body>
</html>