function btnLoadNewCertificate_onClick(){
    var xml = $('#txtCertificate').val();
    $.post('ajax.cert.php?action=analyzeCertificate',
           $('#txtCertificate'),
           function(j){ displayCertificateCallback(j,xml); },
           'json');
}
function btnClearNewCertificate_onClick(){
    $('#txtCertificate').val('');
}
function createCertificateDialog(jdata,xml){
    var dialogID = 'showDialog_' + jdata.id;
    $('<div>',{
        'id': dialogID,
        'title': '显示证书',
    }).appendTo('body')
      .dialog({
        close: function(){ $(this).remove(); },
        resize: function(){ $('#accordion',this).accordion('resize'); },
        minHeight: 400,
        minWidth: 600,
      })
      .dialog('open');

    $('<div id="accordion">' + 
      '<h2><a href="#">基本信息</a></h2>' + 
      '<div id="baseInfo"></div>' +
      '<h2><a href="#">密钥信息</a></h2>' + 
      '<div id="keyInfo"></div>' +
      '</div>')
        .appendTo('#' + dialogID)
        .accordion({
            beforeActivate: function(event,ui){
            },
            fillSpace: true,
        });

    $('#' + dialogID + ' #baseInfo').html(
        'ID: <strong>' + jdata.id + '</strong><br />' + 
        '标题：<strong>' + jdata.base.title + '</strong><br />' +
        '说明：<strong>' + jdata.base.description + '</strong><br />'
    );
    $('<textarea>',{
        id: 'xml',
    }).appendTo('#' + dialogID)
      .val(xml)
      .css({
        display: 'none',
      });
}
function displayCertificateCallback(j,xml){
    if(j == null)
        return;
    if(j.type == 'failure'){
        $('#certificateInfo')
            .html('Failure')
            .dialog('open');
    }
    if(j.type == 'success')
        createCertificateDialog(j.data,xml);
    $.post('ajax.cert.php?action=analyzeCertificateDetails');
}
$(function(){
    $('#btnLoadNewCertificate').click(btnLoadNewCertificate_onClick);
    $('#btnClearNewCertificate').click(btnClearNewCertificate_onClick);
    $(':button').button({
        text:true
    });
    $('#tabset').tabs();
    $('#certificateInfo').dialog().dialog('close');
});
