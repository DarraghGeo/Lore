<!DOCTYPE html>
<html>
<head>
	<title>dar.mx</title>
<style>
body{
	margin: 0px;
	padding: 0px;
}
img{
	position: absolute;
	left: 31%;
	top: 8%;
	width: 40%;
}

input{
	position: absolute;
	left: 50%;
	top: 50%;
	height: 1.5em;
	width: 15em;
	margin-top: -.75em;
	margin-left: -7.5em;
	padding: .5em;
	font-size: 1.5em;

}
</style>
</head>
<body>
<img src="/media/dar-logo2.svg"/>
<form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="password" placeholder="<?=$v['placeholder'];?>" name="password" id="password"/>
</form>
</body>
</html>

