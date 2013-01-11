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
    public function deriveKeyBlockID($holderID){
        $keyID = $this->key->getID();

        if($this->keyExpire > 0){
            $timeRegulator = new timeRegulator($this->keyExpire);
            $keyExpire = sprintf("%s",$timeRegulator);
        } else {
            $keyExpire = 'NEVER';
        }
        
        $digestor = new objectHash(
                        array('id'=>$keyID,
                              'expire'=>$keyExpire,
                              'holder'=>$holderID,
                             )
                                  );

        return $digestor->md5(False);
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

        $this->keyType = $data['type'];
        $this->keyPassPhrase = isset($data['passphrase'])?$data['passphrase']:'';
        $this->keyData  = $data['data'];
        $this->keyExpire = isset($data['expire'])?$data['expire']:-1;

        $this->key = new $this->_ciphers[$this->keyType]($this->keyData,$this->keyPassPhrase);
    }
}
?>
