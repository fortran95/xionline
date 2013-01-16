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
        $('#info').html('Failure');
    }
    if(j.type == 'success'){
        $('#info').html('读取成功。<br />证书ID：' + j.data.id + '<br />' + '标题为：' + j.data.base.title);
    }
    $.post('ajax.cert.php?action=analyzeCertificateDetails');
}
$(function(){
    $('#btnLoadNewCertificate').click(btnLoadNewCertificate_onClick);
});
