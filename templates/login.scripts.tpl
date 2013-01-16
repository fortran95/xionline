$(function(){
    $('button').button();
    $('[id$="FormDialog"]').dialog({
//        draggable:false,
        resizable:false,
    });
    $('#loginFormDialog').dialog('option','buttons',
        [ { text:'登录', click: function(){ $('#loginForm').submit(); } } ]);
    $('#regFormDialog').dialog('option','buttons',
        [ { text:'注册', click: function(){ $('#regForm').submit(); } } ]);

{if isset($success) || isset($error)}
    $('#info').dialog({
        zIndex: 100,
        resizable:false,
        dialogClass: 'alert',
    });
{/if}
});
