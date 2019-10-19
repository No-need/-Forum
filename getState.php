
    
<?php
$db = mysqli_connect("localhost","root","","work");
mysqli_query($db,"SET NAMES utf8");
$partialState=$_POST['partialState'];

$result = mysqli_query($db,"SELECT DISTINCT sellname FROM sell WHERE sellname LIKE '%$partialState%'");
$id=0;
if($partialState!=NULL){
    while($state=mysqli_fetch_array($result)){
        echo '<li class="list_1" onclick="text_on(this)" id="'.$id.'">'.$state['sellname'].'</li>';
        $id++;
    }
}
//<strong>.$partialState.</strong>
?>
