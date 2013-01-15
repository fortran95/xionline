<?
function analyzeCertificate($xml){
    try{
        $c = new Certificate($xml);
        $ret = array(
            'id'=>$c->id,
        );
        return new success($ret);
    }catch(Exception $e){
        return new failure($e);
    }
}

include(dirname(__FILE__) . "/_general_.php");
$u = isset($_SESSION['user'])?$_SESSION['user']:false;
if(!$u){
    header("Location: account.php");
    exit;
}
$certManager = new certManager($u);

$action = isset($_GET['action'])?trim($_GET['action']):'listAllKeys';

switch($action){
    case 'listAllKeys':
        /* List all keys using Certificate Manager.
           Return an array of brief information. */
        $response = array();
        foreach($certManager->certificates as $cert)
            $response[] = array(
                'id'=>$c->id,
            );
        $response = new success($response);
        break;
    case 'analyzeCertificate':
        /* Read in $_POST['certificate'] or from database, analyze
           so that user is aware of some information. */
        $xml = $_POST['certificate'];
        $response = analyzeCertificate($xml);
        break;
    default:
        exit;
}
die($response->getJSON());
?>
