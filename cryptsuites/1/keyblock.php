<?
class KeyBlock{
    public function __construct($data=false){
        /*
         * class KeyBlock
         *
         * This class can be initialized by $data, or simply
         * leave it as it is, if you wish to get a newly
         * generated keyblock. However, the keyblock do not
         * generate a new one until you call the right method.
         *
         * $data has indexes of:
         *  type, use, data
         */
        global $cryptsuite_pkciphers_supported;
        $this->_ciphers = $cryptsuite_pkciphers_supported;

        if(!is_array($data))
            return;

        $this->readData($data);
    }
    public function publicEncrypt($data){
        try{
            return $this->key->publicEncrypt($data);
        }catch(Exception $e){}
        return false;
    }
    public function privateDecrypt($data){
        try{
            return $this->key->privateDecrypt($data);
        }catch(Exception $e){}
        return false;
    }
    public function sign($data){
        try{
            return $this->key->sign($data,'sha1');
        }catch(Exception $e){}
        return false;
    }
    public function verify($data,$signature){
        try{
            return $this->key->verify($data,$signature);
        }catch(Exception $e){}
        return false;
    }
    private function deriveKeyBlockID($holderID,$expire){
        $keyID = $this->key->getID();
        $regulatedExpireTime = str(new timeRegulator($expire));
    }
    private function readData($data){
        /*
         * Read in key block
         *
         * Passphrase should only be specified when this is a private key block.
         */
        foreach(array('type','passphrase','data') as $index)
            if(!isset($data[$index]))
                throw new CryptoException("Key [$index] not specified when initializing this class.");

        if(!isset($this->_ciphers[$data['type']]))
            throw new CryptoException("Key [type]({$data['type']}) not supported.");

        $this->keytype = $data['type'];
        $this->keypassphrase = isset($data['passphrase'])?$data['passphrase']:'';
        $this->keydata  = $data['data'];

        $this->key = (new $this->_ciphers[$data['type']]($this->keydata,$this->passphrase));
    }
}
?>
