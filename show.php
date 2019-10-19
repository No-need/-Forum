<?php

session_start();
$mysqli = new mysqli("localhost","root","")
or die("無法與資料庫連接");
$mysqli->select_db("work");
$mysqli->query('SET NAMES utf8');
$result = $mysqli->query("SELECT * FROM posts ");

?>
<html >
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    function edit(id) {
        var x = document.getElementById(id+'.edit');
        var y = document.getElementById(id+'.store');
        var z = document.getElementById(id+'.delete');
        var p = document.getElementsByClassName(id);
        x.style.visibility="hidden";
        y.style.visibility="visible";
        z.style.visibility="visible";
        p[0].setAttribute("contenteditable", "true");
        p[1].setAttribute("contenteditable", "true");
    }
   </script>
    <script type="text/javascript">
    


    function store(id){
        var p = document.getElementsByClassName(id);
        var title = p[0].innerText;
        var content = p[1].innerText;
        $.post('store.php',{id:id,title:title,content:content});
        var x = document.getElementById(id+'.edit');
        var y = document.getElementById(id+'.store');
        var z = document.getElementById(id+'.delete');
        x.style.visibility="visible";
        y.style.visibility="hidden";
        z.style.visibility="hidden";
        p[0].setAttribute("contenteditable", "false");
        p[1].setAttribute("contenteditable", "false");
    }

    function delt(id){
        $.post('deletepost.php',{id:id});
        var x = document.getElementById(id+'.edit');
        var y = document.getElementById(id+'.store');
        var z = document.getElementById(id+'.delete');
        var p = document.getElementsByClassName(id);
        x.style.visibility="visible";
        y.style.visibility="hidden";
        z.style.visibility="hidden";
        p[0].setAttribute("contenteditable", "false");
        p[1].setAttribute("contenteditable", "false");
        document.getElementById(id+'.all').style.display = 'none';
    }
    </script>
<table style='margin-top:10%'>
<tr align="center">
<td >留言時間</td>
<td>標題</td>
<td>內容</td>
<td>username</td>
<td>觀看人數</td>    
</tr>
<?php

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    if(isset($_SESSION['account'])){
        if($_SESSION['account']==$row['account']||$_SESSION['account']=='root'){
            echo "
            <tr  align=\"center\" id='$row[id].all'>
                <td class='list' >
                    $row[created_at]
                </td>
                <td class='$row[id]' contenteditable=false>
                    $row[title]
                </td>
                <td class='$row[id]' contenteditable=false >
                    ".nl2br($row['content']).//將database內文章之\n轉換為<br>
                    "
                </td>
                <td>
                  $row[account]
                </td>
                <td>
                   $row[views]
                </td>
                <td>
                    <input type='button' id='$row[id].edit' onclick='edit($row[id])'  value='編輯'></input>
                    <input type='button' id='$row[id].store' onclick='store($row[id])' value='儲存' style='visibility:hidden'></input>
                    <input type='button' id='$row[id].delete' onclick='delt($row[id])' value='刪除' style='visibility:hidden'></input>
                </td>
                </tr>
            ";
        }else{
        echo "
        <tr align=\"center\">
            <td>
                $row[created_at]
            </td>
            <td>
                $row[title]
            </td>
            <td >
            ".nl2br($row['content']).//將database內文章之\n轉換為<br>
            "</td>
            <td>
              $row[account]
            </td>
            <td>
               $row[views]
            </td>
        </tr>
        ";
        }

    }else{
        echo "
        <tr align=\"center\">
            <td>
                $row[created_at]
            </td>
            <td>
                $row[title]
            </td>
            <td >"
            .nl2br($row['content']).//將database內文章之\n轉換為<br>
            "
            </td>
            <td>
              $row[account]
            </td>
            <td>
               $row[views]
            </td>
        </tr>
        ";
    }
}

?>
</table>

<div>
  <h1>發表新文章</h1>
    <form action="message.php" method="post" >
    <table border="1px" >
  <tr>
    <td><font size="2">title:</font></td>
    <td><input type="text" size="30" name="title"/></td>
  </tr>
  <tr>
    <td><font size="2">留言內容:</font></td>    
    <td>
       <textarea name="content" rows="10" cols="30"></textarea>
    </td>
  </tr>
  <tr>    
    <td colspan="2" align="center">
    <input type="submit" name="Send" value="送出留言"/>
    <input type="reset" name="Reset" value="重設欄位"/></td>
  </tr>
</table>
</form>
  </div>
</html>