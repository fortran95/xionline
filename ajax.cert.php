<?
include(dirname(__FILE__) . "/_general_.php");
$u = isset($_SESSION['user'])?$_SESSION['user']:false;
if(!$u){
    header("Location: account.php");
    exit;
}
$certManager = new certManager($u);

$action = isset($_GET['action'])?trim($_GET['action']):'listAllKeys';

$response = array();
switch($action){
    case 'listAllKeys':
        foreach($certManager->certificates as $cert)
            $response[] = array(
                'id'=>$c->id,
            );
        break;
    default:
        exit;
}
die(json_encode($response));
?>
