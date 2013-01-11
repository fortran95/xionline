<?
class objectHash{
    /*
     * objectHash: provides uniform interface to
     *  all hashing needs.
     */
    public function __construct($mixedObj){
        switch($mixedObj){
            case(is_string($mixedObj)):
                $this->source = $mixedObj;
                break;
            case(is_array($mixedObj)):
                break;
            default:
                $this->source = sprintf("%s",$mixedObj);
                break;
    }
    public function md5($raw=False){
        return md5($this->source,$raw);
    }
    public function sha1($raw=False){
        return sha1($this->source,$raw);
    }

    private function prepareArray($array){
        
    }
}
?>
