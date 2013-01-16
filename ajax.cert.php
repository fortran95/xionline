<?
function listAllKeys($u){
    try{
        $response = array();
        $certManager = new certManager($u);
        foreach($certManager->certificates as $cert){
            $response[] = array(
                'id'=>$cert->id,
            );
        }
        return new success($response);
    }catch(Exception $e){
        return new failure($e);
    }
}

function analyzeCertificate_ReadIn($xml){
    global $_SESSION;
    try{
        $c = new Certificate($xml);
        $ret = array(
            'id'=>$c->id,
            'use'=>$c->use,
            'base'=>$c->base,
        );
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

        foreach($c->keys as $attrid=>$keyblock)
            $ret['keyblocks'][$attrid] = array(
                'can'=>array(
                    'sign'=>$keyblock->canSign(),
                    'verify'=>$keyblock->canVerifySign(),
                    'encrypt'=>$keyblock->canEncrypt(),
                    'decrypt'=>$keyblock->canDecrypt(),
                ),
            );
        
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
    exit;
}
if(!isset($_SESSION['ajax.cert.php'])) $_SESSION['ajax.cert.php'] = array();
$action = isset($_GET['action'])?trim($_GET['action']):false;

switch($action){
    case 'listAllKeys':
        /* List all keys using Certificate Manager.
           Return an array of brief information. */
        $response = listAllKeys($u);
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
