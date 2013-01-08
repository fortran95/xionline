<?
include (dirname(__FILE__) . "/_general_.php");
$show = isset($_GET['show'])?$_GET['show']:'';
$show = strtolower(trim($show));
$action = isset($_POST['action'])?strtolower(trim($_POST['action'])):false;

switch($action){
    case 'login':
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        $um = new UserManager();
        $ret = $um->authenticate($username,$password);
        if(false !== $ret){
            $_SESSION['user'] = $ret;
            $render->assign('success',$_SESSION['user']->username);
        } else {
            $render->assign('error','1');
        }
        $show = 'login';
        break;
    case 'reg':
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        $password2 = isset($_POST['password2'])?$_POST['password2']:'';
        if($password != $password2)
            $render->assign('error',-3);
        else {
            $um = new UserManager();
            $ret = $um->userNew($username,$password);
            if(true === $ret){
                $render->assign('success','1');
            } else {
                $render->assign('error',$ret);
            }
        }
        $show = 'reg';
        break;
}

switch($show){
    case 'reg':
        $render->display('reg.tpl');
        break;
    default:
        # Log user out first.
        if(!$action) unset($_SESSION['user']);
        $render->display('login.tpl');
}
?>
