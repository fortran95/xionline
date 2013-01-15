function btnLoadNewCertificate_onClick(){
    $.post('ajax.cert.php?action=analyzeCertificate',
           $('#txtCertificate'),
           displayCertificateCallback,
           'json');
}
function displayCertificateCallback(j){
    if(j.type == 'failure'){
        $('#info').html('Failure');
    }
    if(j.type == 'success'){
        $('#info').html('读取成功。<br />证书ID：' + j.data.id + '<br />' + '标题为：' + j.data.base.title);
    }
}
$(function(){
    $('#btnLoadNewCertificate').click(btnLoadNewCertificate_onClick);
});
