<?php
$db = mysqli_connect("localhost","root","","work");
mysqli_query($db,"SET NAMES utf8");
$partialState=$_POST['partialState'];

$result = mysqli_query($db,"SELECT sellname FROM sell WHERE sellname LIKE '%$partialState%'");
if($partialState!=NULL){
    while($state=mysqli_fetch_array($result)){
        echo ' 
        <div>'.$state['sellname'].'</div>
        '
        ;
    }
}
?>
