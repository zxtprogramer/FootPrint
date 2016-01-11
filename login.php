<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<link href="css/main.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="main">
<div class="login-form">
<h1><a href="login.php">登录</a>  <a href="register.php">注册</a></h1>

<div class="head">
<img src="images/user.png" alt=""/>
</div>

<form action="index.php" method="POST">
<input type="text" class="text" name="name" aria-label="用户名" placeholder="用户名">
<input type="password" value="" name="pwd" aria-label="密码" placeholder="密码" >
<div class="submit">

<input type="hidden" name="cmd" value="login">

<input type="submit" value="登录" >
</div>	
</form>

</div>
</div>
		
</body>
</html>
