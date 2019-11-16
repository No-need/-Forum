<?php 
    session_start();
    $db = mysqli_connect("localhost","root","","work");
    $result = mysqli_query($db,"SELECT image,text FROM images");
    mysqli_query($db,"SET NAMES utf8");
    if(isset($_POST['upload'])){
       // $upload = $_POST['upload'];
        $image = $_FILES['image']['name'];
        $text = mysqli_real_escape_string($db, $_POST['text']);
        $account=$_SESSION['account'];
        $target = "../".$account."_".basename(date("Y_m_d_H_i_s").$image);
        $date = date("Y_m_d_H_i_s");
        
        
        $imgn = $account."_".basename(date("Y_m_d_H_i_s").$image);
        $sql = "INSERT INTO images(account,image,text) VALUES ('$account','$imgn','$text')";
        mysqli_query($db,$sql);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "上傳成功";
            //echo "<script>alert('$msg')</script>";
            
        }
        else{
            $msg = "上傳失敗";
            //echo "<script>alert('$msg')</script>";
        }
    }


?>
<html>
    <head>
    <link rel="icon" href="圖示網址/favicon.png" type="image/ico" />
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="all_style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <ul class="menulink">
            <li >
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
                <a href="" >留言板</a>
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
                <li class="selected"><a href="Personal_end.php">個人資料</a></li>                
                <li><a href="#">動態</a></li>
                <li><a href="#">好友</a></li>
                <li><a href="#">活動</a></li>
            </ul>
        </div>

        
        <div class="issue">
            <button class="btn">議題</button>
            <ul class="ul_2">
                <li><a href="#">學校</a></li>
                <li><a href="#">生活</a></li>
                <li><a href="#">工作</a></li>
            </ul>
        </div>
    </div>
    
    <script type="text/javascript">
        function updatetext(){
            var contenteditable = document.querySelector('[contenteditable]');
            var text = contenteditable.textContent;
            document.getElementById("demo").innerHTML = "123";
            location.href="Personal_end.php?savetext=" text;
        }
    </script>
        

        <script>
        var span=0;
        var x1=0;
        var x2=0;
        function t1(event){//按下滑鼠
            
            var e = event;
            x1 = e.clientX;
            var x = document.getElementsByClassName('show');
            var y = document.getElementsByClassName('upload_ph');
            var len2=parseInt(y[0].style.width.split('px'));//將獲取的width字串去掉單位轉成數字
            if(e.clientX<len2+180&&e.clientX>len2+140){
                span = 1;
                x[0].style.pointerEvents = 'none';
            }
            
        }

        function t2(event){//拉動
            var e = event;
            var x = document.getElementsByClassName('show');
            var y = document.getElementsByClassName('upload_ph');
            var len2=parseInt(y[0].style.width.split('px'));
            var x2 = e.clientX;
            var z = document.getElementById('content');
            
            if(e.clientX<len2+180&&e.clientX>len2+140){
               z.style.cursor = 'e-resize';  
            }else{
                z.style.cursor = 'default';  
            }
            if(span==1){
                len2 =  x2-160; 
                y[0].style.width = len2 + 'px';
                
            }
           /// alert('t2');
        }
        function t3(){//放開滑鼠
            var x = document.getElementsByClassName('show');
            span=0;
            x1 = 0;
            x[0].style.pointerEvents = 'auto';
            
        }   
        function delt_img(id){
            $.post('delete_image.php',{id:id});
            document.getElementById(id+'.img').style.display = 'none';
            document.getElementById(id+'.img.text').style.display = 'none';
        }
    </script>

<div id='content' style='height:100%;width:100%;' onmousedown="t1(event)" onmousemove='t2(event)'  onmouseup='t3()'  style='pointer-events: auto;'>
<div class="upload_ph" style='width:600px;height:100vh '>
            <?php
                
                $result = mysqli_query($db,"SELECT * FROM images");         
                while($row = mysqli_fetch_array($result)){
                    echo "<div id='$row[id].img'>";
                        echo "<img src='../".$row['image']."'class=\"ph\"".">";
                    echo "</div>";

                    echo "<div id='$row[id].img.text'>";    
                        echo "<div contenteditable=\"true\" >".$row['text']."</div>";
                        
                        if(isset($_SESSION['account'])){
                            if($_SESSION['account']==$row['account']||$_SESSION['account']=='root'){
                            echo '<input type="button" id="change" name="change" value="編輯" onclick="updatetext()">';
                            echo '<input type="button" id="delete" name="delete" value="刪除" onclick="delt_img('.$row['id'].')">';   //src=".png" class=\"ch_bt\"
                            echo '<input type="button" id="save" name="save" value="儲存" onclick="updatetext()">';
                            }
                        }
                    echo "</div>";
                }

            ?>

            <form method="POST" action="Personal_end.php" enctype="multipart/form-data">
                
                    <?php
                    if(!isset($_SESSION['account'])){
                        echo "請登入才能上傳檔案";
                    }
                    else{
                        echo '
                        <div>
                        <input type="file" name="image">
                        </div>
                        <div>
                            <textarea name="text" cols="40" rows="4" placeholder="描述這張圖"></textarea>
                        </div>
                        <div>
                            <input type="submit" name="upload" value="upload">
                        </div>
                        ';
                    }
                    ?>
                
            </form>
            <div style='margin-top:100px;'></div>
        </div>
                    

            <div class='show'  style='padding-left:5px;'>
                <iframe src="show.php" frameborder="0" class='show' style='overflow-x: hidden;overflow-y: scroll;height:100vh;width: 100%; '></iframe>
            </div>

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