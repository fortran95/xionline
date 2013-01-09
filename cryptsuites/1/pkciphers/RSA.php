<?
register_pkcipher('RSA.PKCS1','RSA');
register_pkcipher('RSA.OAEP','RSA');

class RSA implements PublicKeyCipher{
    public function __construct($load=false,$datablock='',$public=false){}
    public function public_encrypt($plaintext){}
    public function private_decrypt($ciphertext,$passphrase){}
    public function sign($fulltext,$passphrase){}
    public function verify($fulltext,$signature){}
    public function generate($parameterArray,$passphrase){}
}
?>
