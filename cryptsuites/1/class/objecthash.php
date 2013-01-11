<?
class objectHash{
    /*
     * objectHash: provides uniform interface to
     *  all hashing needs.
     */
    public function __construct($mixedObj){
        $this->source = $this->prepare($mixedObj); 
    }
    public function md5($raw=False){
        if($raw===True)
            return md5($this->source,True);
        else
            return strtoupper(md5($this->source,False));
    }
    public function sha1($raw=False){
        if($raw===True)
            return sha1($this->source,$raw);
        else
            return strtoupper(sha1($this->source,False));
    }

    private function prepare($mixedObj){
        /*
         * The mission is
         * converting $mixedObj into a serialized
         * form in a determistic way.
         */
        if(is_string($mixedObj))
            return $mixedObj;

        if(is_numeric($mixedObj))
            return $mixedObj;

        if(is_bool($mixedObj))
            return $mixedObj?'TRUE':'FALSE';

        if(is_array($mixedObj)){
            $result = '';
            if((bool)count(array_filter(array_keys($mixedObj), 'is_string'))){
                ksort($mixedObj);
                foreach($mixedObj as $key=>$value)
                    $result .= "::$key:$value";
            } else {
                sort($mixedObj);
                foreach($mixedObj as $value)
                    $result .= "::$value";
            }
            return '(' . trim($result) . ')'; 
        }

        throw new CryptoException('trying to hash unrecognized type.');
    }
}
?>
