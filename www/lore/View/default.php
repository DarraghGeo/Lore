<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link type="text/css" rel="stylesheet" href="/media/screen.css"/>
</head>
<body>
	<header id="masthead">
        <h1>Lore</h1>
	</header>
<?php
    for($i = 0; $i < count($v['article']); $i++){
?> 
        <article>
<?php
            echo $v['article'][$i];
?>
        </article>
<?php
    }
    if(count($v['article']) === 0)
    {
?>
        <article>
            <p class='notice'>Nothing Found.</p>
        </article>
<?php
    } 
?>
	<footer>
        <p>Powered by <span class='lore'>LORE</span>.</p>
	</footer>
</body>
</html>

