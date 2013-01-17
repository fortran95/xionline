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
        return new success($ret);
    }catch(Exception $e){
        return new failure($e);
    }
}
function analyzeCertificate_Details($xml,$passphrase=''){
    global $_SESSION;
    try{
        $c = new Certificate($xml);
        if($c->use == 'private')
            $c->setPassphrase($passphrase);

        $ret = array(
            'id'=>$c->id,
            'use'=>$c->use,
            'base'=>$c->base,
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
        $response = ($xml)?analyzeCertificate_ReadIn($xml)
                          :(new failure('Data not received.'));
        break;
    case 'analyzeCertificateDetails':
        /* Similar to analyzeCertificate, but provides a more detailed
           set of information. The reason to use two functions, is, 
           private certificates' format examination have to get their
           passphrases entered in advance to be performed. Above function
           will just provide users with some hints about this certificate
           so that they will come up with passphrases.
           Since high performance is not the top consideration in this
           project, we just send $xml back again.*/
        $passphrase = isset($_POST['passphrase'])?$_POST['passphrase']:'';
        $xml = isset($_POST['certificate'])?$_POST['certificate']:false;
        $response = ($xml)?analyzeCertificate_Details($xml,$passphrase)
                          :(new failure('Incomplete data provided.'));
        break;
    default:
        exit;
}
die($response->getJSON());
