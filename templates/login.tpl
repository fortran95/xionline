{include file="overall.header.tpl" title="用户接口" navigation=0 bodyScript="login.scripts.tpl"}

<div id="info" title="提示">
{if isset($success)}
    <strong>{$success}</strong> 已经登录成功。
    <p><a href="index.php">如果页面没有自动跳转，请点击这里。</a>
{/if}
{if isset($error)}
登录错误，请检查用户名和密码。
{/if}
</div>
<div id="loginFormDialog" title="登录">
    <form id="loginForm" method="post" action="account.php">
        <input type="hidden" name="action" value="login">
        <label>用户名</label>
        <input type="text" name="username" tabindex="2" placeholder="在此输入您的用户名" required>
        <label>密码</label>
        <input type="password" name="password" tabindex="3" required>
    </form>
</div>
<div id="regFormDialog" title="注册">
    <form id="regForm" method="post" action="account.php">
        <input type="hidden" name="action" value="reg" />
        <label>用户名</label>
        <input type="text" name="username" tabindex="1" placeholder="用于登录您的账户并记录您的各种设置" required>
        <label>密码</label>
        <input type="password" name="password" tabindex="2" placeholder="密码可以保护您的私人信息安全" required>
        <label>确认密码</label>
        <input type="password" name="password2" tabindex="3" placeholder="请再次输入上面的密码以确认正确" required>
    </form>
</div>

{include file="overall.footer.tpl"}
