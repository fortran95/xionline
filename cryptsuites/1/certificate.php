<?
class Certificate{

    private $passphrase;

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
    public function setPassphrase($passphrase){
        $this->passphrase = $passphrase;
    }
    public function validateCertificate($anotherCertificate){
        /*
         * This is used validating another certificate.
         * In the other certificate, signatures from this certificate
         * is found and validated.
         *
         * XXX The return value might be complex:
         *      - How many signatures from this certificate found.
         *      - How were they validated.
         */
    }

    public function __get($name){
        if(!isset($this->$name)){  # parse certificate on demand
            switch($name){  # trigger parsing function
                case($name == "id" || $name == 'use'):
                    $this->skimRead();
                    break;
                case($name == "base"):
                    $this->readBase();
                    break;
                case($name == "keys"):
                    $this->readKeyBlocks();
                    break;
                default:
                    return false;
            }
        }
        return $this->$name;
    }
    
    private function readKeyBlocks(){
        $target = $this->dom->getElementsByTagName('keys')->item(0);
        $targets = $target->getElementsByTagName('block');
        foreach($targets as $target){
            try{
                # TODO read key block
            }catch(Exception $e){
                throw new CryptoException('error reading key blocks.');
            }
        }
    }
    private function readBase(){
        $targetBase = $this->dom->getElementsByTagName('base')->item(0);
        $targetTitle = $targetBase->getElementsByTagName('title')->item(0);
        $targetDesc = $targetBase->getElementsByTagName('description')->item(0);
        
        $this->base = array(
            'title'=>$targetTitle->textContent,
            'description'=>$targetDesc->textContent,
        );
    }
    private function skimRead(){
        $target = $this->dom->getElementsByTagName('certificate')->item(0);
        $this->id = $target->getAttribute('id');

        if($target->hasAttribute('use'))
            $this->use = $target->getAttribute('use');
        else
            $this->use = 'public';
    }
}

# Test code
$xmlpath = "$_cryptsuite_1_standard_path/sample.prv.xml";
$xml = file_get_contents($xmlpath);

$c = new Certificate($xml);
print $c->id . "\n";
print $c->use . "\n";
print $c->base['title'] . "\n";
print $c->base['description'] . "\n";
print "\n";
?>
