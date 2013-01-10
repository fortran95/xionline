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
        }catch(Exception $e){
            
        }
        return false;
    }
    public function privateDecrypt($data,$passphrase){
    }
    public function sign($data,$passphrase){
    }
    public function verify($source,$data){
    }
    private function deriveKeyBlockID($holderID,$expire){
        $keyID = $this->key->getID();
        $regulatedExpireTime = str(new timeRegulator($expire));
    }
    private function readData($data){
        foreach(array('type','use','data') as $index)
            if(!isset($data[$index]))
                throw CryptoException("Key [$index] not specified when initializing this class.");

        if(!isset($this->_ciphers[$data['type']]))
            throw CryptoException("Key [type]({$data['type']}) not supported.");

        if($data['use'] != 'public' && $data['use'] != 'private')
            throw CryptoException("Key [use] invalid. Must be [public] or [private].");

        $this->keytype = $data['type'];
        $this->keyuse = ($data['use'] == 'public');
        $this->keydata  = $data['data'];

        $this->key = (new $this->_ciphers[$data['type']](true,$this->keydata,$this->keyuse));
    }
}
?>
