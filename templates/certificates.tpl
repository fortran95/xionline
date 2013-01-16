{include file="overall.header.tpl" title="证书管理器" bodyScript="certificates.script.tpl"}
<div id="tabset">
<ul>
    <li><a href="#currentCertificates">当前证书</a></li>
    <li><a href="#loadCertificate">载入证书</a></li>
</ul>
<div id="currentCertificates">
</div>
<div id="loadCertificate">
    这里您可以粘贴或者上传来自其他用户的证书，以便检查并导入数据库。<p>
    <textarea id="txtCertificate" name="certificate"></textarea><p>
    <button id="btnLoadNewCertificate">提交</button>
    <button id="btnClearNewCertificate">清空</button>
</div>
</div>

<div id="certificateInfo" title="证书信息">
Test!
</div>
{include file="overall.footer.tpl"}
