<?php 
session_start();
session_destroy();
echo '<script>alert("登出成功")</script>';
echo '<script type="text/javascript">top.location.href="main.php";</script>';

?>