<?
function listAllKeys(){
    $response = array();
    foreach($certManager->certificates as $cert)
        $response[] = array(
            'id'=>$c->id,
        );
    return new success($response);
}

function analyzeCertificate_ReadIn($xml){
    global $_SESSION;
    try{
        $c = new Certificate($xml);
        die('stop');
        $ret = array(
            'id'=>$c->id,
            'use'=>$c->use,
            'base'=>$c->base,
        );
        die('here');
        $_SESSION['ajax.cert.php']['analyzeTarget'] = $c;
        return new success($ret);
    }catch(Exception $e){
        return new failure($e);
    }
}
function analyzeCertificate_Details($passphrase=''){
    global $_SESSION;
    if(!isset($_SESSION['ajax.cert.php']['analyzeTarget']))
        return new failure('Analyze target lost.');
    if(!(($c=$_SESSION['ajax.cert.php']['analyzeTarget']) instanceof Certificate)){
        return new failure('Analyze target corrupted.' . var_dump($c));
    }

    try{
        if($c->use == 'private')
            $c->setPassphrase($passphrase);

        $ret = array(
            'keyblocks'=>array(),
            'signatures'=>array(),
        );

        print array_keys($c->keys);
/*            foreach($c->keys as $attrid=>$keyblock)
                $ret['keyblocks'][$attrid] = array(
                
                );*/
        
#        if(isset($c->

        return new success($ret);
    }catch(Exception $e){
        return new failure($e);
    }
}
function analyzeCertificate_Examine(){
    global $_SESSION;
}

/*****************************************************************************/

include(dirname(__FILE__) . "/_general_.php");
$u = isset($_SESSION['user'])?$_SESSION['user']:false;
if(!$u){
    header("Location: account.php");
    exit;
}
if(!isset($_SESSION['ajax.cert.php'])) $_SESSION['ajax.cert.php'] = array();
$action = isset($_GET['action'])?trim($_GET['action']):false;

switch($action){
    case 'listAllKeys':
        /* List all keys using Certificate Manager.
           Return an array of brief information. */
        $response = listAllKeys();
        break;
    case 'analyzeCertificate':
        /* Read in $_POST['certificate'] or from database, analyze
           so that user is aware of some information. */
        $xml = isset($_POST['certificate'])?$_POST['certificate']:false;
        $response = ($xml)?analyzeCertificate_ReadIn($xml):(new failure('Data not received.'));
        break;
    case 'analyzeCertificateDetails':
        $passphrase = isset($_POST['passphrase'])?$_POST['passphrase']:'';
        $response = analyzeCertificate_Details($passphrase);
        break;
    default:
        exit;
}
die($response->getJSON());
?>
