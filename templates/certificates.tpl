{include file="overall.header.tpl" title="证书管理器" bodyScript="certificates.script.tpl"}
<div id="currentCertificates">
    <h1>当前证书</h1>
    <hr />
    <div id="list"></div>
</div>
<div id="loadCertificate">
    <h1>载入新证书</h1>
    <hr />
    <textarea id="txtCertificate" name="certificate"></textarea>
    <button id="btnLoadNewCertificate">提交</button>
</div>
<div id="analyzeCertificate">
    <h1>证书信息</h1>
    <hr />
    <div id="info"></div>
</div>
{include file="overall.footer.tpl"}
