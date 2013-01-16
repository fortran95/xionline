{include file="overall.header.tpl" title="证书管理器" bodyScript="certificates.script.tpl"}
<div id="tabset">
<ul>
    <li><a href="#currentCertificates">当前证书</a></li>
    <li><a href="#loadCertificate">载入证书</a></li>
</ul>
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
    <button id="btnClearNewCertificate">清空</button>
</div>
</div>

<div id="certificateInfo" title="证书信息">
Test!
</div>
{include file="overall.footer.tpl"}
