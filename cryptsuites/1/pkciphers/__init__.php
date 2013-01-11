<?
Interface PublicKeyCipher{
    public function __construct($datablock='',$passphrase='');
    public function publicEncrypt($plaintext);
    public function privateDecrypt($ciphertext);
    public function sign($fulltext);
    public function verify($fulltext,$signature);
    public function generate($parameterArray);

    public function getID();
    public function canSign();
    public function canEncrypt();
    public function canVerifySign();
    public function canDecrypt();
    public function isInitialized();
}

$cryptsuite_pkciphers_supported = array();
function register_pkcipher($cipher,$handler){
    global $cryptsuite_pkciphers_supported;
    if(!in_array($cipher,$cryptsuite_pkciphers_supported))
        $cryptsuite_pkciphers_supported[$cipher] = $handler;
}

$_cryptsuite_pkciphers_basepath = dirname(__FILE__);
include("$_cryptsuite_pkciphers_basepath/RSA.php");
?>
