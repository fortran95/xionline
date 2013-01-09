<?
class Certificate{
    $base = array('title'=>'',
                  'description'=>'',
                  'contact'=>array(),);
    $id = '';
    $use = '';
    $keys = array();
    $signatures = array();

    public function __construct($certtext=''){
        $this->certtext = $certtext;

    }
    public function sign($text,$passphrase){
    }
    public function verify($signature,$text){
    }
    public function encrypt($text){
    }
    public function decrypt($ciphertext,$passphrase){
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
