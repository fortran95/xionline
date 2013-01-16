<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />

<title>System ξ{if isset($title)} :: {$title}{/if}</title>

<link rel="stylesheet" type="text/css" href="static/css/theme/blitzer/jquery-ui-1.9.2.custom.css">

<script type="text/javascript" src="static/scripts/common/jquery.js"></script>
<script type="text/javascript" src="static/scripts/common/jquery-ui.js"></script>

{if isset($bodyScript)}
<!-- Body Script -->
<script type="text/javascript">
{include file=$bodyScript}
</script>
{/if}

</head>
<body>

{if !(isset($navigation) && !$navigation)}
<div id="navigation">
<a href="index.php">首页</a>
|
<a href="certificates.php">证书管理</a>
|
<a href="messagebox.php">消息信箱</a>
|
<a href="account.php">退出登录</a>
</div>
{/if}
