

<html>
<head>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">
    function getStates(value){
        $.post("getStates.php",{partialState:value},function(data){
            $("#results").html(data);
        });
    }
</script>
</head>
<body>
    
    <input type="text" onkeyup="getStates(this.value)"/><br>

    <div id="results"></div>

</body>
</html>