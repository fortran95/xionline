function btnLoadNewCertificate_onClick(){
    $.post('ajax.cert.php?action=analyzeCertificate',
           $('#txtCertificate'),
           displayCertificateCallback,
           'json');
}
function btnClearNewCertificate_onClick(){
    $('#txtCertificate').val('');
}
function displayCertificateCallback(j){
    if(j == null)
        return;
    if(j.type == 'failure'){
        $('#certificateInfo')
            .html('Failure')
            .dialog('open');
    }
    if(j.type == 'success'){
        $('#certificateInfo')
            .html('读取成功。<br />证书ID：' + j.data.id + '<br />' + '标题为：' + j.data.base.title)
            .dialog('open');
    }
    $.post('ajax.cert.php?action=analyzeCertificateDetails');
}
$(function(){
    $('#btnLoadNewCertificate').click(btnLoadNewCertificate_onClick);
    $(':button').button({
        text:true
    });
    $('#tabset').tabs();
    $('#certificateInfo').dialog().dialog('close');
});
