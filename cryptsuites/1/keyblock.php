<?
class KeyBlock{

    const IMPLEMENTED_ALGORITHMS = ';RSA.PKCS1;';

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
        if(!is_array($data))
            return;

        $this->readData($data);
    }
    public function public_encrypt($data){
        switch($this->keytype){
            case 'RSA.PKCS1':
                break;
            default:
                break;
        }
        return false;
    }
    public function private_decrypt($data,$passphrase){
        switch($this->keytype){
            case 'RSA.PKCS1':
                break;
            default:
                break;
        }
        return false;
    }
    public function sign($data,$passphrase){
        switch($this->keytype){
            case 'RSA.PKCS1':
                break;
            default:
                break;
        }
        return false;
    }
    public function verify($source,$data){
        switch($this->keytype){
            case 'RSA.PKCS1':
                break;
            default:
                break;
        }
        return false;        
    }

    private function deriveKeyBlockID($data,$expire){
        
    }
    private function readData($data){
        foreach(array('type','use','data') as $index)
            if(!isset($data[$index]))
                throw CryptoException("Key [$index] not specified when initializing this class.");

        if(strpos($this::IMPLEMENTED_ALGORITHMS,";{$data['type']};") === false)
            throw CryptoException("Key [type]({$data['type']}) not supported.");

        if(strpos(';public;private;',";{$data['use']};") === false)
            throw CryptoException("Key [use] invalid. Must be [public] or [private].");

        $this->keytype = $data['type'];
        $this->keyuse = ($data['use'] == 'public');
        $this->keydata  = $data['data']);

    }
}
?>
