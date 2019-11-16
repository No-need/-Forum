<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
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
    
    <form style="display:inline;" method="get" action="search.php"> 
        
        <input type="text" name="thing" onkeyup="getStates(this.value)" id="search" autocomplete="off" >    
        <input type="submit" value="收尋" name="submit"  >

        <div id="results" style="width:200px;background-color: white;display:none;margin-left: 330px; z-index: 300; position: fixed;"><ul></ul></div>    
    </form>
        
        <ul class="menulink" >
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
                <a href="">功能</a>
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

    <div align='center' valign='center' class="main_s">
    
    <?php
    
    date_default_timezone_set("PRC");
	echo '<div id="time"></div>
	<script type="text/javascript">
            var ts='.(round(microtime(true)*1000)).';        
            function get_obj(time){
				return document.getElementById(time);
			}
			
			function getTime(){
				var t=new Date(ts);
				with(t){
					var _time=""+getFullYear()+"-" + (getMonth()+1)+"-"+getDate()+" " + (getHours()<10 ? "0" :"") + getHours() + ":" + (getMinutes()<10 ? "0" :"") + getMinutes() + ":" + (getSeconds()<10 ? "0" :"") + getSeconds();
				}
				get_obj("time").innerHTML=_time;
				setTimeout("getTime()",1000);
				ts+=1000;
			}
			getTime();
	</script>';
    

        if(!isset($_SESSION['account'])){
            echo "<h1 style='font-size:100px; user-select: none; '>Welcome here</h1>";
        }else{
            echo " <h1 style='font-size:100px;color:black;user-select: none; '>Welcome $_SESSION[account]</h1>";
        }
    ?>
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