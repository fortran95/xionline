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
<div id="loginFormDialog" title="System ξ">
    <div id="tabset">
        <ul>
            <li><a href="#loginDiv">用户登录</a></li>
            <li><a href="#regDiv">用户注册</a></li>
        </ul>
        <div id="loginDiv">
            <form id="loginForm" method="post" action="account.php">
                <input type="hidden" name="action" value="login">
                <fieldset class="boxBody">
                    <label>用户名</label>
                    <input type="text" name="username" tabindex="2" placeholder="在此输入您的用户名" required>
                    <label>密码</label>
                    <input type="password" name="password" tabindex="3" required>
                </fieldset>
                <button id="btnLogin" type="submit" tabindex="5">登录</button>
            </form>
        </div>
        <div id="regDiv">
            
        </div>
    </div>
</div>

{include file="overall.footer.tpl"}
