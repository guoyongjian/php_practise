
<?php
    $a = 999;
    ob_start();

?>
<!dochtml>
<html>
	<head>
		<meta charset='utf-8'>
	</head>
	<body>
		<h1>static guoyongjian</h1>
        <P><?php echo $a;?></P>
	</body>

</html>


<?php
    $file = './ceshi.html';
    $content = ob_get_clean();
    ob_end_clean();
    
    if(file_put_contents($file,$content)){
        echo '生成静态化成功';
    }else{
        echo 'error ';
    }
    
?>
