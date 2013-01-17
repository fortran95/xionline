<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />

<title>System ξ{if isset($title)} :: {$title}{/if}</title>

<link rel="stylesheet" type="text/css" href="static/css/theme/ui-darkness/jquery-ui.css">

<script type="text/javascript" src="static/scripts/common/jquery.js"></script>
<script type="text/javascript" src="static/scripts/common/jquery-ui.js"></script>

<style>
body{
font: 90% "Trebuchet MS", sans-serif;
margin: 50px;
}
.demoHeaders {
margin-top: 2em;
}
#dialog-link {
padding: .4em 1em .4em 20px;
text-decoration: none;
position: relative;
}
#dialog-link span.ui-icon {
margin: 0 5px 0 0;
position: absolute;
left: .2em;
top: 50%;
margin-top: -8px;
}
#icons {
margin: 0;
padding: 0;
}
#icons li {
margin: 2px;
position: relative;
padding: 4px 0;
cursor: pointer;
float: left;
list-style: none;
}
#icons span.ui-icon {
float: left;
margin: 0 4px;
}
.fakewindowcontain .ui-widget-overlay {
position: absolute;
}
</style>

<script type="text/javascript">
$(function(){
    $( "#navigation" )
        .buttonset()
        .click(function(){ 
            var choosenPage = $('input[name="navigation"]:checked').val();
            if(choosenPage == null)
                return;
            if(window.location.pathname.indexOf(choosenPage) < 0){
                window.location.href = choosenPage;
            }
        });
    $('input[name="navigation"]').each(function(){
        if( window.location.pathname.indexOf( $(this).val() ) >= 0){
            $(this).trigger('click');
        }
    });
});
</script>
{if isset($bodyScript)}
<!-- Body Script -->
<script type="text/javascript">
{include file=$bodyScript}
</script>
{/if}

</head>
<body>

{if !(isset($navigation) && !$navigation)}
{include file="plugin.navigation.tpl"}
<p>
{/if}
