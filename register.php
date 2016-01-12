<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta charset="utf-8">
<link href="css/login.css" rel='stylesheet' type='text/css' />
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
<input type="text" class="text" name="email" aria-label="邮箱" placeholder="邮箱">
<input type="password" value="" name="pwd" aria-label="密码" placeholder="密码" >
<input type="password" value="" name="pwd2" aria-label="再输一次" placeholder="再输一次" >
<div class="submit">

<input type="hidden" name="cmd" value="register">

<input type="submit" value="注册" >
</div>	
</form>

</div>
</div>
		
</body>
</html>
