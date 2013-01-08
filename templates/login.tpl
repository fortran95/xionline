<!DOCTYPE HTML>
<html>
<head>
<title>Sandy - 身份认证</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="static/css/reset.css">
<link rel="stylesheet" type="text/css" href="static/css/structure.css">
<script src="static/js/common.js"></script>
</head>

<body>
{if isset($success)}
<div class="box loginmessage">
<strong>{$success}</strong> 已经登录成功。
<p><a href="index.php">如果页面没有自动跳转，请点击这里。</a>
</div>
<script>redirect(1000,'index.php');</script>
{elseif isset($error)}
<div class="box loginmessage">登录错误，请检查用户名和密码。</div>
<script>redirect(1000,'account.php');</script>
{else}
<form class="box login" method="post" action="account.php">
        <input type="hidden" name="action" value="login">
	<fieldset class="boxBody">
	  <label><a href="account.php?show=reg" class="rLink" tabindex="1">注册新用户</a>用户名</label>
	  <input type="text" name="username" tabindex="2" placeholder="在此输入您的用户名" required>
	  <label>密码</label>
	  <input type="password" name="password" tabindex="3" required>
	</fieldset>
	<footer>
	  <input type="submit" class="btnLogin" value="登录" tabindex="5">
	</footer>
</form>
{/if}
</body>
</html>
