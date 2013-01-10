<?

class Certificate{
    public function __construct($certtext=''){
        global $_cryptsuite_1_standard_path;
        $this->standardsPath = $_cryptsuite_1_standard_path;

        $this->certtext = $certtext;

        try{
            $this->dom = new DOMDocument();
            $this->loadXML($this->certtext);
            if(!$xml->schemaValidate($this->standardsPath . '/certificate.xsd'))
                throw new Exception();
        }catch(Exception $e){
            throw new CryptoException("given certificate invalid.");
        }
    }
    public function __get($name){
        if(!isset($this->$name)){  # parse certificate on demand
            switch($name){  # trigger parsing function
                case "id":
                    break;
                default:
                    return false;
            }
        }
        return $this->$name;
    }
    public function __set($name,$value){
        # each attribute can be set only once.
        if(isset($this->$name))
            return;
        $this->$name = $value;
    }
    private function parseCert(){
        /*
         * Parse $this->certtext and refresh all info
         * stored in this class.
         *
         */
#        require_once(
    }
}
?>
