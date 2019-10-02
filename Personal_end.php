<?php

    $db = mysqli_connect("localhost","root","","work");
    $result = mysqli_query($db,"SELECT image,text FROM images");

    mysqli_query($db,"set name utf-8");
    
    if(isset($_POST['upload'])){
       // $upload = $_POST['upload'];
        $image = $_FILES['image']['name'];
        $text = mysqli_real_escape_string($db, $_POST['text']);

        $target = "../".basename($image);
        
        $id=mysqli_num_rows($result);
        $id++;
        $sql = "INSERT INTO images(id,image,text) VALUES ('$id','$image','$text')";
        
        $id++;
        mysqli_query($db,$sql);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg = "上傳成功";
            echo "<script>alert('$msg')</script>";
            
        }
        else{
            $msg = "上傳失敗";
            echo "<script>alert('$msg')</script>";
        }
    }
    if(isset($_POST['save'])){
        $change = mysqli_query($db,"UPDATE images SET $text ");
    }

?>
<html style="width:50%; margin-bottom:40px; border:1px solid red;">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="photo.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div>
            <?php
                
                $result = mysqli_query($db,"SELECT image,text FROM images");            
                while($row = mysqli_fetch_array($result)){
                    echo "<div>";
                        echo "<img src='../".$row['image']."'class=\"ph\"".">";
                    echo "</div>";

                    echo "<div>";    
                        echo "<input type=\"button\" name=\"change\" value=\"編輯\" onclick=\"updatetext()\">";
                        echo "<input type=\"button\" name=\"delete\" value=\"刪除\">";   //src=".png" class=\"ch_bt\"
                        echo "<div contenteditable=\"true\">".$row['text']."</div>";
                        echo "<input type=\"button\" name=\"save\" value=\"儲存\">";
                    echo "</div>";
                }
            ?>
            <form method="POST" action="Personal_end.php" enctype="multipart/form-data">
                
                <div>
                    <input type="file" name="image">
                </div>
                <div>
                    <textarea name="text" cols="40" rows="4" placeholder="描述這張圖"></textarea>
                </div>
                <div>
                    <input type="submit" name="upload" value="upload">
                </div>
            </form>
        </div>
    <script>
        function updatetext(){
            
        }
        
    </script>
    </body>
</html>