<?
function analyzeCertificate($xml){
    try{
        $c = new Certificate($xml);
        $ret = array(
            'id'=>$c->id,
            'use'=>$c->use,
            'base'=>$c->base,
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
        $xml = isset($_POST['certificate'])?$_POST['certificate']:false;
        if($xml)
            $response = analyzeCertificate($xml);
        else
            $response = new failure('Data not received.');
        break;
    default:
        exit;
}
die($response->getJSON());
?>
