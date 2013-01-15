<?
include(dirname(__FILE__) . "/_general_.php");

$u = isset($_SESSION['user'])?$_SESSION['user']:false;
if($u){
    $render->assign('user',array(
                            'name'=>$u->username,
                           ));
    $render->display('certificates.tpl');
}else
    header("Location: account.php");

?>
