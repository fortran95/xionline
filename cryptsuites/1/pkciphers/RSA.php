<?
register_pkcipher('RSA','PKC_RSA');

class PKC_RSA implements PublicKeyCipher{
    public function __construct($datablock='',$passphrase=''){
        if(is_string($datablock)){
            if(!is_string($passphrase))
                throw new CryptoException("passphrase expects a string.");

            if($passphrase){
                # so the key block represents a private key.
                # and we'll extract the public key first.
                # NOTICE: private key without a passphrase is not accepted.
                $this->privatekey = new Crypt_RSA();
                $this->privatekey->setPassword($passphrase);
                $this->privatekey->loadKey($datablock);

                $this->publickey = new Crypt_RSA();
                $this->publickey->loadKey($this->privatekey->getPublicKey());
            } else {
                $this->publickey = new Crypt_RSA();
                $this->publickey->loadKey($datablock);
            }
            $this->publickey->setPublicKey();
        }
    }
    public function publicEncrypt($plaintext){
        try{
            return $this->publickey->encrypt($plaintext);
        }catch(Exception $e){
            return false;
        }
    }
    public function privateDecrypt($ciphertext){
        try{
            return  $this->privatekey->decrypt($ciphertext);
        }catch(Exception $e){
            return false;
        }
    }
    public function sign($fulltext,$digestmod='sha1'){
        try{
            $digest = sha1($fulltext);

            $signature = $this->privatekey->sign($digest);

            $return = new cipherText($signature,True);
            $return->digest = $digestmod;

            return sprintf("%s",$return);
        }catch(Exception $e){
            return false;
        }
    }
    public function verify($fulltext,$signature){
        try{
            $signature = new cipherText($signature,False);
            $digestmod = $signature->digest;
            
            $digest = sha1($fulltext);

            return $this->publickey->verify($digest,sprintf("%s",$signature));
        }catch(Exception $e){
            return false;
        }
    }
    public function generate($parameterArray){
    }
    public function getID(){
        $publickey = $this->publickey->getPublicKey();
        $publickey = trim($publickey);
        $publickey = str_replace(array(' ',"\n"),'',$publickey);
        return md5($publickey);
    }
}

$r = new PKC_RSA($keyblock = "
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: AES-128-CBC,43A4DA3B781FA6C07EC3997F40ACB986

du+XpFWClRKtatlJ/oActuLbilO9sUkUl625r6Jr0/D4A3FLcg/YMdOXeMZ5CzDA
kSLGAYUi21pwprdZt25UgGN2JEs2O+tBmmN0mbuHP9OrvR2bUgSGefLPAlj7OtVd
aFFLtFXqYgGX5TCfKlrcCwJdMopaxKmce9o79fU131bJYZVWg18TDZxang674Km0
VX+KiMwStINrlokZZeOtXByCdl50Ru82zdVq7Xi+aehFplCgAqjkBKMnpr03okKy
L0NaReTU1lCQ4yyVgrsIRU1/0nb+5mCJXKZ91+IG4Wcl3C5saulph9q3HDMGWI0k
9lgLi/lWF4llTTCZKEvBIIi0yZ0h3S5+fyjUDg4TSLLbRohZyD6hjX3zCgPiy2i0
s7zaz2tfRAsynfHWSPsGalkkS29iydlguY5saakp/0TgKC1brezVChFl+VJaCQ5Q
5sLq/8z3ensZ7mdJH8EPJBi8ivkH9VO0QY4M9M3bggGQW33XPtWZ78zZ9vMEJ0mC
2z4dbYA1fobWIneP2lyGEJOFz21rcTAGvTVUfdrZlTH1R+E432AxVSq+SVprYJAK
ML4kYwkGZ59tTVnmvvCwZXvtMKYY/K5H2Uy4vwVjuE7DQ67bDq+X2RRdJPocyxX1
fAq0HTU41CeW8F1cl1q2UStaVQJ8BGLTU0c+L/v/UngvEwggd2oAyR3myTAZxbJe
ENi0Q8MYp27wEEVBBS520/89M1F6LQ+lxJVplR56bCr3X2ccyS2ESsKbgdABc372
hS1yBWfKBRpizQfzwJ3k0uUnV/1jK+abDjD2iNxdoxy3bvUbcgfEtAXfdtM62+03
-----END RSA PRIVATE KEY-----
",'test');
#echo base64_encode($r->publicEncrypt(md5('')));
#echo $r->getID();
if($r->verify($keyblock,$r->sign($keyblock))) print "Signature passed.";
echo "\n";
?>
