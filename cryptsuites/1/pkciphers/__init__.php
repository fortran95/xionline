<?
Interface PublicKeyCipher{
    public function __construct($load=false,$datablock='',$public=false);
    public function public_encrypt($plaintext);
    public function private_decrypt($ciphertext,$passphrase);
    public function sign($fulltext,$passphrase);
    public function verify($fulltext,$signature);
    public function generate($parameterArray,$passphrase);
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
