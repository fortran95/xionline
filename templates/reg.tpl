
<!DOCTYPE HTML>
<html>
<head>
<title>Sandy - 注册新用户</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="static/css/reset.css">
<link rel="stylesheet" type="text/css" href="static/css/structure.css">
<script src="static/js/common.js"></script>
</head>
<body>
{if isset($error)}
<div class="box loginmessage">
<strong>注册失败</strong>
{if $error eq -1}
用户名不合规则。
{elseif $error eq -2}
用户已经存在。
{elseif $error eq -3}
密码和确认密码不一致。
{else}
其他原因。
{/if}
<p><a href="account.php?show=reg">请点击这里跳转</a>
</div><p>
<script>redirect(1000,'account.php?show=reg');</script>
{elseif isset($success)}
<div class="box loginmessage">
注册成功。请去登录。<p>
<a href="account.php">请点击这里跳转</a>
</div>
<script>redirect(1000,'account.php');</script>
{else}
<form class="box reg" action="account.php" method="post">
        <input type="hidden" name="action" value="reg" />
	<fieldset class="boxBody">
	  <label>用户名</label>
	  <input type="text" name="username" tabindex="1" placeholder="用于登录您的账户并记录您的各种设置" required>
	  <label>密码</label>
	  <input type="password" name="password" tabindex="2" placeholder="密码可以保护您的私人信息安全" required>
	  <label>确认密码</label>
	  <input type="password" name="password2" tabindex="3" placeholder="请再次输入上面的密码以确认正确" required>
	</fieldset>
	<footer>
	  <input type="submit" class="btnLogin" value="注册" tabindex="4">
	</footer>
</form>
{/if}
</body>
</html>
