function btnLoadNewCertificate_onClick(){
    $.post('ajax.cert.php?action=analyzeCertificate',
           $('#txtCertificate'),
           displayCertificateCallback,
           'json');
}
function displayCertificateCallback(j){
    alert(j.type);
}
$(function(){
    $('#btnLoadNewCertificate').click(btnLoadNewCertificate_onClick);
});
