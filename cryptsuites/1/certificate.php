<?
class Certificate{
    public function __construct($certtext=''){
        global $_cryptsuite_1_standard_path;
        $this->standardsPath = $_cryptsuite_1_standard_path;
        $this->certtext = $certtext;

        if(!$certtext) return;

        try{
            $this->dom = new DOMDocument();
            $this->dom->loadXML($this->certtext);
            if(!$this->dom->schemaValidate($this->standardsPath . '/certificate.xsd'))
                throw new Exception();
        }catch(Exception $e){
            throw new CryptoException("given certificate invalid.");
        }
    }

    public function __get($name){
        if(!isset($this->$name)){  # parse certificate on demand
            switch($name){  # trigger parsing function
                case "id":
                    $this->readBaseInfo();
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
    
    private function readBaseInfo(){
        $this->id = 'hello';
    }
}

# Test code
$xmlpath = "$_cryptsuite_1_standard_path/sample.xml";
$xml = file_get_contents($xmlpath);

$c = new Certificate($xml);
print $c->id;

print "\n";
?>
